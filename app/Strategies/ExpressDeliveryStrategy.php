<?php

namespace App\Strategies;

use App\Interfaces\DeliveryStrategyInterface;

final class ExpressDeliveryStrategy implements DeliveryStrategyInterface
{
    private const int BASE_FEE = 100;
    private const float WEIGHT_THRESHOLD = 2.0;
    private const int FEE_PER_KG = 10;
    private const int KYIV_DISCOUNT_PERCENT = 10;

    public function calculateFee(?string $destination, float $weight): float
    {
        $fee = self::BASE_FEE;

        if ($weight > self::WEIGHT_THRESHOLD) {
            $fee += self::FEE_PER_KG * $weight;
        }

        if (strtolower($destination) === 'kyiv') {
            $fee = $fee * (1 - self::KYIV_DISCOUNT_PERCENT / 100);
        }

        return $fee;
    }
}
