<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $categories = [
            ['name' => 'Aparatos eléctricos', 'slug' => 'aparatos-electricos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Arte', 'slug' => 'arte', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Artesanias', 'slug' => 'artesanias', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Audio/Foto/Video', 'slug' => 'audio-foto-video', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Autos', 'slug' => 'autos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bebes/Maternidad', 'slug' => 'bebes-maternidad', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bicicletas', 'slug' => 'bicicletas', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Boletos', 'slug' => 'boletos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Celulares/Smartphones', 'slug' => 'celulares-smartphones', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Clases/Conocimiento', 'slug' => 'clases-conocimiento', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Coleccionables', 'slug' => 'coleccionables', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Computación', 'slug' => 'computacion', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Deportes', 'slug' => 'deportes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Educación/Asesorías/Cursos', 'slug' => 'educacion-asesorias-cursos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Ferretería', 'slug' => 'ferreteria', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Hogar/Decoración', 'slug' => 'hogar-decoracion', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Hospedaje', 'slug' => 'hospedaje', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Inmuebles/Propiedades', 'slug' => 'inmuebles-propiedades', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Juegos/Juguetes', 'slug' => 'juegos-juguetes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Libros/Revistas/Cómics', 'slug' => 'libros-revistas-comics', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Maquinaria/Equipo', 'slug' => 'maquinaria-equipo', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Mascotas', 'slug' => 'mascotas', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Música/Instrumentos', 'slug' => 'musica-instrumentos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Oficina', 'slug' => 'oficina', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Otros', 'slug' => 'otros', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Papelería', 'slug' => 'papeleria', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Películas/Series', 'slug' => 'peliculas-series', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Pesca', 'slug' => 'pesca', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Restaurantes', 'slug' => 'restaurantes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Ropa/Calzado/Accesorios', 'slug' => 'ropa-calzado-accesorios', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Salud/Belleza', 'slug' => 'salud-belleza', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Servicios', 'slug' => 'servicios', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Tecnología', 'slug' => 'tecnologia', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Vehículos/Motos', 'slug' => 'vehiculos-motos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Viajes', 'slug' => 'viajes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Videojuegos', 'slug' => 'videojuegos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
        ];
        DB::table('categories')->insert($categories);
    }
}
