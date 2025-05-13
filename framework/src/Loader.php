<?php
namespace Frmk;

use Frmk\Routing\Route;

class Loader
{
    public function start(): void
    {
        Route::resolve(null);//Chama proxy (representante).
    }   
}