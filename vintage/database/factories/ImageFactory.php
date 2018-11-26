<?php

use Faker\Generator as Faker;
use App\Model\Product;

$factory->define(App\Model\Image::class, function (Faker $faker) {
    return [
        'product_id' => function() {
            return Product::all()->random();
        },
        'product_image' => $faker->image('public/upload', 640, 480, null, false)
    ];
});
