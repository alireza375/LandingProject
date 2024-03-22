<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FooterRequest;
use App\Http\Services\FooterService;

class FooterController extends Controller
{
    //
    private $footerService;

    public function __construct(FooterService  $footerService)
    {
        $this -> footerService = $footerService;
    }

    public function index(Request $request)
    {
        return $this->footerService->index($request);
    }


    public function UpdateOrAddFooterLogo(FooterRequest $request)
    {
       if($request->_id){
          return $this->footerService->update($request);
        }else{
           return $this->footerService->store($request);
        }
    }



    public function delete(Request $request)
    {
        return $this->footerService->delete($request);
    }

}
