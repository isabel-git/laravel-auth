<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; //importo Auth
use Illuminate\Support\Facades\File; //importo File

use Illuminate\Http\Request;

class HomeController extends Controller
{ 
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('home');
    }

    public function update(Request $request) {
        // dd($request -> all());

        $request -> validate(['icon' => 'required|file']);
        $image = $request -> file('icon');
        //dd($image);

        $ext = $image -> getClientOriginalExtension();// recupera l'estensiene
        $name = rand(100000, 999999) . '_' . time(); //numero sequenziale
        $finalName = $name . '_' . $ext;

        // dd($finalName);
        $file = $image -> storeAs('/icons', $finalName, 'public'); //fa la copia da remoto a locale

        $this -> clearOldIcon();
        
        $user = Auth::user(); //recupera l'ute
        $user -> icon = $finalName;
        $user -> save(); //salvo nel db

        return redirect() -> back();
    }

    //elimina le foto che non ci sono piu'
    private function clearOldIcon() {

        $user = Auth::user(); //recupera ute
        $icon = $user -> icon;//recupera l'icona

        // usiamo il costrutto try catch per eliminare i file
        try {
            $file = storage_path('app/public/icon/' . $icon);
            File::delete($file);
        } catch (\Exception $e) {

        }
    }
}
