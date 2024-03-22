<?php

use Illuminate\Support\Str;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


function errorResponse($message = null, $status = 400, $data = null,)
{
    $message = $message ? $message :  'Something went wrong';
    $response  = ['error' => true, 'status' => $status, 'msg' => $message, 'data' =>  $data];
    return response()->json($response, $status);
}

function successResponse($message = null, $data = null, $status = 200)
{
    $message = $message ? $message :  'success';
    $response  = ['error' => false, 'status' => $status, 'msg' => $message, 'data' =>  $data];
    return response()->json($response, $status);
}


/**
 * File upload
 */
function fileUploadAWS($file, $path, $old_file = null)
{
    try {
        $fileObj = Storage::disk('s3')->put($path, $file, 'public');
        $url = Storage::disk('s3')->url.($fileObj);
        // return ["url" => $url,"status" => true];
        if ($old_file != null) {
            $file = explode(IMAGE_URL, $old_file);
            Storage::disk('s3')->delete($file[1]);
        }
        return $url;
    } catch (Exception $e) {
        // return ["status" => false, "message" => $e->getMessage()];
        return $e->getMessage();
    }
}

function fileRemoveAWS($path)
{
    if (Storage::disk('s3')->delete($path)) {
        return true;
    } else {
        return false;
    }
}



function uploadMultipleImages($files)
{
    $images = [];
    foreach ($files as $file) {
        $images[] = fileUploadAWS($file, IMAGE_PATH);
    }
    return $images;
}


function fileUploadLocal($file, $path, $old_file = null)
{
    try {
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }
        $file_name = time() . '_' . randomNumber(16) . '_' . $file->getClientOriginalName();
        $destinationPath = public_path($path);

        $file_name = str_replace(' ', '_', $file_name);
        # old file delete
        if ($old_file) {
            removeFileLocal($path, $old_file);
        }
        # resize image
        // if (filesize($file) / 1024 > 2048) {

        //     // enable extension=gd2
        //     // $file->orientate(); //so that the photo does not rotate automatically

        //     Image::make($file)->orientate()->save($destinationPath . $file_name, 60);
        //     // quality = 60 low, 75 medium, 80 original
        // } else {
        //     #original image upload
        //     $file->move($destinationPath, $file_name);
        // }

        $file->move($destinationPath, $file_name);

        return $file_name;
    } catch (Exception $e) {
        return null;
    }
}

// function removeFile($path)
// {
//     try {
//         if (file_exists(public_path($path))) {
//             unlink(public_path($path));
//         }
//     } catch (Exception $e) {
//         return null;
//     }

// }

function removeFileLocal($path, $old_file)
{
    $url =  public_path($path);
    $old_file_name = str_replace($url . '/', '', $old_file);

    if (isset($old_file) && $old_file != "" && file_exists($path . $old_file_name)) {
        unlink($path . $old_file_name);
    }
    return true;
}


/**
 * Random number
 */
function randomNumber($a = 10)
{
    $x = '0123456789';
    $c = strlen($x) - 1;

    $z = rand(1, $c);       # first number never taken 0

    for ($i = 0; $i < $a - 1; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }

    return $z;
}

/**
 * unique slug for products
 */
function slug($mode, $name, $id = null)
{
    $slugInc = null;
    $productData['slug'] = Str::slug($name);

    do {
        $productData['slug'] = $slugInc ? Str::slug($name . '_' . $slugInc) : Str::slug($name);
        if ($id) {
            $existSlug = $mode::where('slug', $productData['slug'])->where('id', '!=', $id)->exists();
        } else {
            $existSlug = $mode::where('slug', $productData['slug'])->exists();
        }
        if ($slugInc >= 1) {
            $slugInc++;
        } else {
            $slugInc = 1;
        }
    } while ($existSlug);

    return  $productData['slug'];
}
