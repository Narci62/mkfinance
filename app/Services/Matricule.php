<?php

namespace App\Services;

class Matricule {
    public int $length;
    public function __construct($length=8)
    {
        $this->length = $length;
    }

    public function getImat(){
        $nb = "0123456789";
        $input = $nb;
        $strl = strlen($nb);
        $imat = "";

        for($i =0; $i<= $this->length ;$i++){
            $imat .= $input[mt_rand(0,$strl-1)];
        }

        return $imat;
    }
}
