<?php
namespace Frmk\Http\Validation;

use  Frmk\Http\Validation\FailureMessageValidation as Fail;

class FloatValidation extends NumberValidation
{
    final public function validateType(): bool
    {
    
        $regex = '^-?\d+([.,]\d+)$';

        if(preg_match('/'.$regex.'/', trim($this->valor)) == false){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" deve ser um número ponto-flutuante.'];
            Fail::addMsg($FailureMsg);
            return false;
        }
        
        $this->valor = str_replace(",", ".", $this->valor);
        $this->valor = (float)$this->valor;
        echo $this->valor;
        return true;
    }
}