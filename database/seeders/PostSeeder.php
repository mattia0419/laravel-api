<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

use Illuminate\Support\Str;

use App\Models\Type;
use App\Models\Technology;

use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $types_ids = Type::all()->pluck('id');
        $technologies_ids = Technology::all()->pluck('id');

        for($i = 0; $i < 100; $i++){
            $post = new Post();
            $post->type_id = $faker->randomElement($types_ids);
            $post->title = $faker->catchPhrase();
            $post->content = $faker->paragraphs(3, true);
            $post->slug = Str::slug($post->title);
            $post->published = rand(0, 1);
            $post->save();
            $post->technologies()->attach($faker->randomElements($technologies_ids, rand(0, 2)));
        }
    }
}
