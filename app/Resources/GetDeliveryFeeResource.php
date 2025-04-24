<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

final class GetDeliveryFeeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'fee' => number_format($this->resource['fee'] ?? 0, 2, '.', ''),
        ];
    }
}
