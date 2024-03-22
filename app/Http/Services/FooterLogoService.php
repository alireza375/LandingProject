<?php

namespace App\Http\Services;

use App\Models\Footer_Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class FooterLogoService
{
    public function makeData($request)
    {
        $imageArray = [];
        if($request->hasFile("logo")){
            $images = $request->file("logo");
            foreach($images as $image){
                $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
               $image->move(public_path("images"), $imageName);
               $imageArray[] = $imageName;
                }
           }

        $data = [
            'logo' =>$imageArray,
            'short_description' => $request->input('short_description'),
        ];

        return $data;
    }

    public function index()
    {
        $data = Footer_logo::all();
        return successResponse(__('Footer Section fetched successfully.'), $data);
    }


    public function store($request)
    {
       // return "Banner Store";

        try {
            $data = $this->makeData($request);
            $footer = Footer_logo::create($data);
            $response = [
                'logo' => $footer->logo,
                'short_description' => $footer->short_description,
                'createdAt' => $footer->created_at,
                'updatedAt' => $footer->updated_at,
            ];
            return successResponse(__('Footer Section Created Successfully'), $response);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }

       return true;
    }



    public function update(Request $request)
    {
        $foot = Footer_logo::find($request->_id);
        if (!$foot) {
            return errorResponse(__('Footer Section not found.'));
        }
         // Get the old image names
         $oldImages = $foot->image ?? [];

         // Ensure $oldImages is always an array
         $oldImages = is_array($oldImages) ? $oldImages : [$oldImages];

         // Remove old images from the public/images folder
         foreach ($oldImages as $oldImage) {
             // Ensure $oldImage is a string
             if (is_string($oldImage)) {
                 $oldImagePath = public_path("images/{$oldImage}");
                 if (File::exists($oldImagePath)) {
                     File::delete($oldImagePath);
                 }
             }
         }

         $imageArray = [];
         if ($request->hasFile("logo")) {
             $images = $request->file("logo");
             foreach ($images as $image) {
                 $imageName = 'post_image_' . md5(uniqid()) . time() . "." . $image->getClientOriginalExtension();
                 $image->move(public_path("images"), $imageName);
                 $imageArray[] = $imageName;
             }
         }

         // Update the banner's fields with the new data
         $data = [
             "logo" => $imageArray,
             "short_description" => $request->short_description,
         ];
        $foot->update($request->all());
        return successResponse(__('Footer Section Updated Successfully'));
    }



    public function delete($request)
    {
        $foot = Footer_logo::find($request->_id);
        if (!$foot) {
            return errorResponse(__('Footer Section not found.'));
        }
        $foot->delete();
        return successResponse(__('Footer Section deleted successfully.'));
    }



}
