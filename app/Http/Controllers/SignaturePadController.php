<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignaturePadController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('signaturePad');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function upload(Request $request)
    {
        $folderPath = public_path('images/');

        $image_parts = explode(";base64,", $request->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $file = $folderPath . 'alairas.png';

        file_put_contents($file, $image_base64);
        return redirect('/send-mail')->with('success', 'Az aláírás és az ügyfél sikeresen mentve lett!');
    }
}
