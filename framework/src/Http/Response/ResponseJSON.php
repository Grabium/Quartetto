<?php
namespace Frmk\Http\Response;

final class ResponseJSON extends Response
{
    protected function setHead():void
    {
        header('Content-Type: application/json');
    }

    //fazer um try-catch.
    protected function setformact(): string
    {
        return json_encode(['code' => 200, 'data' => $this->data], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
    }
}