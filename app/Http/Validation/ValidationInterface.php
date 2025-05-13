<?php
namespace App\Http\Validation;

interface ValidationInterface
{
    public function rules(): array;

    public function sendRules();
}