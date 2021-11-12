
<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'              => 'tim',
            'email'             => 'admin@test.fr',
            'password'          => \Illuminate\Support\Facades\Hash::make('test'),
            'created_at'        => \Carbon\Carbon::now(),
            'role'              => 'admin',
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);


        User::create([
            'name' =>'Flo',
                    'email' => 'contact@florent.com',
                    'password' => Hash::make('toor'),
            'role' => 'user'
           ]);
    }
}