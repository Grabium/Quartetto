<?php
namespace App\Http\Validation;

abstract class ValidationAbstract implements ValidationInterface
{
    
    abstract public function rules(): array;

    public function sendRules()
    {
        $regrasArr = [];

        foreach ($this->rules() as $campo => $funcoesRegrasString) {
            $regrasArr[$campo] = explode('|', $funcoesRegrasString);
        }

        foreach($regrasArr as $key => $regras){
            list($campo, $tipo) = explode(':', $key, 2);
            $tipo = ucfirst($tipo);
            $classTovalidate = '\\Frmk\\Http\\Validation\\'.$tipo.'Validation';
            try {
                (new $classTovalidate())->run($campo, $regras);
            } catch (\Throwable $th) {
                //throw $th;
            }
            
        }
    }

    public function validated(): array
    {
        $this->sendRules();

        $msgs = \Frmk\Http\Validation\FailureMessageValidation::getMsgs();

        if(count($msgs) == 0){
            return (new \Frmk\Http\Request\Request)->all();
        }

        return $msgs;
    }
}