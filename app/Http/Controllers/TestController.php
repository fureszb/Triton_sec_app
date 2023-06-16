<?php

namespace App\Http\Controllers;

use PDF;
use Mail;

class TestController extends Controller
{
    public function sendMailWithPdf()
    {
        $data["email"] = "frsz.bence@gmail.com";
        $data["title"] = "Email teszting";
        $data["body"] = "Teszt email";

        $pdf = PDF::loadView('mail', $data);

        Mail::send('mail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "test.pdf");
        });

        dd("Teszt email elküldve");
    }
}
