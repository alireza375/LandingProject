<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\NewsEvenService;
use App\Http\Requests\NewsRequest;

class NewsAndEventController extends Controller
{
    //
    private $newseventService;

    public function __construct(NewsEvenService  $newseventService)
    {
        $this -> newseventService = $newseventService;
    }

    //News and even list show
    public function index(Request $request)
    {
        return $this->newseventService->index($request);
    }

    



    //add News and Even
    public function updateOrAddnews(NewsRequest $request)
    {
       if($request->_id){
          return $this->newseventService->update($request);
        }else{
           return $this->newseventService->store($request);
        }
    }

     //delete
     public function delete(Request $request)
     {
         return $this->newseventService->delete($request);
     }


}
