<?php
namespace Frmk\Http\Validation;

use  Frmk\Http\Validation\FailureMessageValidation as Fail;

abstract class MixedValidation extends Validation
{
    abstract public function validateType();

    final public function required(){
        if($this->valor === '' ){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O preenchimento de "'.$this->campo.'" é obrigatório.'];
            Fail::addMsg($FailureMsg);
        }
    }
    
}
// && ($this->valor != "0")