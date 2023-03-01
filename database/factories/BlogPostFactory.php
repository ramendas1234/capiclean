<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{

    protected $model = BlogPost::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // https://laravel.com/docs/9.x/eloquent-factories#creating-models-using-factories
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraphs(5, true),
            'created_at' => $this->faker->dateTimeBetween('-3 months')
           // 'user_id' => 0
        ];
    }
}
