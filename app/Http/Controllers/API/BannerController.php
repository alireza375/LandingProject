<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Http\Services\BannerService;

class BannerController extends Controller
{
    //
    private $bannerService;

    public function __construct(BannerService  $bannerService)
    {
        $this -> bannerService = $bannerService;
    }

    public function index(Request $request)
    {
        return $this->bannerService->index($request);
    }



    public function UpdateOrAddBanner(BannerRequest $request)
    {
       if($request->_id){
          return $this->bannerService->update($request);
        }else{
           return $this->bannerService->store($request);
        }
    }



    public function delete(Request $request)
    {
       // return $request->all();
       return $this->bannerService->delete($request);
    }
}
