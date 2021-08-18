Investment Product Coupon System
--------------------------------
## Overview
This solution implements a flexible coupon system that allows for different discount strategies.
 A coupon may have many RULES (conditions to be met) and many DISCOUNT TYPES (benefits). If one rule is not met, the system must reject the coupon. 
 
 Coupon can only be applied once to a cart. Hence, whenever coupon is applied to a cart more than once, an exception is thrown.

## Installation:
- Clone the project: ```git clone https://github.com/atunjeafolabi/afrinvest-investment-product-coupon-api.git```
- Create a mysql database named ```afrinvest_product_coupon_system```
- From the project root directory, run `composer install`
- Run migrations ```php artisan migrate```
- Run seeders `php artisan db:seed` to populate the database with `Coupons`, and `Rules`
- Run local dev server: ```php artisan serve``` 

## Usage:
Add items to cart and optionally apply a coupon code for discount

#### Request

`POST api/cart/add`

    curl -X POST -H "Content-Type: application/json" -d '{
        "coupon_code": "MIXED10",
        "items": [
            {
                "id":1,
                "name":"Afrinvest Equity",
                "price":60
            },
            {
                "id":2,
                "name":"Fund FGN Saving Bonds",
                "price":100
            },
            {
                "id":3,
                "name":"Freedom Savings",
                "price":200
            }
        ]
     }' http://localhost:8000/api/cart/add

Running Tests
-------------
- Ensure that `database.sqlite` file is present in the database folder of the root project
- Run `php artisan test`

Future Work
-----------
- Increase test coverage
- Further refactoring
- Validation of incoming `POST` data

Tech Stack
----------
- Laravel 8
- MySQL

### Issues
- Kindly let me know if any issues are encountered.
