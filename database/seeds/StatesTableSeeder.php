<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
        	['clave' => '01', 'name' => 'Aguascalientes', 'slug' => 'aguascalientes', 'short' => 'Ags.'],
        	['clave' => '02', 'name' => 'Baja California', 'slug' => 'baja-california', 'short' => 'BC'],
			['clave' => '03', 'name' => 'Baja California Sur', 'slug' => 'baja-california-sur', 'short' => 'BCS'],
			['clave' => '04', 'name' => 'Campeche', 'slug' => 'campeche', 'short' => 'Camp.'],
			['clave' => '05', 'name' => 'Coahuila', 'slug' => 'coahuila', 'short' => 'Coah.'],
			['clave' => '06', 'name' => 'Colima', 'slug' => 'colima', 'short' => 'Col.'],
			['clave' => '07', 'name' => 'Chiapas', 'slug' => 'chiapas', 'short' => 'Chis.'],
			['clave' => '08', 'name' => 'Chihuahua', 'slug' => 'chihuahua', 'short' => 'Chih.'],
			['clave' => '09', 'name' => 'Distrito Federal', 'slug' => 'distrito-federal', 'short' => 'DF'],
			['clave' => '10', 'name' => 'Durango', 'slug' => 'durango', 'short' => 'Dgo.'],
			['clave' => '11', 'name' => 'Guanajuato', 'slug' => 'guanajuato', 'short' => 'Gto.'],
			['clave' => '12', 'name' => 'Guerrero', 'slug' => 'guerrero', 'short' => 'Gro.'],
			['clave' => '13', 'name' => 'Hidalgo', 'slug' => 'hidalgo', 'short' => 'Hgo.'],
			['clave' => '14', 'name' => 'Jalisco', 'slug' => 'jalisco', 'short' => 'Jal.'],
			['clave' => '15', 'name' => 'México', 'slug' => 'mexico', 'short' => 'Mex.'],
			['clave' => '16', 'name' => 'Michoacán', 'slug' => 'michoacan', 'short' => 'Mich.'],
			['clave' => '17', 'name' => 'Morelos', 'slug' => 'morelos', 'short' => 'Mor.'],
			['clave' => '18', 'name' => 'Nayarit', 'slug' => 'nayarit', 'short' => 'Nay.'],
			['clave' => '19', 'name' => 'Nuevo León', 'slug' => 'nuevo-leon', 'short' => 'NL'],
			['clave' => '20', 'name' => 'Oaxaca', 'slug' => 'oaxaca', 'short' => 'Oax.'],
			['clave' => '21', 'name' => 'Puebla', 'slug' => 'puebla', 'short' => 'Pue.'],
			['clave' => '22', 'name' => 'Querétaro', 'slug' => 'queretaro', 'short' => 'Qro.  '],
			['clave' => '23', 'name' => 'Quintana Roo', 'slug' => 'quintana-roo', 'short' => 'Q. Roo'],
			['clave' => '24', 'name' => 'San Luis Potosí', 'slug' => 'san-luis-potosi', 'short' => 'SLP'],
			['clave' => '25', 'name' => 'Sinaloa', 'slug' => 'sinaloa', 'short' => 'Sin.'],
			['clave' => '26', 'name' => 'Sonora', 'slug' => 'sonora', 'short' => 'Son.'],
			['clave' => '27', 'name' => 'Tabasco', 'slug' => 'tabasco', 'short' => 'Tab.'],
			['clave' => '28', 'name' => 'Tamaulipas', 'slug' => 'tamaulipas', 'short' => 'Tamps.'],
			['clave' => '29', 'name' => 'Tlaxcala', 'slug' => 'tlaxcala', 'short' => 'Tlax.'],
			['clave' => '30', 'name' => 'Veracruz', 'slug' => 'veracruz', 'short' => 'Ver.'],
			['clave' => '31', 'name' => 'Yucatán', 'slug' => 'yucatan', 'short' => 'Yuc.'],
			['clave' => '32', 'name' => 'Zacatecas', 'slug' => 'zacatecas', 'short' => 'Zac.'],
        ];
        DB::table('states')->insert($states);
    }
}
