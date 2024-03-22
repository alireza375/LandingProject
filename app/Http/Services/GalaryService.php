<?php

namespace App\Http\Services;

use App\Models\Gellary;
use Illuminate\Http\Request;

class GalaryService
{

    public function makeData($request)
    {
        $data = [
            'video' => $request->video,
        ];
        return $data;
    }


    public function index()
    {
        $data = Gellary::all();
        return successResponse(__('Gallary fetched successfully.'), $data);
    }

// Store Video
    public function store($request)
     {

         try {
             $data = $this->makeData($request);
             $gallary = Gellary::create($data);
             $response = [
                 'video' => $gallary->video,
                 'createdAt' => $gallary->created_at,
                 'updatedAt' => $gallary->updated_at,
             ];
             return successResponse(__('Video Upload Successfully'), $response);
         } catch (\Exception $e) {
             return errorResponse($e->getMessage());
         }

        return true;
     }


// update Video

      public function update(Request $request)
    {
        $gallary = Gellary::find($request->_id);
        if (!$gallary) {
            return errorResponse(__('Gellary not found.'));
        }
        $data = [
            'video' => $request->video,
        ];
        $gallary->update($request->all());
        return successResponse(__('Gallay Updated Successfully'));
    }


    public function delete($request)
    {
        // return $request->_id;
        $gallary = Gellary::find($request->_id);
        if (!$gallary) {
            return errorResponse(__('Gallary not found.'));
        }
        $gallary->delete();
        return successResponse(__('Gallary deleted successfully.'));
    }


}
