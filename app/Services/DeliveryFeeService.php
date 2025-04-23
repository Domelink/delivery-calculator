<?php

namespace App\Services;

use App\Dto\GetDeliveryFeeDto;
use App\Interfaces\DeliveryFeeServiceInterface;

final readonly class DeliveryFeeService implements DeliveryFeeServiceInterface
{
    public function calculateDeliveryFee(GetDeliveryFeeDto $dto): array
    {
        return [];
    }
}
