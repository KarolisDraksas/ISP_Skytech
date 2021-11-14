<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Preke;
use App\Models\Komentaras;
use App\Models\Isiminimas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PrekesController extends Controller
{
    public function preke($id){
        $preke = Preke::find($id);
        $komentaras = Komentaras::orderBy('id')->get()->all();
        return view('preke', ['preke'=>$preke], compact('komentaras'));
    }
    public function prekes()
    {
        $prekes = Preke::orderBy('created_at')->get()->all();
        return view('prekes', compact('prekes'));
    }

    public function salintiPreke(Request $request){
        DB::table('prekes')->where('id', '=',  $request['ID'])->delete();
        $request ->session()->flash('success', 'Preke pašalinta sėkmingai');
        return redirect()->route('prekes');
    }
    public function redaguotiKom($id){
        $komentaras = Komentaras::find($id);

        return view('komentarasred', ['komentaras'=>$komentaras]);
    }
    public function redaguotiKomentara(Request $request){
        $id = $request->input('editid');
        $komentaras = Komentaras::find($id);

        if (Auth::user())
        {
            $validate = null;
                $validate = $request->validate([
                    'pavadinimas' => 'required|min:2',
                ]);

            if($validate)
            {
                $komentaras->pavadinimas = $request['pavadinimas'];
                $komentaras->save();
                $request ->session()->flash('success', 'Duomenis pavyko atnaujinti');
                return redirect()->back();
            }
            else
                return redirect()->back();

        }
        else
            return redirect()->back();

    }
    public function redaguoti($id){
        $preke = Preke::find($id);

        return view('prekesredag', ['preke'=>$preke]);
    }

    public function redaguotiPreke(Request $request){
        $id = $request->input('editid');
        $preke = Preke::find($id);
       // $kodas = $preke->kodas;
        if (Auth::user())
        {
            $validate = null;
                $validate = $request->validate([
                    'kodas' => 'required|min:2',
                    'pavadinimas' => 'required|min:2',
                    'gamintojas'=> 'required',
                    'aprašymas'=> 'required',
                    'kaina' => 'required',
                    'kiekis' => 'required',
                    'kategorija' => 'required'
                ]);

            if($validate)
            {
                $preke->kodas = $request['kodas'];
                $preke->pavadinimas = $request['pavadinimas'];
                $preke->gamintojas = $request['gamintojas'];
                $preke->aprašymas = $request['aprašymas'];
                $preke->kaina = $request['kaina'];
                $preke->kiekis = $request['kiekis'];
                $preke->kategorija = $request['kategorija'];
                $preke->save();
                $request ->session()->flash('success', 'Duomenis pavyko atnaujinti');
                return redirect()->back();
            }
            else
                return redirect()->back();

        }
        else
            return redirect()->back();
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
    public function pridetiKomentara(Request $request){
        if (Auth::user())
        {
            $validate = null;
            $validate = $request->validate([
                'pavadinimas' => 'required|min:2', 
            ]);
            if($validate)
            {
                Komentaras::create([
                    'pavadinimas' => $request['pavadinimas'],
                    'fk_user' => auth()->user()->id,
                    'fk_preke' => $request['ID'],
                ]);
                return redirect()->back();
            }
            else
                return redirect()->back();

        }
        else
            return redirect()->back();
    }
    public function pridetiPreke(Request $request)
    {
        if (Auth::user())
        {
            $validate = null;
            $validate = $request->validate([
                'kodas' => 'required|min:2',
                'pavadinimas' => 'required|min:2',
                'gamintojas'=> 'required',
                'aprašymas'=> 'required',
                'kaina' => 'required',
                'kiekis' => 'required',
                'kategorija' => 'required'
                
            ]);
            if($validate)
            {
                preke::create([
                    'kodas' => $request['kodas'],
                    'pavadinimas' => $request['pavadinimas'],
                    'gamintojas' => $request['gamintojas'],
                    'aprašymas' => $request['aprašymas'],
                    'kaina' => $request['kaina'],
                    'kiekis' => $request['kiekis'],
                    'kategorija' => $request['kategorija'],
                    'fk_id' => auth()->user()->id
                ]);
                return redirect()->back();
            }
            else
                return redirect()->back();

        }
        else
            return redirect()->back();
    }
    public function filtruoti($kategorija)
    {
        if($kategorija != null)
            $prekes = Preke::where('kategorija', $kategorija) -> get() -> all();
        else
            $prekes = Preke::orderBy('created_at')->get()->all();

        return view('prekes') -> with('prekes', $prekes);
    }
}
