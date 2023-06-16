<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PDF;
use App\Models\Ugyfel;
use Illuminate\Support\Facades\File;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $users = User::get();
        $files = File::files(public_path('upload'));

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ];
        $pdf = PDF::loadView('myPDF', $data);
        $pdf->save(public_path('files/' . 'elso.pdf'));

    }
}
