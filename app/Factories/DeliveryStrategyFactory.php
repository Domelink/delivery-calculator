<?php

namespace App\Factories;

use App\Enums\DeliveryType;
use InvalidArgumentException;
use App\Strategies\ExpressDeliveryStrategy;
use App\Strategies\StandardDeliveryStrategy;
use App\Interfaces\DeliveryStrategyInterface;
use App\Interfaces\DeliveryStrategyFactoryInterface;

final class DeliveryStrategyFactory implements DeliveryStrategyFactoryInterface
{
    public static function createStrategy(DeliveryType $type): DeliveryStrategyInterface
    {
        return match ($type) {
            DeliveryType::Standard => new StandardDeliveryStrategy(),
            DeliveryType::Express => new ExpressDeliveryStrategy(),
            default => throw new InvalidArgumentException(__('messages.unsupported_delivery_type')),
        };
    }
}
