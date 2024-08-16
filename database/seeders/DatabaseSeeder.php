<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('profiles')->insert([
            'nome' => Str::random(10),
            'cognome' => Str::random(10),
            'numero_di_telefono' => '555789',
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);

        DB::table('profiles')->insert([
            'nome' => Str::random(10),
            'cognome' => Str::random(10),
            'numero_di_telefono' => '5535589995789',
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);

        DB::table('profiles')->insert([
            'nome' => Str::random(10),
            'cognome' => Str::random(10),
            'numero_di_telefono' => '55768',
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);

        DB::table('profile_attributes')->insert([
            'profile_id' => '1',
            'attribute' => Str::random(10),
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);

        DB::table('profile_attributes')->insert([
            'profile_id' => '1',
            'attribute' => Str::random(10),
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);

        DB::table('profile_attributes')->insert([
            'profile_id' => '1',
            'attribute' => Str::random(10),
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);

        DB::table('profile_attributes')->insert([
            'profile_id' => '2',
            'attribute' => Str::random(10),
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);

        DB::table('profile_attributes')->insert([
            'profile_id' => '3',
            'attribute' => Str::random(10),
            'data_di_creazione' => '01/01/2021',
            'data_di_modifica' => '01/01/2021',
        ]);
    }
}
