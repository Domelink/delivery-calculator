<?php

namespace App\Services;

use App\Dto\GetDeliveryFeeDto;
use App\Factories\DeliveryStrategyFactory;
use App\Interfaces\DeliveryFeeServiceInterface;

final readonly class DeliveryFeeService implements DeliveryFeeServiceInterface
{
    public function calculateDeliveryFee(GetDeliveryFeeDto $dto): array
    {
        $strategy = DeliveryStrategyFactory::createStrategy($dto->deliveryType);

        return [
            'fee' => $strategy->calculateFee($dto->destination, $dto->weight),
        ];
    }
}
