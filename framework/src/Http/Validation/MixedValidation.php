<?php
namespace Frmk\Http\Validation;

use  Frmk\Http\Validation\FailureMessageValidation as Fail;

abstract class MixedValidation extends Validation
{
    abstract public function validateType();

    final public function required(){
        if(($this->valor == null || trim($this->valor) == '' || $this->valor == []) && ($this->valor != "0")){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O preenchimento de "'.$this->campo.'" é obrigatório.'];
            Fail::addMsg($FailureMsg);
        }
    }
    
}