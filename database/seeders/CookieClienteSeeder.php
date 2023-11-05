<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CookieClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('glpi')->insert(
            [
                'cookie'=>'glpi_a39671d191afef61072046348dab714b=j38aeu9h21dps0kbd47shkc13v; glpi_a39671d191afef61072046348dab714b_rememberme=%5B11488%2C%2281Pji7BXwhrUw8DabuZC9wnUmXUzhdSE9CuyTe01%22%5D'
            ]
        );
    }
}
