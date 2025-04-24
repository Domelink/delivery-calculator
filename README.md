# Delivery Fee Calculator

A service for calculating delivery fees on an e-commerce platform.

## Project Description

This simple Laravel microservice calculates delivery fees according to business rules:

- There are two delivery types:
  - standard - base fee is 50 UAH
  - express - base fee is 100 UAH
- Additional charge of 10 UAH per kg if weight exceeds 2 kg
- 10% discount for delivery to Kyiv

## Requirements

- PHP 8.3 or higher
- Composer
- Laravel 12

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Domelink/delivery-calculator.git
cd delivery-calculator
```

2. Install dependencies:
```bash
composer install
```

3. Copy the .env file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

## Running the Application

Start the development server:
```bash
php artisan serve
```

This command starts Laravel's built-in development server, making your application accessible at http://localhost:8000. It's a convenient way to run your application during development without requiring a full web server setup.

## API Documentation

Full API documentation is available in Postman:
[Postman Documentation](https://documenter.getpostman.com/view/34744987/2sB2ixkEBJ)

### Calculate Delivery Fee

**Request:**
```
POST /api/calculate-delivery-fee
```

**Request Body (JSON):**
```json
{
  "destination": "kyiv",
  "weight": 3.5,
  "delivery_type": "express"
}
```

**Response Example:**
```json
{
  "message": "Delivery fee calculated successfully",
  "data": {
    "fee": "121.50"
  },
  "errors": [],
  "status": 200
}
```

## Testing

Run the tests:
```bash
php artisan test
```

## Architecture

The service is built using the Strategy pattern for different delivery types:

- `DeliveryFeeService` - main service for fee calculation
- `DeliveryStrategyInterface` - interface for delivery strategies
- `StandardDeliveryStrategy` and `ExpressDeliveryStrategy` - concrete strategies for different delivery types
- `DeliveryStrategyFactory` - factory for creating the appropriate strategy

The project adheres to SOLID principles, uses dependency injection, and follows the single responsibility principle.

## Repository

View the source code on GitHub:
[GitHub Repository](https://github.com/Domelink/delivery-calculator.git)
