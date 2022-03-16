<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IrnaKamar extends Model
{
    protected $table = 'irna_kamar';

    static function generateNameImages()
    {
        $dmy = "";
        $value = $dmy . date("y") . date("m") . date("d") . date("H") . date("i") . date("s");
        $length = 5;
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomstring = '';
        for($i=0 ; $i < $length; $i++)
        {
            $randomstring .= $characters[rand(0,$charactersLength - 1)];
        }
        return $value."_".$randomstring ;
    }

    
    static function moveImage($imageFile = null, $imageName = null)
    {
        if ($imageFile && $imageName) {
            $path = public_path() . '/asset_admin/img/kamar';
            $uploadimages = $imageFile->move($path, $imageName);
            if ($uploadimages) {
                return 'success';
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
