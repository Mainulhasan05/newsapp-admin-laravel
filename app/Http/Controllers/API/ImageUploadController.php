<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    /**
     * Upload an image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        
        
        if ($request->hasFile('image')) {
            
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            
            $destinationPath = public_path('/images');
            
            $request->image->move($destinationPath, $imageName);
            
            $filePath = '/images/' . $imageName;
            return response()->json(['file_path' => $filePath], 200);
        } else {
            
            return response()->json(['error' => 'No image found in the request.'], 400);
        }
    }
}
