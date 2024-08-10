<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {


        $csvFile = fopen(base_path("database/data/1-user2.csv"), "r");

        $firstline = true;

        $arrNamaColumn = [];
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if ($firstline) {
                foreach ($data as $idx => $namaColumn) {
                    array_push($arrNamaColumn, $namaColumn);
                }
                $firstline = false;
                continue;
            }

            $arrCreate = [];
            foreach ($arrNamaColumn as $idx => $namaColumn) {
                if($namaColumn == 'password'){
                    $arrCreate[$namaColumn] = $data[$idx] = \Illuminate\Support\Facades\Hash::make($data[$idx]);
                }else{
                    $arrCreate[$namaColumn] = $data[$idx] == 'null' ? null : $data[$idx];
                }
            }

            User::create($arrCreate);
        }

        fclose($csvFile);
    }
}
