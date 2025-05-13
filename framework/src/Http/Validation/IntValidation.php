<?php
namespace Frmk\Http\Validation;

use  Frmk\Http\Validation\FailureMessageValidation as Fail;

class IntValidation extends NumberValidation
{
    final public function validateType(): bool
    {
    
        $regex = '^-?\d+$';

        if(preg_match('/'.$regex.'/', trim($this->valor)) == false ){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" deve ser um número inteiro.'];
            Fail::addMsg($FailureMsg);
            return false;
        }
        
        $this->valor = (int)$this->valor;
        return true;
        
        

    }
}