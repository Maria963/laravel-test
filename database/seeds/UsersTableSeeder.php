<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $user = User::where('email', 'admin@admin.com')->first();
        if ($user===null) {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
