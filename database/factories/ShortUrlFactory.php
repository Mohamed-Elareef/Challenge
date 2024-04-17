<?php

namespace Database\Factories;

use App\Models\ShortUrl;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShortUrlFactory extends Factory
{
    protected $model = ShortUrl::class;

    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'short_code' => Str::random(6) 
        ];
    }
}
