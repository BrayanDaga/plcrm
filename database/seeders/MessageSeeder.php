<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'transmitter' => 2,
                'receiver' => 3,
                'text' => "Hola",
                'time' => "2021-10-30 12:49:50"
            ],
            [
                'transmitter' => 3,
                'receiver' => 2,
                'text' => "Hola como estas?",
                'time' => "2021-10-30 12:50:45"
            ]
            ,
            [
                'transmitter' => 2,
                'receiver' => 3,
                'text' => "Bien y tu?",
                'time' => "2021-10-30 12:52:12"
            ]
            ,
            [
                'transmitter' => 2,
                'receiver' => 3,
                'text' => "Bien gracias",
                'time' => "2021-10-30 13:00:20"
            ],
            [
                'transmitter' => 4,
                'receiver' => 5,
                'text' => "Hola soy estudiante",
                'time' => "2021-10-30 12:49:50"
            ],
            [
                'transmitter' => 5,
                'receiver' => 4,
                'text' => "Hola soy productor",
                'time' => "2021-10-30 12:50:45"
            ],
            [
                'transmitter' => 5,
                'receiver' => 4,
                'text' => "Que te parecen las clases",
                'time' => "2021-10-30 12:52:12"
            ],
            [
                'transmitter' => 4,
                'receiver' => 5,
                'text' => "Quisiera más contenido",
                'time' => "2021-10-30 13:00:20"
            ],
            [
                'transmitter' => 5,
                'receiver' => 4,
                'text' => "Genial agregare más",
                'time' => "2021-10-30 13:10:20"
            ],
            [
                'transmitter' => 2,
                'receiver' => 5,
                'text' => "Hola productor",
                'time' => "2021-10-30 12:49:50"
            ],
            [
                'transmitter' => 5,
                'receiver' => 2,
                'text' => "Hola que tal te va",
                'time' => "2021-10-30 12:50:45"
            ],
            [
                'transmitter' => 2,
                'receiver' => 5,
                'text' => "Tengo unas dudas",
                'time' => "2021-10-30 12:52:12"
            ]
        ];
        foreach ($data as $message){
            DB::table('messages')->insert([
                'transmitter' => $message['transmitter'],
                'receiver'    => $message['receiver'],
                'text'        => $message['text'],
                'created_at'  => $message['time']
            ]);
        }
    }
}
