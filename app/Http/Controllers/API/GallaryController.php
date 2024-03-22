<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\GalaryService;
use App\Http\Requests\GallaryRequest;

class GallaryController extends Controller
{
    //
    private $gallaryService;

    public function __construct(GalaryService  $gallaryService)
    {
        $this -> gallaryService = $gallaryService;
    }

    public function index(Request $request)
    {
        return $this->gallaryService->index($request);
    }


    public function UpdateOrAddGallary(GallaryRequest $request)
    {
       if($request->_id){
          return $this->gallaryService->update($request);
        }else{
           return $this->gallaryService->store($request);
        }
    }

     //delete
     public function delete(Request $request)
     {
        // return $request->all();
        return $this->gallaryService->delete($request);
     }


}
