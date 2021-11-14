<?php

namespace App\Http\Controllers;

use App\Models\Bilietas;
use App\Models\User;
use App\Models\Uzsakymas;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdministravimoController extends Controller
{
    public function klientai(){
        $users = user::where('user_type', 'user')->get();
        return view('klientai', ['users'=>$users]);
    }

    public function klientas($id){
        $user = user::find($id);
        $orders = uzsakymas::where('fk_vartotojas', $id)->get();
        return view('klientas', compact('user','orders'));
    }

    public function darbuotojas($id){
        $user = user::find($id);
        return view('darbuotojas', ['user'=>$user]);
    }
    public function darbuotojai(){
        $users = user::where('user_type', 'worker')->where('is_banned', false)
                        ->get();
        return view('darbuotojai', ['users'=>$users]);
    }

    public function salintiDarbuotoja(Request $request){
        $bilietai = Bilietas::where('fk_darbuotojas', $request['ID'])->get();
        $uzsakymai = Uzsakymas::where('fk_darbuotojas', $request['ID'])->where('statusas', 'Nepatvirtintas')->get();
        $user = User::where('id', $request['ID'])->first();

        $user->is_banned = true;
        $user->save();

        $users = User::where('user_type', 'worker')->where('is_banned', false)->get();
        $maxrand = count($users) - 1;
        $number = rand(0,$maxrand);

        foreach ($bilietai as $bilietas){
            $bilietas->fk_darbuotojas = $users[$number]['id'];
            $bilietas->save();
        }

        foreach ($uzsakymai as $uzsakymas){
            $uzsakymas->fk_darbuotojas = $users[$number]['id'];
            $uzsakymas->save();
        }

        $request ->session()->flash('success', 'Darbuotojas pašalintas sėkmingai');
        return redirect()->route('darbuotojai');
    }

    public function redaguoti($id){
        $user = user::find($id);

        return view('darbuotojoredag', ['user'=>$user]);
    }

    public function pridetiDarbuotoja(Request $request){
        if (Auth::user())
        {
            $validate = null;
            $validate = $request->validate([
                'name' => 'required|min:2',
                'surname' => 'required|min:2',
                'address'=> 'required',
                'telephone'=> 'required',
                'email' => 'required|email|unique:users'
            ]);
            if($validate)
            {

                User::create([
                    'name' => $request['name'],
                    'surname' => $request['surname'],
                    'telephone' => $request['telephone'],
                    'address' => $request['address'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'user_type' => 'worker',
                ]);
                return redirect()->back();
            }
            else
                return redirect()->back();

        }
        else
            return redirect()->back();
    }

    public function redaguotiDarbuotoja(Request $request){
        $id = $request->input('editid');
        $user = User::find($id);
        $email = $user->email;
        if (Auth::user())
        {
            $validate = null;
            if ($email == $request['email'])
            {
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'surname' => 'required|min:2',
                    'address'=> 'required',
                    'telephone'=> 'required',
                    'email' => 'required|email'
                ]);
            }
            else
            {
                $validate = $request->validate([
                    'name' => 'required|min:2',
                    'surname' => 'required|min:2',
                    'address'=> 'required',
                    'telephone'=> 'required',
                    'email' => 'required|email|unique:users'
                ]);
            }

            if($validate)
            {
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->surname = $request['surname'];
                $user->telephone = $request['telephone'];
                $user->address = $request['address'];
                $user->save();
                $request ->session()->flash('success', 'Duomenis pavyko atnaujinti');
                return redirect()->back();
            }
            else
                return redirect()->back();

        }
        else
            return redirect()->back();
    }

    public function uzsakymai(){
        $uzsakymai = Uzsakymas::all();
        return view('uzsakymusarasas', ['uzsakymai'=>$uzsakymai]);
    }

    public function patvirtintiUzsakyma(Request $request){
        $uzsakymai = Uzsakymas::all();
        $uzsakymas = Uzsakymas::find($request['confirmOrder']);
        $uzsakymas->statusas = 'Patvirtintas';
        $uzsakymas->save();
        $request->session()->flash('success', 'Užsakymas sėkmingai patvirtintas');
        return redirect()->back();
    }

    public function nepatvirtintiUzsakymai(){
        $uzsakymai = Uzsakymas::where('statusas', 'Nepatvirtintas')->get();
        return View('nepatuzsakymusarasas', ['uzsakymai'=>$uzsakymai]);
    }
}
