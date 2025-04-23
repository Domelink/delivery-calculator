<?php

namespace App\Dto;

use App\Enums\DeliveryType;

final class GetDeliveryFeeDto extends BaseDto
{
    public function __construct(
        public DeliveryType $deliveryType,
        public ?string      $destination,
        public float        $weight,
    ){}

    public static function fromArray(array $params): self
    {
        return new self(
            deliveryType: DeliveryType::from($params['delivery_type']),
            destination: $params['destination'],
            weight: $params['weight'],
        );
    }
}
