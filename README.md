Investment Product Coupon System
--------------------------------
## Overview
This solution implements a flexible coupon system API that allows for different discount strategies to be applied to a cart containing some items.
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

Table Relationships
--------
- Polymorphic relationships between the tables.
   
   - `coupons` and `mixed_coupons`, `fixed_value_coupons`, `percent_off_coupons`, `rejected_coupons`
     
   - `rules` and `minimum_item_rules`, `minimum_price_rules` 

Adding More Coupon Strategy
---------------------------
- The polymorphic relationship has made it easy to add more coupon strategies without directly editing the source code. To add a new coupon strategy, e.g `FIXED50`, we only need to add a new record to the `coupons` table and add the corresponding discount to the `value` column of the `fixed_value_coupons` table. We would also update the `rules` table accordingly.

Running Tests
-------------
- Ensure that `database.sqlite` file is present in the database folder of the root project
- Run `php artisan test`
- To generate test coverage reports, run `php artisan test --coverage-html tests/Coverage`. Html files are generated in the `tests/Coverage` folder, which can be viewed in a browser by opening `index.html`

Future Work
-----------
- Increase test coverage
- Further refactoring
- Validation of incoming `POST` data

Tech Stack
----------
- Laravel 8
- MySQL

Recommendations
---------------
- Generally, I think including one or two examples and hints in the challenge would have assisted in reasoning about the task.


Issues
------
- If you face any difficulty in setting this project up locally or have other issues, kindly create a github [issue](https://github.com/atunjeafolabi/afrinvest-product-coupon-system/issues).
