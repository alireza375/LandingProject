<?php

namespace App\Http\Services;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterService
{
    public function makeData($request)
    {
        $logoName = null;
        if($request->hasFile("logo")){
            $logo = $request->file("logo");
            $logoName = 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
            $logo->move(public_path("logos"), $logoName);
           }

        $data = [
            'logo' =>$logo,
            'short_description' => $request->input('short_description'),
            'quick_link' => $request->input('quick_link'),
            'support' => $request->input('support'),
            'contact' => $request->input('contact')
        ];

        return $data;
    }


    public function index()
    {
        $data = Footer::all();
        return successResponse(__('Footer fetched successfully.'), $data);
    }


    public function store($request)
     {
        // return "Banner Store";

         try {
             $data = $this->makeData($request);
             $footer = Footer::create($data);
             $response = [
                 'logo' => $footer->logo,
                 'short_description' => $footer->short_description,
                 'quick_link' => $footer->quick_link,
                 'support' => $footer->support,
                 'contact' => $footer->contact,
                 'createdAt' => $footer->created_at,
                 'updatedAt' => $footer->updated_at,
             ];
             return successResponse(__('Footer Created Successfully'), $response);
         } catch (\Exception $e) {
             return errorResponse($e->getMessage());
         }

        return true;
     }



    public function update(Request $request)
    {
        $footer = Footer::find($request->_id);
        if (!$footer) {
            return errorResponse(__('Even not found.'));
        }

        $logoName = null;
         if ($request->hasFile("logo")) {
             $logo = $request->file("logo");
             $logoName = 'post_image_' . md5(uniqid()) . time() . "." . $logo->getClientOriginalExtension();
             $logo->move(public_path("logos"), $logoName);
         }
        $data = [
            'logo' => $logoName,
            'short_description' => $request->short_description,
            'quick_link' => $request->quick_link,
            'support' => $request->support,
            'contact' => $request->contact,
        ];
        $footer->update($request->all());
        return successResponse(__('Footer Updated Successfully'));
    }



    public function delete($request)
    {
        $footer = Footer::find($request->_id);
        if (!$footer) {
            return errorResponse(__('Footer not found.'));
        }
        $footer->delete();
        return successResponse(__('Footer deleted successfully.'));
    }


}
