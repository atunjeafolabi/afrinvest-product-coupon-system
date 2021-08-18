<?php

namespace Tests\Feature;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_can_add_item_to_cart_without_coupon()
    {
        $items = [
            "items" => [
                [
                    "id"    => 1,
                    "name"  => "Afrinvest Equity",
                    "price" => 60
                ],
                [
                    "id"    => 2,
                    "name"  => "Fund FGN Saving Bonds",
                    "price" => 100
                ],
                [
                    "id"    => 3,
                    "name"  => "Freedom Savings",
                    "price" => 200
                ]
            ]
        ];

        $response       = $this->postJson('/api/cart/add', $items);
        $newTotalAmount = $response->json()['new_total_amount'];

        $response->assertOk();
        $this->assertEquals(360, $newTotalAmount);
    }

    /**
     * @dataProvider couponProvider
     */
    public function test_that_total_cart_amount_is_updated_when_coupon_code_is_applied(
        $items,
        $expectedNewAmount
    ) {
        $response      = $this->postJson('/api/cart/add', $items);
        $responseArray = $response->json()['new_total_amount'];

        $response->assertOk();
        $this->assertEquals($expectedNewAmount, $response['new_total_amount']);
    }

    public function couponProvider()
    {
        return [
            "Fixed Discount (cart total price greater than 50 is qualified)" => [
                [
                    "coupon_code" => "FIXED10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 700
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 500
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 300
                        ]
                    ]
                ],
                1490
            ],
            "Fixed Discount (cart total price less than 50 is NOT qualified)" => [
                [
                    "coupon_code" => "FIXED10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 20
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 10
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 10
                        ]
                    ]
                ],
                40
            ],
            "Fixed Discount (cart total equal to 50 is NOT qualified)" => [
                [
                    "coupon_code" => "FIXED10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 20
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 20
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 10
                        ]
                    ]
                ],
                50
            ],
            "Percent Discount (cart total price greater than 100 and quantity greater than two is qualified)"  => [
                [
                    "coupon_code" => "PERCENT10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 700
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 500
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 300
                        ]
                    ]
                ],
                1350
            ],
            "Percent Discount (cart total price less than 100 but quantity greater than two is NOT qualified)" => [
                [
                    "coupon_code" => "PERCENT10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 50
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 10
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 20
                        ]
                    ]
                ],
                80
            ],
            "Percent Discount (cart total price greater than 100 but quantity less than two is NOT qualified)" => [
                [
                    "coupon_code" => "PERCENT10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 700
                        ]
                    ]
                ],
                700
            ],
            "Mixed Discount (cart total price greater than 300 and quantity greater than 3 is qualified)" => [
                // TODO: test for when either percent is used or when fixed value is used for discount
                [
                    "coupon_code" => "MIXED10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 700
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 500
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 300
                        ]
                    ]
                ],
                1350
            ],
            "Rejected Discount (cart total price greater than 1000 is qualified)" => [
                [
                    "coupon_code" => "REJECTED10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 700
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 500
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 300
                        ]
                    ]
                ],
                1490
            ],
            "Rejected Discount (cart total price less than 1000 is NOT qualified)" => [
                [
                    "coupon_code" => "REJECTED10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 500
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 200
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 100
                        ]
                    ]
                ],
                800
            ],
            "Rejected Discount (cart total price equal to 1000 is NOT qualified)" => [
                [
                    "coupon_code" => "REJECTED10",
                    "items"       => [
                        [
                            "id"    => 1,
                            "name"  => "Afrinvest Equity",
                            "price" => 500
                        ],
                        [
                            "id"    => 2,
                            "name"  => "Fund FGN Saving Bonds",
                            "price" => 250
                        ],
                        [
                            "id"    => 3,
                            "name"  => "Freedom Savings",
                            "price" => 250
                        ]
                    ]
                ],
                1000
            ]
        ];
    }
}
