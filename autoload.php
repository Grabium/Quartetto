<?php

const locais_reais = [__DIR__.'\\framework\\src\\', __DIR__.'\\app\\'];
const nomes = ['Frmk\\', 'App\\'];

spl_autoload_register(function($nameSpaceClasse){

    $caminho = $nameSpaceClasse.'.php';
    $caminho = str_replace(nomes, locais_reais, $caminho);
    $caminho = str_replace('\\', DIRECTORY_SEPARATOR, $caminho);

    if(file_exists($caminho)){
        require_once $caminho;
    }else{
        $msg = '['.$nameSpaceClasse.'] Foi chamada mas ['.$caminho.'] Não existe! - ';
        echo 'Autoload FRAMEWORK - Error: '.$msg;
    }
});