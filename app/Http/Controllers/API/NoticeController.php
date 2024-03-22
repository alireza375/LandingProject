<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoticeRequest;
use App\Http\Services\NoticeService;

class NoticeController extends Controller
{
    //
    private $noticeService;

    public function __construct(NoticeService  $noticeService)
    {
        $this -> noticeService = $noticeService;
    }

    // Notice list show
    public function index(Request $request)
    {
        return $this->noticeService->index($request);
    }





    //add News and Even
    public function UpdateOrAddNotice(NoticeRequest $request)
    {
       if($request->_id){
          return $this->noticeService->update($request);
        }else{
           return $this->noticeService->store($request);
        }
    }

     //delete
     public function delete(Request $request)
     {
         return $this->noticeService->delete($request);
     }


}

