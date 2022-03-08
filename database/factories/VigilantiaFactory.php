<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vigilantia;
use Faker\Generator as Faker;

$factory->define(Vigilantia::class, function (Faker $faker) {

    return [
        'pesquisa' => $this->faker->word,
        'dip' => $this->faker->word,
        'procedemientos_cirugias' => $this->faker->word,
        'paa' => $this->faker->word,
        'comentarios' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
    ];
});
