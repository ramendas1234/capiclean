<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Comment::class;

    public function definition()
    {
        return [
            // https://laravel.com/docs/9.x/eloquent-factories#creating-models-using-factories
            'content' => $this->faker->text,
            'created_at' => $this->faker->dateTimeBetween('-3 months')
        ];
    }
}
