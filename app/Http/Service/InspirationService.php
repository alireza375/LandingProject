<?php

namespace App\Http\Service;

use App\Models\Inspiration;
use Exception;
use GuzzleHttp\Psr7\Request;
use PhpParser\Node\Expr\FuncCall;

class InspirationService
{
    public function makeData($request){
        $data=[
            "head"=> $request->head,
            "sort_dec"=> $request->sort_dec,
            "heading_tag"=> $request->heading_tag,
            "mvg"=> $request->mvg,
        ];
        return $data;
    }

    public function index($request){
        $inspiration =Inspiration::latest()->get();
        return $inspiration;
    }
    public function store($request){
        try{
            $data = $this->makeData($request);
            $inspiration=Inspiration::create($data);

            $response=[
                "head"=>$inspiration->head,
                "sort_dec"=>$inspiration->sort_dec,
                "heading_tag"=>$inspiration->heading_tag,
                "mvg"=>$inspiration->mvg,
                "_id"=>$inspiration->id,
                'createdAt' => $inspiration->created_at, 
                'updatedAt' =>$inspiration->updated_at,
            ];
            return response()->json([
                "status"=>true,
                "message"=>"Inspiration Create Successful", $inspiration
            ]);

        }
        catch(Exception $e){
            return response()->json([
                "status"=>false,
                "message"=>$e->getMessage()

            ]);
        }
         

    }

    //update
    public function update($request){
        try{

            $data = $this->makeData($request);
                $inspiration = Inspiration::findOrFail($request->_id);
                $inspiration->update($data);
                return response()->json([
                    "status"=>"Successfull",
                    "Message"=>"update Successfull"
                   ]);
                

        }

        catch(Exception $e){
            return response()->json([
                "status"=>"Faild",
                "message"=>$e->getMessage()
            ],200);

    }
    }
    public function show($request){
        try{
        if ($request->_id) {
            $data = Inspiration::find($request->_id);
            if (!$data) {
                return('Internal Server Error');
            }

            $tranesformData=[
                "head"=> $data->head,
                "sort_dec"=> $data->sort_dec,
                "heading_tag"=> $data->heading_tag,
                "mvg"=> $data->mvg,
                "id"=> $data->id,
                'createdAt' => $data->created_at->toIso8601String(),
                'updatedAt' => $data->updated_at->toIso8601String(),

            ];
            return response()->json([
                "status"=>true,
                "Message"=>"successful data show", $tranesformData
            ]);
    }
}
catch(Exception $e){
    return response()->json([
        "status"=>false,
        "status"=>$e->getMessage()
    ]);

}

    }

    //delete
    public function delete($request){
        try{
            $inspiration = Inspiration::findOrFail($request->_id);
            $inspiration->delete();
            
            return response()->json([
                "status"=>"Successfull",
                "Message"=>"deleted Successfull"
               ]);

        }

        catch(Exception $e){
            return response()->json([
                "status"=>"Faild",
                "message"=>$e->getMessage()
            ],200);

    }
    }
}

