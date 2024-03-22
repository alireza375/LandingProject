<?php

namespace App\Http\Services;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerService
{

    public function makeData($request)
    {

        $imageArray = [];
        if($request->hasFile("image")){
            $images = $request->file("image");
            foreach($images as $image){
                $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
               $image->move(public_path("images"), $imageName);
               $imageArray[] = $imageName;
                }
           }

        $logoName = null;
        if($request->hasFile("logo")){
            $logo = $request->file("logo");
            $logoName = 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
            $logo->move(public_path("logos"), $logoName);
           }

        $data = [
            'navber' =>$request->navber,
            'logo' =>$logo,
            'image' => $imageArray,
            'short_description' => $request->input('short_description'),
            'title' => $request->input('title'),
        ];

        return $data;
    }


    public function index()
    {
        $data = Banner::all();
        return successResponse(__('Banner fetched successfully.'), $data);
    }

    // Store Video
    public function store($request)
     {
        // return "Banner Store";

         try {
             $data = $this->makeData($request);
             $banner = Banner::create($data);
             $response = [
                 'navber' => $banner->navber,
                 'logo' => $banner->logo,
                 'title' => $banner->title,
                 'short_description' => $banner->short_description,
                 'image' => $banner->image,
                 'createdAt' => $banner->created_at,
                 'updatedAt' => $banner->updated_at,
             ];
             return successResponse(__('Banner Created Successfully'), $response);
         } catch (\Exception $e) {
             return errorResponse($e->getMessage());
         }

        return true;
     }


    public function update(Request $request)
    {
        $banner = Banner::find($request->_id);
        if (!$banner) {
            return errorResponse(__('Banner not found.'));
        }
         // Get the old image names
         $oldImages = $banner->image ?? [];

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
         if ($request->hasFile("image")) {
             $images = $request->file("image");
             foreach ($images as $image) {
                 $imageName = 'post_image_' . md5(uniqid()) . time() . "." . $image->getClientOriginalExtension();
                 $image->move(public_path("images"), $imageName);
                 $imageArray[] = $imageName;
             }
         }

         $logoName = null;
         if ($request->hasFile("logo")) {
             $logo = $request->file("logo");
             $logoName = 'post_image_' . md5(uniqid()) . time() . "." . $logo->getClientOriginalExtension();
             $logo->move(public_path("logos"), $logoName);
         }

         // Update the banner's fields with the new data
         $data = [
             "navber" => $request->navber,
             "logo" => $logoName,
             "title" => $request->title,
             "short_description" => $request->short_description,
             "image" => $imageArray,
         ];
        $banner->update($request->all());
        return successResponse(__('Banner Updated Successfully'));
    }




    public function delete($request)
    {
        // return $request->_id;
        $banner = Banner::find($request->_id);
        if (!$banner) {
            return errorResponse(__('Banner not found.'));
        }
        $banner->delete();
        return successResponse(__('Banner deleted successfully.'));
    }


}
