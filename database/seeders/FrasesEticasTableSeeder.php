<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrasesEticasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fraseseticas')->insert([
            ['frase' => 'La ética es saber la diferencia entre lo que tienes derecho de hacer y lo que es correcto hacer.', 'autor' => 'Potter Stewart'],
            ['frase' => 'La moral descansa naturalmente en el sentimiento.', 'autor' => 'Anatole France'],
            ['frase' => 'Trabaja para mantener viva en tu pecho esa pequeña chispa de fuego celeste, la conciencia.', 'autor' => 'George Washington'],
            ['frase' => 'Con la moral corregimos los errores de nuestros instintos, y con el amor los errores de nuestra moral.', 'autor' => 'José Ortega y Gasset'],
            ['frase' => 'El primer paso en la evolución de la ética es un sentido de solidaridad con otros seres humanos.', 'autor' => 'Albert Schweitzer'],
            ['frase' => 'Aquel que no usa su moralidad como si fuera su mejor vestimenta, estaría mejor desnudo.', 'autor' => 'Khalil Gibran'],
            ['frase' => 'Obra de manera congruente con tu verdadera personalidad, con sinceridad y con verdad.', 'autor' => 'Robin S. Sharma'],
            ['frase' => 'La ética, la equidad y los principios de la justicia no cambian con los calendarios.', 'autor' => 'D. H. Lawrence'],
            ['frase' => 'Mi conciencia tiene para mí más peso que la opinión de todo el mundo.', 'autor' => 'Cicerón'],
            ['frase' => 'Hay que ser buenos no para ser felices, sino para que los demás lo sean.', 'autor' => 'Achile Tournier'],
            ['frase' => 'Quien tiene paz en su conciencia, lo tiene todo.', 'autor' => 'San Juan Bosco'],
            ['frase' => 'Todo está perdido cuando los malos sirven de ejemplo y los buenos de mofa.', 'autor' => 'Demócrates'],
            ['frase' => 'La integridad es la base sobre la que todos los otros valores deben construirse.', 'autor' => 'Brian Tracy'],
            ['frase' => 'La ética de un hombre libre nada tiene que ver con la obediencia, sino con la autodeterminación.', 'autor' => 'Fernando Savater']
        ]);
    }
}
