<?php

namespace App\Controllers\Session;

class Compteur{
    public $fichier;
    // $fichier = dirname(dirname(dirname(dirname(__DIR__)))).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'compteur';

    public function __construct($fichier)
    {
        $this->fichier = $fichier;
    }

    public function increment_vue(): void{
        $compteur = 1;
        if(file_exists($this->fichier)){
            $compteur = (int)file_get_contents($this->fichier, $compteur);
            $compteur++;
        }
        file_put_contents($this->fichier, $compteur);
    }

    public function nombre_vue(): int{
        if(!file_exists($this->fichier)){
            return 0;
        }
        return file_get_contents($this->fichier);
    }
}