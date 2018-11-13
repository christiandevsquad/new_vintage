<?php

use Faker\Generator as Faker;
use App\Model\Product;

$factory->define(App\Model\Tag::class, function (Faker $faker) {
    return [
        'product_id' => function() {
            return Product::all()->random();
        },
        'product_tag' => $faker->word()
    ];
});
