<?php

namespace App\Http\Services;

use App\Models\Notice;
use Illuminate\Http\Request;


class NoticeService
{
    public function makeData($request)
    {
        $data = [
            'title' => $request->input('title'),
            'date' => $request->input('date'),
        ];
        return $data;
    }

    public function index()
    {

        $data = Notice::all();
        // $data = NewsResource::collection($data);
        return successResponse(__('portfolio fetched successfully.'), $data);
    }

    public function store($request )
    {
        // return "Store Done";
        try {
            $data = $this->makeData($request);
            $notice = Notice::create($data);
            $response = [
                'title' => $notice->title,
                'date' => $notice->date,
                'createdAt' => $notice->created_at,
                'updatedAt' => $notice->updated_at,
            ];
            return successResponse(__('Notice created Successfully'), $response);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }


    }




     public function update(Request $request)
    {
       $notice = Notice::find($request->_id);
       if (!$notice) {
           return errorResponse(__('Notice not found.'));
       }
       $data = [
           'title' => $request->title,
           'date' => $request->input('date'),
       ];
       $notice->update($request->all());
       return successResponse(__('Notice Updated Successfully'));
   }



   public function delete($request)
   {
       $notice = Notice::find($request->_id);
       if (!$notice) {
           return errorResponse(__('Notice not found.'));
       }
       $notice->delete();
       return successResponse(__('Notice deleted successfully.'));
   }


}
