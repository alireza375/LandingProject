<?php

namespace App\Http\Controllers;

use App\Http\Request\CourseRequest;
use App\Http\Service\CourseService;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CourseController extends Controller
{
    private $CourseService;
    public function __construct(CourseService $courseService)
    {
        $this->CourseService=$courseService;
    }

    //All data show
    public function index(Request $request){
        return $this->CourseService->index($request);
    }

    //Data Create Or Update
    public function updateOrcreateCourse(CourseRequest $request){
        if($request->_id){
            return $this->CourseService->update($request);
        }
        else{
            return $this->CourseService->store($request);
        }
    }

    //Single data show
    public function show(Request $request){
        return $this->CourseService->show($request);
    }

    //Data delete
    public function delete(Request $request){
        return $this->CourseService->delete($request);
    }
}
