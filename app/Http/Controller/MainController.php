<?php
namespace App\Http\Controller;

use App\Http\Validation\MainValidation;

class MainController extends Controller
{

    public function rotaraiz()
    {
        $this->response->send(['requisicao_original' => $this->request->all(), 'msg' => 'fluxo GET']);
    }

    public function rotapost()
    {
        (new MainValidation)->sendRules();
        $failureMsgs = $this->response->send(['requisicao_original' => $this->request->all(), 'msg' => 'fluxo POST']);
    }
}