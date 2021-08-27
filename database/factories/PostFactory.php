<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Services\ImageService;
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
            'cat_id' => Category::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'published_at' => $this->faker->date('Y-m-d'),
            'slug' => make_slug($this->faker->title())
        ];
    }
}
