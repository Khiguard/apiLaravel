<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Customer;


class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Customer::cre
      Customer::factory()->count(30)->create();
      
        /*
        DB::table('customers')->insert([
            'name' => Str::random(10),
            'fName' => Str::random(10),
        ]);*/
    }
}
