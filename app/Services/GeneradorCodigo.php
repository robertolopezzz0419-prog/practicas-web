<?php

namespace App\Services;

class GeneradorCodigo
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

   public function generar(): string
   {
    return(string) random_int(100000, 999999);
   }
}
