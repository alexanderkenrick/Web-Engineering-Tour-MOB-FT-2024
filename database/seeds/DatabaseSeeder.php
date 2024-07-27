<?php

use App\User;
use Database\Seeders\OptionSeeder;
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
        $this->call([QuestionSeeder::class, OptionSeeder::class]);
    }
}
