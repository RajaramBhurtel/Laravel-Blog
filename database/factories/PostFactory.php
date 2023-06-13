<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'excerpt' => $this->faker->paragraph,
            'body' => $this->faker->paragraphs(3, true)
        ];
    }
}