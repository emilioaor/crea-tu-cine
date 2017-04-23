<?php

use Illuminate\Database\Seeder;

use App\Genre;

class genresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre = new Genre();
        $genre->name = 'Comedia';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Suspenso';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Drama';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Acción';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Aventura';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Romance';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Fantasía';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Infantil';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Ficción';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Terror';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Crimen';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Misterio';
        $genre->save();

        $genre = new Genre();
        $genre->name = 'Animación';
        $genre->save();
    }
}
