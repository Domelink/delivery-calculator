<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Enums\DeliveryType;
use App\Http\Controllers\DeliveryController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(DeliveryController::class)]
final class CalculateDeliveryFeeTest extends TestCase
{
    #[DataProvider('provideValidDeliveryData')]
    public function testCalculateDeliveryFee(array $payload, int $expectedStatus, array $expectedResponse, string $expectedFee): void {
        $response = $this->postJson('/api/calculate-delivery-fee', $payload);

        $response->assertStatus($expectedStatus)
            ->assertJsonStructure($expectedResponse);

        if ($expectedStatus === 200) {
            $responseData = $response->json();
            $this->assertEquals($expectedFee, $responseData['data']['fee']);
            $this->assertEquals('Delivery fee calculated successfully', $responseData['message']);
            $this->assertEquals([], $responseData['errors']);
            $this->assertEquals(200, $responseData['status']);
        }
    }

    #[DataProvider('provideInvalidPayload')]
    public function testInvalidPayload(int $expectedStatus, array $payload): void
    {
        $response = $this->postJson('/api/calculate-delivery-fee', $payload);

        $response->assertStatus($expectedStatus);
    }

    public static function provideValidDeliveryData(): array
    {
        return [
            'standard delivery to kyiv under weight threshold' => [
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => 'kyiv',
                    'weight' => 1.5,
                ],
                'expectedStatus' => 200,
                'expectedResponse' => self::successResponse(),
                'expectedFee' => '45.00',
            ],
            'standard delivery to kyiv over weight threshold' => [
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => 'kyiv',
                    'weight' => 3.5,
                ],
                'expectedStatus' => 200,
                'expectedResponse' => self::successResponse(),
                'expectedFee' => '76.50',
            ],
            'express delivery to kyiv over weight threshold' => [
                'payload' => [
                    'delivery_type' => DeliveryType::Express->value,
                    'destination' => 'kyiv',
                    'weight' => 3.5,
                ],
                'expectedStatus' => 200,
                'expectedResponse' => self::successResponse(),
                'expectedFee' => '121.50',
            ],
            'standard delivery to lviv under weight threshold' => [
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => 'lviv',
                    'weight' => 1.5,
                ],
                'expectedStatus' => 200,
                'expectedResponse' => self::successResponse(),
                'expectedFee' => '50.00',
            ],
            'express delivery to lviv over weight threshold' => [
                'payload' => [
                    'delivery_type' => DeliveryType::Express->value,
                    'destination' => 'lviv',
                    'weight' => 4.0,
                ],
                'expectedStatus' => 200,
                'expectedResponse' => self::successResponse(),
                'expectedFee' => '140.00',
            ],
        ];
    }

    public static function provideInvalidPayload(): array
    {
        return [
            'missing delivery_type' => [
                'expectedStatus' => 422,
                'payload' => [
                    'destination' => 'kyiv',
                    'weight' => 1.5,
                ],
            ],
            'missing destination' => [
                'expectedStatus' => 422,
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'weight' => 1.5,
                ],
            ],
            'missing weight' => [
                'expectedStatus' => 422,
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => 'kyiv',
                ],
            ],
            'invalid delivery_type' => [
                'expectedStatus' => 422,
                'payload' => [
                    'delivery_type' => 'invalid_type',
                    'destination' => 'kyiv',
                    'weight' => 1.5,
                ],
            ],
            'weight too small' => [
                'expectedStatus' => 422,
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => 'kyiv',
                    'weight' => 0.05,
                ],
            ],
            'weight too large' => [
                'expectedStatus' => 422,
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => 'kyiv',
                    'weight' => 150,
                ],
            ],
            'invalid weight decimal places' => [
                'expectedStatus' => 422,
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => 'kyiv',
                    'weight' => 10.55,
                ],
            ],
            'destination too long' => [
                'expectedStatus' => 422,
                'payload' => [
                    'delivery_type' => DeliveryType::Standard->value,
                    'destination' => str_repeat('a', 256),
                    'weight' => 1.5,
                ],
            ],
        ];
    }

    private static function successResponse(): array
    {
        return [
            'message',
            'data' => [
                'fee',
            ],
            'errors',
            'status',
        ];
    }
}
