<?php
namespace Frmk\Http\Validation;

use Frmk\Http\Validation\FailureMessageValidation as Fail;

class StringValidation extends MixedValidation
{
    public function validateType(): bool
    {
        if(!is_string($this->valor)){
            $FailureMsg[] = ['campo'=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" deve conter um texto.'];
            Fail::addMsg($FailureMsg);
            return false;
        }
        
        $this->valor = (string)$this->valor;
        return true;
    }

    public function max()
    {
        $param = (int)$this->param;
        if(strlen($this->valor) > $param){
            $FailureMsg[] = ['campo: '=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" não pode conter mais que '.$this->param.' caracteres.'];
            Fail::addMsg($FailureMsg);
        }
    }

    public function min()
    {
        $param = (int)$this->param;
        if(strlen($this->valor) < $param){
            $FailureMsg[] = ['campo: '=> $this->campo, 'msg'=>'O campo "'.$this->campo.'" não pode conter menos que '.$this->param.' caracteres.'];
            Fail::addMsg($FailureMsg);
        }
    }
}