<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('public/images/160290cdb0652b0525e8191290986af1.png');
        $filePath = Storage::putFile('images', new File($path));
        DB::table('users')->insert([
            'first_name' => 'LiftHub',
            'last_name' => 'Org',
            'email' => 'lifthub@investlift.com',
            'avatar' => $filePath,
            'password' => Hash::make('404lifthub'),
            'isAdmin' => true,
            'phone' => '08188384544'
        ]);
    }
}
