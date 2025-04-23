<?php

namespace App\Http\Controllers;

use App\Dto\GetDeliveryFeeDto;
use Illuminate\Http\JsonResponse;
use App\Resources\GetDeliveryFeeResource;
use App\Http\Requests\GetDeliveryFeeRequest;
use App\Interfaces\DeliveryFeeServiceInterface;

final class DeliveryController extends BaseApiController
{
    public function __construct(private readonly DeliveryFeeServiceInterface $deliveryFeeService)
    {

    }

    public function calculateDeliveryFee(GetDeliveryFeeRequest $request): JsonResponse
    {
//        try {
            $response = $this->deliveryFeeService->calculateDeliveryFee(GetDeliveryFeeDto::fromArray($request->all()));

            return $this->response(__('messages.successfully_got_delivery_fee'), GetDeliveryFeeResource::make($response));
//        } catch (\Throwable $exception) {
//            return $this->handleException($exception);
//        }
    }
}
