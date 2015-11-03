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
        	['clave' => '01', 'name' => 'Aguascalientes', 'short' => 'Ags.'],
        	['clave' => '02', 'name' => 'Baja California', 'short' => 'BC'],
			['clave' => '03', 'name' => 'Baja California Sur', 'short' => 'BCS'],
			['clave' => '04', 'name' => 'Campeche', 'short' => 'Camp.'],
			['clave' => '05', 'name' => 'Coahuila de Zaragoza', 'short' => 'Coah.'],
			['clave' => '06', 'name' => 'Colima', 'short' => 'Col.'],
			['clave' => '07', 'name' => 'Chiapas', 'short' => 'Chis.'],
			['clave' => '08', 'name' => 'Chihuahua', 'short' => 'Chih.'],
			['clave' => '09', 'name' => 'Distrito Federal', 'short' => 'DF'],
			['clave' => '10', 'name' => 'Durango', 'short' => 'Dgo.'],
			['clave' => '11', 'name' => 'Guanajuato', 'short' => 'Gto.'],
			['clave' => '12', 'name' => 'Guerrero', 'short' => 'Gro.'],
			['clave' => '13', 'name' => 'Hidalgo', 'short' => 'Hgo.'],
			['clave' => '14', 'name' => 'Jalisco', 'short' => 'Jal.'],
			['clave' => '15', 'name' => 'México', 'short' => 'Mex.'],
			['clave' => '16', 'name' => 'Michoacán de Ocampo', 'short' => 'Mich.'],
			['clave' => '17', 'name' => 'Morelos', 'short' => 'Mor.'],
			['clave' => '18', 'name' => 'Nayarit', 'short' => 'Nay.'],
			['clave' => '19', 'name' => 'Nuevo León', 'short' => 'NL'],
			['clave' => '20', 'name' => 'Oaxaca', 'short' => 'Oax.'],
			['clave' => '21', 'name' => 'Puebla', 'short' => 'Pue.'],
			['clave' => '22', 'name' => 'Querétaro', 'short' => 'Qro.  '],
			['clave' => '23', 'name' => 'Quintana Roo', 'short' => 'Q. Roo'],
			['clave' => '24', 'name' => 'San Luis Potosí', 'short' => 'SLP'],
			['clave' => '25', 'name' => 'Sinaloa', 'short' => 'Sin.'],
			['clave' => '26', 'name' => 'Sonora', 'short' => 'Son.'],
			['clave' => '27', 'name' => 'Tabasco', 'short' => 'Tab.'],
			['clave' => '28', 'name' => 'Tamaulipas', 'short' => 'Tamps.'],
			['clave' => '29', 'name' => 'Tlaxcala', 'short' => 'Tlax.'],
			['clave' => '30', 'name' => 'Veracruz de Ignacio de la Llave', 'short' => 'Ver.'],
			['clave' => '31', 'name' => 'Yucatán', 'short' => 'Yuc.'],
			['clave' => '32', 'name' => 'Zacatecas', 'short' => 'Zac.'],
        ];
        DB::table('states')->insert($states);
    }
}
