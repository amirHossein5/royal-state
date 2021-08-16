<?php

namespace Database\Factories;

use App\Models\Advertise;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertiseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advertise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $properties = rand(1, 9);
        $toilet = ['ایرانی', 'فرنگی', 'ایرانی و فرنگی'];

        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->text(1000),
            'address' => $this->faker->address(),
            'amount' => rand(10000000, 100000000000),
            'image' => asset("admin-assets/images/images/properties-{$properties}.jpg"),
            'floor' => 'طبقه' . rand(1, 9),
            'year' => $this->faker->year(),
            'storeroom' => rand(0, 1),
            'balcony' => rand(0, 1),
            'area' => rand(0, 1),
            'room' => rand(1, 9),
            'parking' => rand(0, 1),
            'toilet' => $toilet[rand(0, 2)],
            'tag' => $this->faker->text(),
            'sell_status' => rand(0, 1),
            'type' => rand(0, 4),
            'cat_id' => Category::inRandomOrder()->first('id'),
            'user_id' => User::inRandomOrder()->first('id'),
        ];
    }
}
