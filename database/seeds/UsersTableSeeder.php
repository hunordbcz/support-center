<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $categories = [
            [
                'name' => 'Technical',
            ],
            [
                'name' => 'Sales',
            ],
            [
                'name' => 'Payments',
            ],
            [
                'name' => 'Feedback',
            ],
            [
                'name' => 'Legal',
            ],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
