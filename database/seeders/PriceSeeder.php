<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::pluck('id')->toArray();

        $prices = [
            10000, 20000, 30000, 40000, 50000, 60000,
            80000, 90000, 100000, 110000,
            120000, 130000, 150000, 160000,
            170000, 180000, 190000, 200000, 300000, 400000, 
            500000, 600000, 700000, 800000, 900000,
            15000, 25000, 35000, 45000, 55000,
        ];

        $beginDates = [
            '2021-03-25 00:00:00',
            '2021-03-26 00:00:00',
            '2021-03-27 00:00:00',
            '2021-03-28 00:00:00',
            '2021-03-29 00:00:00',
            '2021-03-30 00:00:00',
        ];

        $endDates = [
            '2022-05-02 23:59:59',
            '2022-05-03 23:59:59',
            '2022-05-04 23:59:59',
            '2022-05-05 23:59:59',
            '2022-05-06 23:59:59',
            '2022-05-07 23:59:59',
            '2022-05-08 23:59:59',
        ];

        foreach ($products as $productId) {
            $price = [
                'price' => $prices[array_rand($prices)],
                'product_id' => $productId,
                'begin_date' => $beginDates[array_rand($beginDates)],
                'end_date' => $endDates[array_rand($endDates)],
            ];
            Price::create($price);
        }
    }
}