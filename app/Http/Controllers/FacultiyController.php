<?php

namespace App\Http\Controllers;

use App\Http\Request\FacultyRequest;
use App\Http\Service\FacultyService;
use Illuminate\Http\Request;

class FacultiyController extends Controller
{
    private $FacultyService;
    public function __construct(FacultyService $facultyService)
    {
        $this->FacultyService=$facultyService;
    }

    //All data show
    public function index(Request $request){
        return $this->FacultyService->index($request);
    }

    //Data update or Delete
    public function updateOrCreateFaculty(FacultyRequest $request){
        if($request->_id){
            return $this->FacultyService->update($request);
        }
        else{
            return $this->FacultyService->store($request);
        }
    }

    //Single data show
    public function show(Request $request){
        return $this->FacultyService->show($request);
    }

    //Data delete
    public function delete(Request $request){
        return $this->FacultyService->delete($request);
    }
}
