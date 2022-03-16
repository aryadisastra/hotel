<?php

namespace Database\Seeders;

use App\Models\IrnaRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IrnaSeederRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = new IrnaRole();
        $insert->irna_nama = 'Admin';
        $insert->irna_status = 1;
        $insert->save();
    }
}
