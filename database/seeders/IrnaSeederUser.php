<?php

namespace Database\Seeders;

use App\Models\IrnaUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IrnaSeederUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = new IrnaUser();
        $insert->irna_nama      = 'Admin';
        $insert->irna_username  = 'admin';
        $insert->irna_password  = md5(sha1(md5('admin')));
        $insert->irna_status    = 1;
        $insert->irna_role      = 1;
        $insert->save();
    }
}
