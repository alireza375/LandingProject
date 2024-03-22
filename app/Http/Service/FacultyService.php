<?php

namespace App\Http\Service;

use Exception;
use App\Models\Facultiy;
use PhpParser\Node\Expr\FuncCall;

class FacultyService
{
    public function makeData($request){
        $imageArray = [];
        if($request->hasFile("image")){
        $images = $request->file("image");
        foreach($images as $image){
        $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
       $image->move(public_path("images"), $imageName);
       $imageArray[] = $imageName;
    //    return $image->move(public_path("images"), $imageName);
        }
   }
        $data=[
            "head"=>$request->get("head"),
            "image"=>$imageArray,
            "title"=>$request->get("title"),
            "Faculty_Name"=>$request->get("Faculty_Name"),
        ];
        return $data;
    }

    //All data show
    public function index($request){
        $sort_by = $request->sort_by ?? 'id';
        $dir = $request->dir ?? 'desc';
        $per_page = $request->per_page ?? PERPAGE_PAGINATION;
        $data = Facultiy::select('id as _id', 'head',  'image','title', 'Faculty_Name')->orderBy($sort_by, $dir)->paginate($per_page);
        $faculty =Facultiy::latest()->get();
        return successResponse(__('Faculty fetched successfully.'),$faculty ) ;
    }
    //Data Create
    public function store($request){
        try{
            $data=$this->makeData($request);
            $faculty=Facultiy::create($data);

            $response=[
                "head"=>$faculty->head,
                "image"=>$faculty->image,
                "title"=>$faculty->title,
                "Faculty_Name"=>$faculty->Faculty_Name,
                "_id"=>$faculty->id,
                'createdAt' => $faculty->created_at, // Use the created_at field
                'updatedAt' => $faculty->updated_at,
            ];
            return successResponse(__('Faculty created Successfully'), $response);
        }
        catch (Exception $e) {
            return errorResponse($e->getMessage());
        }

    }
    //Data update
    public function update($request){
        $data=$this->makeData($request);
        $faculty=Facultiy::find($request->_id);
        if(!$faculty){
            return errorResponse(__("Faculty Not Found"));
        }
        try{
            $faculty->update($data);
            return successResponse(__("Faculty Update Successful"));
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }
    }
    //single data show
    public function show($request){
        try{
            if($request->_id){
                $faculty=Facultiy::find($request->_id);
                if(!$faculty){
                    return errorResponse(__("Faculty Not Found"));
                }
            }
            $tranesformData=[
                "head"=>$faculty->head,
                "image"=>$faculty->head,
                "title"=>$faculty->head,
                "Faculty_Name"=>$faculty->head,
                'createdAt' =>$faculty->created_at->toIso8601String(),
                'updatedAt' =>$faculty->updated_at->toIso8601String(),
            ];
            return successResponse(__("Single Faculty Show Successful"),$tranesformData);
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }
    }
    //data delete
    public function delete($request){
        $faculty=Facultiy::find($request->_id);
        if(!$faculty){
            return errorResponse(__("Faculty Not Found"));
        }
        try{
            $faculty->delete();
            return successResponse(__("Faculty Deleted Successful"));
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }
    }
}
