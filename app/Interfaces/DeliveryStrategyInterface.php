<?php

namespace App\Interfaces;

interface DeliveryStrategyInterface
{
    /**
     * Calculate delivery fee
     *
     * @param string|null $destination Delivery destination
     * @param float $weight Package weight
     * @return float Calculated delivery fee
     */
    public function calculateFee(?string $destination, float $weight): float;
} 