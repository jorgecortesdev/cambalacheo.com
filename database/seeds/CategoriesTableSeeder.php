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
            ['name' => 'Aparatos eléctricos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Arte', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Artesanias', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Audio/Foto/Video', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Autos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bebes/Maternidad', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Bicicletas', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Boletos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Celulares/Smartphones', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Clases/Conocimiento', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Coleccionables', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Computación', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Deportes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Educación/Asesorías/Cursos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Ferretería', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Hogar/Decoración', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Hospedaje', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Inmuebles/Propiedades', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Juegos/Juguetes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Libros/Revistas/Cómics', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Maquinaria/Equipo', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Mascotas', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Música/Instrumentos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Oficina', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Otros', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Papelería', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Películas/Series', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Pesca', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Restaurantes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Ropa/Calzado/Accesorios', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Salud/Belleza', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Servicios', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Tecnología', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Vehículos/Motos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Viajes', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Videojuegos', 'status' => 1, 'created_at' => $date, 'updated_at' => $date],
        ];
        DB::table('categories')->insert($categories);
    }
}
