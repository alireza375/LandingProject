<?php

namespace App\Http\Service;

use Exception;
use App\Models\Course;

class CourseService
{

    public function makeData($request){
        $data=[
            "head"=>$request->get("head"),
            "title"=>$request->get("title"),
            "short_dec"=>$request->get("short_dec"),
        ];
        return $data;
    }

    //All data show
    public function index($request){
        $sort_by = $request->sort_by ?? 'id';
        $dir = $request->dir ?? 'desc';
        $per_page = $request->per_page ?? PERPAGE_PAGINATION;
        $data = Course::select('id as _id', 'head', 'title', 'short_dec')->orderBy($sort_by, $dir)->paginate($per_page);
        $course =Course::latest()->get();
        return successResponse(__('Course fetched successfully.'),$course) ;

    }
    //Data Create
    public function store($request){
        try{
            $data=$this->makeData($request);
            $course=Course::create($data);

            $response=[
                "head"=>$course->head,
                "title"=>$course->title,
                "short_dec"=>$course->short_dec,
                "_id"=>$course->id,
                'createdAt' => $course->created_at, // Use the created_at field
                'updatedAt' => $course->updated_at,
            ];
            return successResponse(__('Course created Successfully'), $response);
        }
        catch (Exception $e) {
            return errorResponse($e->getMessage());
        }
    }
    //Data Upate
    public function update($request){
        $data=$this->makeData($request);
        $course=Course::find($request->_id);
        if(!$course){
            return errorResponse(__("Course Is Not Found"));
        }
        try{
            $course->update($data);
            return successResponse(__("Course update Successful"));
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }

    }
    //Single Data show
    public function show($request){
        try{
            if($request->_id){
                $course=Course::find($request->_id);
                if(!$course){
                    return errorResponse(__("Course is Not Found"));
                }
            }
            $tranesformData=[
                "head"=>$course->head,
                "title"=>$course->title,
                "short_dec"=>$course->short_dec,
                'createdAt' =>$course->created_at->toIso8601String(),
                'updatedAt' =>$course->updated_at->toIso8601String(),

            ];
            return successResponse(__("Course Show Successful"),$tranesformData);
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }
    }
    //Data delete
    public function delete($request){
        $course=Course::find($request->_id);
        if(!$course){
            return errorResponse(__("Course Not Found"));
        }
        try{
            $course->delete();
            return successResponse(__("Card deleted Successful"));
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }
    }
}
