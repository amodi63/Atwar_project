<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin123');
        $admin->image = 'logo.png';
        $admin->save();
    }
}
