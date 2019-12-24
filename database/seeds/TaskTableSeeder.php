<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tag::class, 10)->create()->each(function ($u) {
            $u->save();
        });

        $tags = App\Tag::all();
        factory(App\Task::class, 100)->create()->each(function (App\Task $task) use ($tags) {
            $task->tag()->attach(
                $tags ->random(rand(1, 10))
            );
        });

    }
}
