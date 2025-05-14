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
        $request = (new MainValidation)->validated();
        $this->response->send(['requisicao_original' => $request, 'msg' => 'fluxo POST']);
    }
}