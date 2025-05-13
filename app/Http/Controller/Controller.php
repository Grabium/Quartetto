<?php
namespace App\Http\Controller;

use Frmk\Http\Request\Request;
use Frmk\Http\Response\ResponseJSON;


abstract class Controller
{

    protected      Request $request  ;
    protected ResponseJSON $response ;

    public function __construct()
    {
        $this->request  = new Request();
        $this->response = new ResponseJSON();
    }
}