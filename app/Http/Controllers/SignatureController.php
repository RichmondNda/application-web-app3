<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SignatureController extends Controller
{
    public function signature()
    {
        return Inertia::render('Signature/Index');
    }

    public function ok_signature(Request $request)
    {
        
            $folderPath = public_path('signatures/');
          
            $image_parts = explode(";base64,", $request->signed);
                
            $image_type_aux = explode("image/", $image_parts[0]);
              
            $image_type = $image_type_aux[1];
              
            $image_base64 = base64_decode($image_parts[1]);
              
            // $file = $folderPath . uniqid('regis_') . '.'.$image_type;
            $file = $folderPath .'mairie'. '.'.$image_type;
            file_put_contents($file, $image_base64);
            
            $message =  " La signature a ete bien enregistrer"; 

            $response = [
                'success' => true,
                'message' => $message,
            ];
    
    
            return response()->json($response, 200);
    }
}
