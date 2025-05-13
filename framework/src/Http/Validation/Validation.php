<?php
namespace Frmk\Http\Validation;

use Frmk\Http\Request\Request;
use  Frmk\Http\Validation\FailureMessageValidation as Fail;
use TypeError;


abstract class Validation
{
    protected array $rules = [];
    protected string $campo;
    protected mixed $valor;
    protected string|null $param;

    abstract public function validateType();
    
    public function run(string $campo, array $regras)
    {
        $valor = (new Request)->get($campo);
        $this->valor = $valor;
        $this->campo = $campo;

        if($regras[0] == 'required'){
            array_shift($regras);
            $this->required();
        }
    
        if(!$this->validateType()){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=> 'O campo "'.$this->campo.'" não é compatível com o tipo escolhido.'];
            Fail::addMsg($FailureMsg);
            return;
        }

        foreach($regras as $funcR){
            
            $funcaoRegra = $funcR;
            $this->param = null;//parâmetro da validação. NÃO É VALOR DO CAMPO.

            if(strpos($funcaoRegra, ':')){
                list($funcaoRegra, $param) = explode(':', $funcR, 2);
                $this->param = $param;
            }

            $this->callValidator($funcaoRegra);
        }
    }

    public function callValidator($funcaoRegra)
    {
        try {
            
            $this->$funcaoRegra();
        
        }catch (\Error $e) {
            echo 'Error: Função de validação inexistente: '.get_class($e).' - '.$e->getMessage().PHP_EOL;
            die();
        }
    }

    private function required()
    {
        if($this->valor === '' ){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O preenchimento de "'.$this->campo.'" é obrigatório.'];
            Fail::addMsg($FailureMsg);
        }
    }
}