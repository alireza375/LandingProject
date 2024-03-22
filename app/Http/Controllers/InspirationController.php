<?php

namespace App\Http\Controllers;

use App\Http\Request\InspirationRequest;
use Illuminate\Http\Request;
use App\Http\Service\InspirationService;

class InspirationController extends Controller
{
    private $InspirationService;
    public function __construct(InspirationService $inspirationService){
        $this->InspirationService=$inspirationService;
    }

    //All data show
    public function index(Request $request){
       return $this->InspirationService->index($request);
    }

    //Inspiration Create
    public function storeUpdateInspiration(InspirationRequest $request){
        if($request->_id){
            $this->InspirationService->update($request);
        }
        else{
            return $this->InspirationService->store($request);
        
        }
      
    }

    public function show(Request $request){
        return $this->InspirationService->show($request);
       

    }

    //delete
    public function delete(Request $request){
        return $this->InspirationService->delete($request);
    }
}
