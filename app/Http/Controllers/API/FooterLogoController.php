<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FooterLogoRequest;
use App\Http\Services\FooterLogoService;

class FooterLogoController extends Controller
{
    //
    private $footerlogoService;

    public function __construct(FooterLogoService  $footerlogoService)
    {
        $this -> footerlogoService = $footerlogoService;
    }

    public function index(Request $request)
    {
        return $this->footerlogoService->index($request);
    }


    public function UpdateOrAddFooterLogo(FooterLogoRequest $request)
    {
       if($request->_id){
          return $this->footerlogoService->update($request);
        }else{
           return $this->footerlogoService->store($request);
        }
    }



    public function delete(Request $request)
    {
        return $this->footerlogoService->delete($request);
    }
}
