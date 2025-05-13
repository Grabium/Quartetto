<?php
namespace App\Http\Validation;

class MainValidation extends ValidationAbstract implements ValidationInterface
{
    final public function rules(): array
    {
        return [
            'fator:int'    => 'required|min:-11|max:11',
            'texto:string' => 'required|legal'
        ];
    }
}