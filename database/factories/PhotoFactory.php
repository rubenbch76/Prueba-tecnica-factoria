<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PhotoFactory extends Factory
{
    protected $model = Photo::class;

    public function definition()
    {
        return [
			'image' => $this->faker->name(),
			'title' => $this->faker->name(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
