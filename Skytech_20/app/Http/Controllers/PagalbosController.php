<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Bilietas;
use App\Models\Zinutes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PagalbosController extends Controller
{
    //
    public function makeBilietas(Request $request)
    {
        $request->validate([
            'pavadinimas' => ['required', 'string', 'max:255'],
            'kategorija' => ['required', 'string', 'max:255'],
            'tekstas' => ['required', 'string', 'max:255'],
        ],
            [
                'pavadinimas.required' => 'pavadinimas turi būti įvestas',
                'pavadinimas.max' => 'pavadinimas turi būti iki 255 simbolių',
                'kategorija.required' => 'kategorija turi būti įvestas',
                'kategorija.max' => 'kategorija turi būti iki 255 simbolių',
                'tekstas.required' => 'tekstas turi būti įvestas',
                'tekstas.max' => 'tekstas turi būti iki 255 simbolių',

            ]);


        $users = User::where('user_type',User::ROLE_WORKER)->get()->all();
        $maxrand = count($users) - 1;
        $number = rand(0,$maxrand);

        $bilietas = new Bilietas();
        $bilietas->fk_vartotojas = auth()->user()->id;
        $bilietas->fk_darbuotojas = $users[$number]['id'];
        $bilietas->pavadinimas = $request['pavadinimas'];
        $bilietas->kategorija = $request['kategorija'];
        $bilietas->save();

        $zinutes = new Zinutes();
        $zinutes->fk_rasytojas = auth()->user()->id;
        $zinutes->fk_bilietas = $bilietas->getAttribute('id');
        $zinutes->tekstas = $request['tekstas'];
        $zinutes->save();

        return redirect()->route('pagalbos');
    }

    public function bilietai()
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        if($user->getAttribute('user_type') == User::ROLE_USER) {
            $bilietas = Bilietas::orderBy('created_at')->where('fk_vartotojas',$userId)->get()->all();
        }
        else{
            if($user->getAttribute('user_type') == User::ROLE_ADMIN) {
                $bilietas = Bilietas::orderBy('created_at')->get()->all();
            }
            else{
                $bilietas = Bilietas::orderBy('created_at')->where('fk_darbuotojas',$userId)->get()->all();
            }
        }

        return view('pagalbos', compact('bilietas'));
    }

    public function bilietas(Request $id)
    {

        $bilietas = Bilietas::find($id['ID']);
        $zinutes = Zinutes::where('fk_bilietas',$bilietas->getAttribute('id'))->get()->all();
        return view('bilietas', compact('bilietas','zinutes'));
    }

    public function makeZinutes(Request $request)
    {
        $request->validate([
            'tekstas' => ['required', 'string', 'max:255'],
        ],
            [
                'tekstas.required' => 'Komentaras turi būti įvestas',
                'tekstas.max' => 'Komentaras turi būti iki 255 simbolių',

            ]);

        $zinute = new Zinutes();
        $zinute->fk_rasytojas = auth()->user()->id;
        $zinute->fk_bilietas = $request['id'];
        $zinute->tekstas = $request['tekstas'];
        $zinute->save();

        $bilietas = Bilietas::find($request['id']);
        $zinutes = Zinutes::where('fk_bilietas',$bilietas->getAttribute('id'))->get()->all();

        if($bilietas->fk_vartotojas == auth()->user()->id)
            $to = User::find($bilietas->fk_darbuotojas);
        else
            $to = User::find($bilietas->fk_vartotojas);


        Mail::send([], [], function ($message) use ($zinute, $bilietas, $to) {
            $string = "<h1>Sveiki, jūs gavote žinute!</h1> <br>".$zinute->tekstas;
            $message->to($to->email, $to->name)
                ->from('sky.pagalba@gmail.com','SKY pagalba')
                ->subject($bilietas->pavadinimas)
                ->setBody($string,'text/html'); // for HTML rich messages
        });

        return view('bilietas', compact('bilietas','zinutes'));
    }

    public function vertinti(Request $id)
    {
        $ID = $id['ID'];
        return view('vertinti', compact('ID'));
    }

    public function makeIvertis(Request $request)
    {
        $request->validate([
            'komentaras' => ['required', 'string', 'max:255'],
            'pagalba' => ['required', 'numeric', 'min:1', 'max:5'],
            'bendravimas' => ['required', 'numeric', 'min:1', 'max:5'],
            'greitis' => ['required', 'numeric', 'min:1', 'max:5'],
        ],
            [
                'komentaras.required' => 'Komentaras turi būti įvestas',
                'komentaras.max' => 'Komentaras turi būti iki 255 simbolių',
                'pagalba.required' => 'pagalba turi būti įvestas',
                'pagalba.max' => 'pagalba turi būti iš 3 simboliu',
                'pagalba.min' => 'pagalba turi būti iš 3 simboliu',
                'bendravimas.required' => 'bendravimas turi būti įvestas',
                'bendravimas.max' => 'bendravimas turi būti iš 3 simboliu',
                'bendravimas.min' => 'bendravimas turi būti iš 3 simboliu',
                'greitis.required' => 'greitis turi būti įvestas',
                'greitis.max' => 'greitis turi būti iš 3 simboliu',
                'greitis.min' => 'greitis turi būti iš 3 simboliu',

            ]);
        $bilietas = Bilietas::find($request['id']);
        $bilietas->vertinimo_data = Carbon::now();
        $bilietas->vartotojo_komentaras = $request['komentaras'];
        $bilietas->pagalbos_ivertis = $request['pagalba'];
        $bilietas->benravimo_ivertis = $request['bendravimas'];
        $bilietas->greicio_ivertis = $request['greitis'];
        $bilietas->save();

        return redirect()->route('pagalbos');
    }

    public function uzdaryti(Request $id)
    {
        $ID = $id['ID'];
        return view('uzdaryti', compact('ID'));
    }

    public function makeUzdarymas(Request $request)
    {
        $request->validate([
            'komentaras' => ['required', 'string', 'max:255'],
        ],
            [
                'komentaras.required' => 'Komentaras turi būti įvestas',
                'komentaras.max' => 'Komentaras turi būti iki 255 simbolių',

            ]);
        $bilietas = Bilietas::find($request['id']);
        $bilietas->uzdarymas = Carbon::now();
        $bilietas->aktyvumas = 0;
        $bilietas->darbuotojo_komentaras = $request['komentaras'];
        $bilietas->save();

        return redirect()->route('pagalbos');
    }

    public function paskirsti(Request $id)
    {
        $ID = $id['ID'];
        $bilietas = Bilietas::find($ID);
        $ID_pris = $bilietas->fk_darbuotojas;

        $users = User::where('user_type',User::ROLE_WORKER)->where('is_banned', false)->get()->all();
        $count = 0;
        foreach ($users as $user)
        {
            $result[$count] = Bilietas::where('fk_darbuotojas',$user->getAttribute('id'))->count();
            $count++;
        }

        return view('paskirsti', compact('ID', 'ID_pris', 'users', 'result'));
    }

    public function makePaskirimas(Request $request)
    {
        $bilietas = Bilietas::find($request['ID']);
        $bilietas->fk_darbuotojas = $request['ID_user'];
        $bilietas->save();

        return redirect()->route('pagalbos');
    }
}
