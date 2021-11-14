<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Preke;
use App\Models\Isiminimas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class IsimintinuPrekiuController extends Controller
{
    public function atvaizduotiPrekes()
    {
        $userId = auth()->user()->id;
        $isimintinos_prekes = DB::table('isiminimas')->select('fk_preke')->where('fk_user' , '=', $userId)->get();

       $merged = null;

       foreach ($isimintinos_prekes as $preke)
       {
           $result = DB::table('prekes')->select('Kodas', 'Pavadinimas', 'Gamintojas', 'Aprašymas', 'Kaina', 'Kategorija')->where('id', '=', $preke -> fk_preke  )->get();
           $merged = $result->merge($merged);
       }
        return view('isimintinosprekes', compact('merged'));
      
    }
    public function isimintiPreke(Request $request)
    {
        if (Isiminimas::where('fk_preke', '=', $request['ID']) -> where('fk_user', '=', auth()->user()->id) -> exists()) 
        {
            $request ->session()->flash('success', 'Ši prekė jau buvo įtraukta į sąrašą');
            return redirect() -> back();
        }   
        else
        {
            $isiminimas =  new Isiminimas();
            $isiminimas -> fk_preke = $request['ID'];
            $isiminimas -> fk_user = auth()->user()->id;
            $isiminimas -> save();
            $request ->session()->flash('success', 'Prekė įtraukta į įsimintinų prekių sąrašą');
            return redirect() -> back();
        }
    }

    public function filtras($kategorija)
    {
        $userId = auth()->user()->id;
        $isimintinos_prekes = DB::table('isiminimas')->select('fk_preke')->where('fk_user' , '=', $userId)->get();

       $merged = null;

        foreach ($isimintinos_prekes as $preke)
        {
            if($kategorija != null)
                $result = DB::table('prekes')->select('Kodas', 'Pavadinimas', 'Gamintojas', 'Aprašymas', 'Kaina', 'Kategorija')->where('id', '=', $preke -> fk_preke)->where('kategorija', '=', $kategorija)->get();
            else
                $result = DB::table('prekes')->select('Kodas', 'Pavadinimas', 'Gamintojas', 'Aprašymas', 'Kaina', 'Kategorija')->where('id', '=', $preke -> fk_preke)->get();
            $merged = $result -> merge($merged);
        }

        
  

        return view('isimintinosprekes') -> with('merged', $merged);
    }
}
