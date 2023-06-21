<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PDF;
use App\Models\Ugyfel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users,
        ];

        $pdf = PDF::loadView('myPDF', $data);

        // Mentsd el a PDF fájlt a storage könyvtárba
        $pdfPath = 'public/files/elso.pdf';
        Storage::put($pdfPath, $pdf->output());

        // Visszaadhatod a PDF fájl elérési útvonalát
        return Storage::url($pdfPath);
    }
}
