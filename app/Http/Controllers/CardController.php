<?php

namespace App\Http\Controllers;

use App\Http\Request\CardRequest;
use App\Http\Service\CardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CardController extends Controller
{
    private $CardService;
    public function __construct(CardService $cardService){
        $this->CardService=$cardService;

    }

    //All data show
    public function index(Request $request){
        return $this->CardService->index($request);
    }

    //Data create Or Update
    public function updateOrcreate(CardRequest $request){
        if($request->_id){
            return $this->CardService->update($request);
        }
        else{
            return $this->CardService->store($request);
        }
    }

    //single card show
    public function show(Request $request){
        return $this->CardService->show($request);
    }

    //delete
    public function delete(Request $request){
        return $this->CardService->delete($request);
    }
    
}
