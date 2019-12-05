<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\v1\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $category = array('Sedan', 'Crossover', 'Hatchback', 'SUV', 'Coupe',);
    $gallery = array(
        'https://img.icons8.com/clouds/100/000000/car.png',
        'https://img.icons8.com/clouds/100/000000/car.png',
        'https://img.icons8.com/clouds/100/000000/car.png',
        'https://img.icons8.com/clouds/100/000000/car.png'
    );
    return [
        'product_id' => str_random(12),
        'category_id' => '',
        'name' => $faker->name,
        'slug' => $faker->url,
        'available_stock' => mt_rand(0, 10),
        'current_stock' => mt_rand(0, 10),
        'description' => $faker->paragraph,
        'featured_image' => 'https://img.icons8.com/clouds/100/000000/car.png',
        'gallery' => json_encode($gallery),
    ];
});