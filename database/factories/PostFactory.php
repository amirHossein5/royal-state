<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'body' => $this->faker->text(1000),
            'image' => asset('admin-assets/images/images/image_' . rand(1, 8) . '.jpg'),
            'cat_id' => Category::inRandomOrder()->first('id'),
            'user_id' => User::inRandomOrder()->first('id'),
            'published_at' => $this->faker->date('Y-m-d H:m:s')
        ];
    }
}
