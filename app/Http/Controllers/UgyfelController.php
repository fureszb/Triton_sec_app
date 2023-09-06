<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ugyfel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Szerelo;
use App\Models\Szolgaltatas;
use App\Models\Munka;

class UgyfelController extends Controller
{

    public function index()
    {
        $sort_by = request()->query('sort_by', 'UgyfelID');
        $sort_dir = request()->query('sort_dir', 'asc');
        $keyword = request()->input('search');

        $query = Ugyfel::orderBy($sort_by, $sort_dir);

        if ($keyword) {
            $query->search($keyword);
        }

        $ugyfel = $query->paginate(9);

        return view('ugyfel.index', compact('ugyfel'));
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $szerelok = Szerelo::all();
        $szolgaltatasok = Szolgaltatas::all();
        $munkak = Munka::all();

        $ugyfel = new Ugyfel(); // Inicializálás

        return view('ugyfel.create', compact('szerelok', 'szolgaltatasok', 'munkak', 'ugyfel')); // Átadás a nézetnek
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nev' => ['required', 'regex:/^[\p{L} -]+$/u', 'min:3'],
            'email' => ['required', 'regex:/^\S+@\S+\.\S+$/', 'min:3'],
            'objcim' => ['required', 'min:3'],
            'telefon' => ['required', 'regex:/^(\+36|06)?[0-9]{9}$/'],
            'szamnev' => ['required', 'regex:/^[A-Za-záéíóöőúüűÁÉÍÓÖŐÚÜŰ\s]{3,}$/'],
            'szamcim' => ['required', 'min:3'],
            'kezd_datum' => 'required',
            'bef_datum' => 'required',
            'adoszam' => ['nullable', 'between:8,11'],
            'szerelo' => 'required',
            'szolgaltatas' => 'required',
            'munka' => 'required',
            'felhasznalt_anyagok' => ['required', 'min:3'],
        ], [
            'nev.required' => 'A név megadása kötelező.',
            'nev.regex' => 'A név csak betűket és szóközöket tartalmazhat, magyar betűket is elfogadva.',
            'nev.min' => 'A név legalább 3 karakter hosszú legyen.',
            'email.required' => 'Az email megadása kötelező.',
            'email.regex' => 'Érvénytelen email cím.',
            'email.min' => 'A email legalább 3 karakter hosszú legyen.',
            'objcim.required' => 'Az objektum címének megadása kötelező.',
            'objcim.regex' => 'Az objektum címe érvénytelen karaktereket tartalmaz.',
            'objcim.min' => 'Az objektum címének legalább 3 karakter hosszúnak kell lennie.',
            'telefon.required' => 'A telefonszám megadása kötelező.',
            'telefon.regex' => 'A telefonszám formátuma érvénytelen.',
            'szamnev.required' => 'A számlázási név megadása kötelező.',
            'szamnev.regex' => 'A számlázási név csak betűket és szóközöket tartalmazhat, magyar betűket is elfogadva.',
            'szamnev.min' => 'A számlázási név legalább 3 karakter hosszú legyen.',
            'szamcim.required' => 'A számlázási cím megadása kötelező.',
            'szamcim.regex' => 'A számlázási cím érvénytelen karaktereket tartalmaz.',
            'szamcim.min' => 'A számlázási cím legalább 3 karakter hosszúnak kell lennie.',
            'kezd_datum.required' => 'A kezdő dátum megadása kötelező.',
            'bef_datum.required' => 'A befejező dátum megadása kötelező.',
            'adoszam.between' => 'Az adószám hossza 8 és 11 karakter között lehet.',
            'szerelo.required' => 'A szerelő kiválasztása kötelező.',
            'szolgaltatas.required' => 'A szolgáltatás kiválasztása kötelező.',
            'munka.required' => 'A munka kiválasztása kötelező.',
            'felhasznalt_anyagok.required' => 'A felhasznált anyagok kitöltése kötelező!',
            'felhasznalt_anyagok.min' => 'A felhasznált anyagok legalább 3 karakter hosszú legyen.',
        ]);



        $ugyfel = new Ugyfel();
        $ugyfel->UgyfelID = $request->id;
        $ugyfel->Nev = $request->nev;
        $ugyfel->Email = $request->email;
        $ugyfel->ObjCim = $request->objcim;
        $ugyfel->Telefon = $request->telefon;
        $ugyfel->SzamNev = $request->szamnev;
        $ugyfel->SzamCim = $request->szamcim;
        $ugyfel->KezdDatum = $request->kezd_datum;
        $ugyfel->BefDatum = $request->bef_datum;
        $ugyfel->AdoSzam = $request->adoszam;
        $ugyfel->SzereloID = $request->szerelo;
        $ugyfel->SzolgID = $request->szolgaltatas;
        $ugyfel->MunkaID = $request->munka;
        $ugyfel->FelhasznaltAnyagok = $request->felhasznalt_anyagok;

        $ugyfel->save();

        return redirect()->route('signaturepad')->with('success', 'Ügyfél sikeresen létrehozva, aláírás kötelező!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ugyfel = Ugyfel::find($id);
        $szerelok = Szerelo::all();
        $szolgaltatasok = Szolgaltatas::all();
        $munkak = Munka::all();

        return view('ugyfel.show', compact('ugyfel', 'szerelok', 'szolgaltatasok', 'munkak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $ugyfel = Ugyfel::find($id);
        $szerelok = Szerelo::all();
        $munkak = Munka::all();
        $szolgaltatasok = Szolgaltatas::all();

        return view('ugyfel.edit', compact('ugyfel', 'szerelok', 'szolgaltatasok', 'munkak'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'nev' => ['required', 'regex:/^[\p{L} -]+$/u', 'min:3'],
            'email' => ['required', 'regex:/^\S+@\S+\.\S+$/', 'min:3'],
            'objcim' => ['required', 'min:3'],
            'telefon' => ['required', 'regex:/^(\+36|06)?[0-9]{9}$/'],
            'szamnev' => ['required', 'regex:/^[A-Za-záéíóöőúüűÁÉÍÓÖŐÚÜŰ\s]{3,}$/'],
            'szamcim' => ['required', 'min:3'],
            'kezd_datum' => 'required',
            'bef_datum' => 'required',
            'adoszam' => ['nullable', 'between:8,11'],
            'felhasznalt_anyagok' => ['required', 'min:3'],
        ], [
            'nev.required' => 'A név megadása kötelező.',
            'nev.regex' => 'A név csak betűket és szóközöket tartalmazhat, magyar betűket is elfogadva.',
            'nev.min' => 'A név legalább 3 karakter hosszú legyen.',
            'email.required' => 'Az email megadása kötelező.',
            'email.regex' => 'Érvénytelen email cím.',
            'email.min' => 'A email legalább 3 karakter hosszú legyen.',
            'objcim.required' => 'Az objektum címének megadása kötelező.',
            'objcim.regex' => 'Az objektum címe érvénytelen karaktereket tartalmaz.',
            'objcim.min' => 'Az objektum címének legalább 3 karakter hosszúnak kell lennie.',
            'telefon.required' => 'A telefonszám megadása kötelező.',
            'telefon.regex' => 'A telefonszám formátuma érvénytelen.',
            'szamnev.required' => 'A számlázási név megadása kötelező.',
            'szamnev.regex' => 'A számlázási név csak betűket és szóközöket tartalmazhat, magyar betűket is elfogadva.',
            'szamnev.min' => 'A számlázási név legalább 3 karakter hosszú legyen.',
            'szamcim.required' => 'A számlázási cím megadása kötelező.',
            'szamcim.regex' => 'A számlázási cím érvénytelen karaktereket tartalmaz.',
            'szamcim.min' => 'A számlázási cím legalább 3 karakter hosszúnak kell lennie.',
            'kezd_datum.required' => 'A kezdő dátum megadása kötelező.',
            'bef_datum.required' => 'A befejező dátum megadása kötelező.',
            'adoszam.between' => 'Az adószám hossza 8 és 11 karakter között lehet.',
            'felhasznalt_anyagok.required' => 'A felhasznált anyagok kitöltése kötelező!',
            'felhasznalt_anyagok.min' => 'A felhasznált anyagok legalább 3 karakter hosszú legyen.',
        ]);




        $ugyfel = Ugyfel::find($id);

        $ugyfel->UgyfelID = $request->id;
        $ugyfel->Nev = $request->nev;
        $ugyfel->Email = $request->email;
        $ugyfel->ObjCim = $request->objcim;
        $ugyfel->Telefon = $request->telefon;
        $ugyfel->SzamNev = $request->szamnev;
        $ugyfel->SzamCim = $request->szamcim;
        $ugyfel->KezdDatum = $request->kezd_datum;
        $ugyfel->BefDatum = $request->bef_datum;
        $ugyfel->AdoSzam = $request->adoszam;

        $szerelo = $request->input('szerelo');
        $szolgaltatas = $request->input('szolgaltatas');
        $munka = $request->input('munka');
        if ($szerelo && $szolgaltatas && $munka) {
            $ugyfel->SzereloID = $szerelo;
            $ugyfel->SzolgID = $szolgaltatas;
            $ugyfel->MunkaID = $munka;
        }
        $ugyfel->FelhasznaltAnyagok = $request->felhasznalt_anyagok;
        $ugyfel->save();
        return redirect()->route('ugyfel.index')->with('success', 'Ügyfél sikeresen módosítva!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ugyfel = Ugyfel::find($id);
        $ugyfel->delete();
        return redirect()->route('ugyfel.index')->with('success', 'Ügyfél sikeresen törölve');
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $ugyfel = Ugyfel::where('Nev', 'like', "%$keyword%")
            ->orWhere('UgyfelID', $keyword)
            ->get();

        return view('ugyfel.index', compact('ugyfel'));
    }
}
