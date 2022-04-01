<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $yo = new User;
         $yo->name='jose';
         $yo->email='jmaria@hotmail.com';
         $yo->administrator=true;
         $yo->password='$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

    

         $yo->save();

         \App\Models\User::factory(10)->create();
         \App\Models\Roll::factory(500)->create();
    }
}
