<?php

namespace App\Interfaces;

use App\Enums\DeliveryType;
use InvalidArgumentException;

interface DeliveryStrategyFactoryInterface
{
    /**
     * Create a delivery strategy based on delivery type
     *
     * @param DeliveryType $type Delivery type
     * @return DeliveryStrategyInterface Delivery strategy
     * @throws InvalidArgumentException If unsupported delivery type
     */
    public static function createStrategy(DeliveryType $type): DeliveryStrategyInterface;
}
