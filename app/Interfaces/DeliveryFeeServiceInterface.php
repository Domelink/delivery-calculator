<?php

namespace App\Interfaces;

use App\Dto\GetDeliveryFeeDto;

interface DeliveryFeeServiceInterface
{
    /**
     * Calculate delivery fee based on provided parameters
     *
     * @param GetDeliveryFeeDto $dto Delivery fee calculation parameters
     * @return array Calculation result containing fee amount
     */
    public function calculateDeliveryFee(GetDeliveryFeeDto $dto): array;
}
