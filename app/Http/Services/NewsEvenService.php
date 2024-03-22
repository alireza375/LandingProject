<?php

namespace App\Http\Services;

use App\Http\Resources\NewsResource;
use App\Models\Even;
use Illuminate\Http\Request;

class NewsEvenService
{
    public function makeData($request)
    {
        $data = [
            'images' => $request->images,
            'short_description' => $request->input('short_description'),
            'title' => $request->input('title'),
            'date' => $request->input('date'),
        ];
        if($request->hasFile("images")){
            $images = $request->file("images");
            $filename = 'post_image_'.md5('uniqid'). time() .".". $images->getClientOriginalExtension();
            $images->move(public_path("images"), $filename);
           }
        return $data;
    }

    //news list
    public function index()
    {
        // $data = Even::select(
        //     'id as _id',
        //     'title',
        //     'images',
        //     'short_description',
        //     'date',
        //     'created_at as createdAt',
        //     'updated_at as updatedAt'
        // );

        $data = Even::all();
        // $data = NewsResource::collection($data);
        return successResponse(__('portfolio fetched successfully.'), $data);
    }

     //store
     public function store($request)
     {

         try {
             $data = $this->makeData($request);
             $even = Even::create($data);
             $response = [
                 'title' => $even->title,
                 'images' => $even->images,
                 'short_description' => $even->short_description,
                 'date' => $even->date,
                 'createdAt' => $even->created_at,
                 'updatedAt' => $even->updated_at,
             ];
             return successResponse(__('Even created Successfully'), $response);
         } catch (\Exception $e) {
             return errorResponse($e->getMessage());
         }

        return true;
     }




     //update
    //  public function update(Request $request)
    //  {
    //      $data = $this->makeData($request);
    //      $even = even::find($request->_id);
    //      if (!$even) {
    //          return errorResponse(__('Even not found'));
    //      }
    //      // Ensure $prevImages is always an array

    //      try {
    //          $even->update($data);
    //          return successResponse(__('Successfully updated Even'));
    //      } catch (\Exception $e) {
    //          return errorResponse($e->getMessage());
    //      }
    //  }

      public function update(Request $request)
        {
        $even = Even::find($request->_id);
        if (!$even) {
            return errorResponse(__('Even not found.'));
        }
        $data = [
            'title' => $request->title,
            'short_description' => $request->short_description,
            'images' => $request->hasFile('images'),
            'date' => $request->input('date'),
        ];
        $even->update($request->all());
        return successResponse(__('Even Updated Successfully'));
    }



     // Delete Even

     public function delete($request)
     {
         $even = Even::find($request->_id);
         if (!$even) {
             return errorResponse(__('Even not found.'));
         }
         $even->delete();
         return successResponse(__('Even deleted successfully.'));
     }

}
