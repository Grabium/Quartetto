<?php
namespace Frmk\Http\Response;

abstract class Response
{
    protected Array $data = [];

    public function send(Array|null $data = null): void
    {
        if(is_null($data)){
            echo 'Aplicação não teve nada a responder.';
            die();
        }
        
        $this->data = $data;
        $this->setHead();
        $response = $this->setformact();
        echo $response;
    }

    protected abstract function setHead();

    protected abstract function setformact();
}
