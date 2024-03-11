<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/countries+states.json");
        $data = json_decode($json);

        foreach ($data as $obj) {
            foreach ($obj->states as $state) {
                DB::table('locations')->insert([
                    'country' => $obj->name,
                    'state' => $state->name,
                ]);
            }
        }

    }
}
