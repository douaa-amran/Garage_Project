<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Repair;
use App\Models\Invoice;
use App\Models\Vehicle;
use App\Models\Mechanic;
use App\Models\Supplier;
use App\Models\SparePart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        /*Client::factory(5)->create()->each(
            function($client) {
            $randomUserId = User::inRandomOrder()->first()->id;
            
            $client->userId = $randomUserId;
            
            $client->save();
        });*/

        //Vehicle::factory(10)->create();

        /*Mechanic::factory(5)->create()->each(
            function($mechanic) {
            $randomUserId = User::inRandomOrder()->first()->id;
            
            $mechanic->userId = $randomUserId;
            
            $mechanic->save();
        });*/

        //Supplier::factory(10)->create();

        //SparePart::factory(50)->create();

        /*User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'), // You can change the password
            'role' => 'Admin',
        ]);*/
        //Repair::factory(30)->create();
        Invoice::factory(10)->create();
    
    }
}
