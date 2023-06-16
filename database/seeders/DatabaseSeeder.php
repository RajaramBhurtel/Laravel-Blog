<?php

namespace Database\Seeders;

use App\Models\Category;
use \App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name'=> 'Sabin'
        ]);
        $category = Category::factory()->create([
            'name'=> 'IT'
        ]);
        \App\Models\Post::factory(10)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
    }
}
