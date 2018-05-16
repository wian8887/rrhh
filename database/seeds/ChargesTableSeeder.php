<?php

use Illuminate\Database\Seeder;

class ChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => "ASESOR", 'base_wage' => '6200'],
            ['name' => "ASISTENTE I", 'base_wage' => '3000'],
            ['name' => "ASISTENTE II", 'base_wage' => '2850'],
            ['name' => "ASISTENTEII", 'base_wage' => '2850'],
            ['name' => "ASISTENTE II", 'base_wage' => '2850'],
            ['name' => "DIRECTOR DE AREA", 'base_wage' => '10600'],
            ['name' => "DIRECTOR EJECUTIVO", 'base_wage' => '13200'],
            ['name' => "JEFE DE LA UNIDAD II", 'base_wage' => '6900'],
            ['name' => "JEFE DE UNIDAD II", 'base_wage' => '6900'],
            ['name' => "JEFE DE UNIDAD I", 'base_wage' => '7600'],
            ['name' => "PROFESIONAL I", 'base_wage' => '5000'],
            ['name' => "PROFESIONAL II", 'base_wage' => '4400'],
            ['name' => "PROFESIONAL II", 'base_wage' => '5000'],
            ['name' => "PROFESIONAL II", 'base_wage' => '4400'],
            ['name' => "PROFESIONAL III", 'base_wage' => '4400'],
            ['name' => "PROFESIONAL II", 'base_wage' => '4500'],
            ['name' => "PROFESIONAL II", 'base_wage' => '4400'],
            ['name' => "PROFESIONAL I", 'base_wage' => '5000'],
            ['name' => "RESPONSABLE ", 'base_wage' => '6200'],
            ['name' => "TECNICO I", 'base_wage' => '3900'],
            ['name' => "TECNICO II", 'base_wage' => '3500'],
            ['name' => "TECNICO I", 'base_wage' => '3900']
        ];
        foreach ($statuses as $status) {
            App\Charge::create($status);
        }
    }
}