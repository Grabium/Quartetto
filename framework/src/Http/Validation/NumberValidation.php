<?php
namespace Frmk\Http\Validation;

use Frmk\Http\Validation\FailureMessageValidation as Fail;

class NumberValidation extends MixedValidation
{
    public function validateType(): bool
    {
    
        $number = '^-?\d+([.,]\d+)?$';
        $int = '^-?\d+$';

        if(preg_match('/'.$number.'/', $this->valor) == false && $this->valor != "0"){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" deve ser um número.'];
            Fail::addMsg($FailureMsg);
            return false;
        }
        
        if(preg_match('/'.$int.'/', $this->valor)){
            $this->valor = (int)$this->valor;
            return true;
        }

        $this->valor = (float)$this->valor;
        return true;
    }

    public function min()
    {
        $param = (int)$this->param;
        if($this->valor < $param){
            $FailureMsg[] = ['campo: '=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" não pode ser menor que '.$this->param.'.'];
            Fail::addMsg($FailureMsg);
        }
    }

    public function max()
    {
        $param = (int)$this->param;
        if($this->valor > $param){
            $FailureMsg[] = ['campo: '=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" não pode ser maior que '.$this->param.'.'];
            Fail::addMsg($FailureMsg);
        }
    }
}