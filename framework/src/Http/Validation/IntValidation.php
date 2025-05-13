<?php
namespace Frmk\Http\Validation;

use  Frmk\Http\Validation\FailureMessageValidation as Fail;

class IntValidation extends NumberValidation
{
    final public function validateType(): bool
    {
    
        print('int validation ='.$this->valor.PHP_EOL);
        $regex = '^-?([0123456789])+$';
        print( gettype(($this->valor)).PHP_EOL);



        if(!preg_match('/'.$regex.'/', $this->valor)){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" deve ser um número inteiro.'];
            Fail::addMsg($FailureMsg);
            return false;
        }
        
        $this->valor = (int)$this->valor;
        return true;
        
        

    }
}