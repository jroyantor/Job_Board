<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $title = $this->faker->sentence(rand(6,8));
        $date_time = $this->faker->dateTimeBetween('-1 month','now');
        $description = '';

        for($i = 0; $i < 5; $i++){
            $description .= '<p class="mb-4">'.$this->faker->sentences(rand(6,10),true).'</p>';
        }

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . rand(1111,9999),
            'company' => $this->faker->company,
            'location' => $this->faker->country,
            'logo' => basename($this->faker->image(storage_path('app/public'))),
            'is_highlighted' => (rand(1,9) > 6),
            'is_active' => true,
            'description' => $description,
            'apply_link' => $this->faker->url,
            'created_at' => $date_time,
            'updated_at' => $date_time,

        ];
    }
}
