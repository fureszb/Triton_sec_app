<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Ugyfel;
use PDF;
use Mail;

class TestController extends Controller
{
    public function sendMailWithPdf()
    {
        $ugyfel = Ugyfel::latest()->first();

        $data["email"] = "frsz.bence@gmail.com";
        $data["title"] = "Ügyfél részletek";
        $data["ugyfel"] = $ugyfel;

        $pdf = PDF::loadView('mail', $data);

        Mail::send('mail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "ugyfel_reszletek.pdf");
        });

          // Képek törlése a public/images mappából
         $folderPath = public_path('images');

          // Fájlok listázása a mappában
          $files = File::files($folderPath);

          // Fájlok törlése
          foreach ($files as $file) {
              File::delete($file);
          }
        return redirect('/ugyfel')->with('success', 'Az aláírás és az ügyfél sikeresen mentve lett és az email elküldve!');

    }
}
