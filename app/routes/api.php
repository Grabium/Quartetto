<?php

use Frmk\Routing\Route;
use App\Http\Controller\MainController;

// Definindo um handler como uma função anônima
Route::get('anonima', '/anonima', function () {
    echo "Wellcome to anonima function!";
});

Route::get('raiz', '/', [MainController::class, 'rotaraiz']);
Route::post('rotapost', '/rp', [MainController::class, 'rotapost']);