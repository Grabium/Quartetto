<?php
namespace Frmk\Http\Validation;

use Frmk\Http\Request\Request;
use  Frmk\Http\Validation\FailureMessageValidation as Fail;
use TypeError;


abstract class Validation
{
    //protected Request $request;
    protected array $rules = [];
    protected string $campo;
    protected mixed $valor;
    protected string|null $param;

    //abstract public function setValor(mixed $valor);

    abstract public function validateType();
    
    public function run(string $campo, array $regras)
    {
        $valor = (new Request)->get($campo);
        $this->valor = $valor;
        $this->campo = $campo;

    
        if(!$this->validateType()){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=> 'O campo "'.$this->campo.'" não é compatível com o tipo escolhido.'];
            Fail::addMsg($FailureMsg);
            return;
        }
        

        //itera e chama as funções/regras do campo atual.
        foreach($regras as $key => $funcR){
            
            $funcaoRegra = $funcR;
            $this->param = null;
            
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
}