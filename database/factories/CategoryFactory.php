<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\v1\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $category = array('Sedan', 'Crossover', 'Hatchback', 'SUV', 'Coupe',);
    return [
        'product_id' => str_random(12),
        'name' => $category[array_rand($category)],
    ];
});
