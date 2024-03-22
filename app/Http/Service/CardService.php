<?php

namespace App\Http\Service;

use Exception;
use App\Models\InspirationCard;


class CardService
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
    //    return $image->move(public_path("images"), $imageName);
    
    $data=[
        "missonName"=> $request->missonName,
        "sort_dec"=> $request->sort_dec,
        "image"=>$imageArray
    ];
    return $data;
        }
   

               
    
    public function index($request){
        $sort_by = $request->sort_by ?? 'id';
        $dir = $request->dir ?? 'desc';
        $per_page = $request->per_page ?? PERPAGE_PAGINATION;
        $data = InspirationCard::select('id as _id', 'missonName', 'sort_dec', 'image')->orderBy($sort_by, $dir)->paginate($per_page);
        $card =InspirationCard::latest()->get();
        return successResponse(__('Card fetched successfully.'),$card) ;
    }

    //Data create
    public function store($request){
        try{
            $data=$this->makeData($request);
            $card=InspirationCard::create($data);

            $response=[
                "missonName"=>$card->missonName,
                "sort_dec"=>$card->sort_dec,
                "image"=>$card->image,
                "_id"=>$card->id,
                'createdAt' => $card->created_at, // Use the created_at field
                'updatedAt' => $card->updated_at,

            ];
            return successResponse(__('Portfolio created Successfully'), $response);
        }
        catch (Exception $e) {
            return errorResponse($e->getMessage());
        }
    }

    //Data Update
    public function update($request){
        $data = $this->makeData($request);
        $InspirationCard = InspirationCard::find($request->_id);
        if (!$InspirationCard) {
            return errorResponse(__('InspirationCard not found'));
        }
        try {
            $InspirationCard->update($data);
            return successResponse(__('InspirationCard updated successfully'));
        } catch (Exception $e) {
            return errorResponse($e->getMessage());
        }

    }

    //Single Card show
    public function show($request){
        try{
            if($request->_id){
                $card=InspirationCard::find($request->_id);
                if(!$card){
                    return errorResponse(__("Card Is not Found"));
                }
            }
            $tranesformData=[
                "missonName"=>$card->missonName,
                "sort_dec"=>$card->sort_dec,
                "image"=>$card->image,
                'createdAt' =>$card->created_at->toIso8601String(),
                'updatedAt' =>$card->updated_at->toIso8601String(),

            ];
            return successResponse(__("Card Show Successful"),$tranesformData);
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }
    }

    //delete
    public function delete($request){
        $card=InspirationCard::find($request->_id);
        if(!$card){
            return errorResponse(__("InpirationCard Not Found"));
        }
        try{
            $card->delete();
            return successResponse(__("Inpiration Card Deleted"));
        }
        catch(Exception $e){
            return errorResponse(__($e->getMessage()));
        }
    }

}
