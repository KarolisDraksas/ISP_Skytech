<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preke;
use App\Models\Uzsakymas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UzsakymoController extends Controller
{
    public function uzsakymas()
    {
        $user = User::find(Auth::user()->id);
        $uzsakymai = Uzsakymas::where('fk_vartotojas', $user->id)->get()->all();
        return view('uzsakymusarasas', compact('uzsakymai'));
    }

    public function uzsakymoInformacija($id){
        $uzsakymas = Uzsakymas::find($id);
        $prekes = DB::table('prekes_uzsakymas')->select('*')->where('fk_uzsakymas' , '=' , $id)->get();
        return view('uzsakymas', compact('uzsakymas', 'prekes'));
    }

    public function deleteOrder(Request $request)
    {
      //  dd($order);
      $prekes_uzsakymas = DB::table('prekes_uzsakymas')->select('*')->where('fk_uzsakymas' , '=', $request['ID'])->get();
        foreach ($prekes_uzsakymas as $prekes_uz)
        {
            $preke =  DB::table('prekes')->select('*')->where('id' , '=', $prekes_uz -> fk_preke )->first();
            $affected = DB::table('prekes') ->where('id', '=' , $preke -> id )->update(['kiekis' => $preke -> kiekis + $prekes_uz -> kiekis]);
            DB::table('prekes_uzsakymas')->where('id', '=',  $prekes_uz -> id)->delete();
        }
        DB::table('uzsakymas')->where('id', '=',  $request['ID'])->delete();
        $request ->session()->flash('success', 'Užsakymą pavyko sėkmingai pašalinti');
        return redirect()->route('uzsakymusarasas');
    }

    public function filtruoti(Request $request)
    {
        $input1 = $request->input('from_date');
        $input2 = $request->input('to_date');

        $user = User::find(Auth::user()->id);
        $uzsakymai = Uzsakymas::where('fk_vartotojas', $user->id)->whereBetween('created_at', [$input1, $input2])->get()->all();
        return view('uzsakymusarasas')-> with('uzsakymai', $uzsakymai);
    }

    public function ataskaita()
    {
        $user = User::find(Auth::user()->id);
        $min = Uzsakymas::where('fk_vartotojas', $user->id)->min('kaina');
        $max = Uzsakymas::where('fk_vartotojas', $user->id)->max('kaina');
        $average = Uzsakymas::where('fk_vartotojas', $user->id)->average('kaina');
        $sum = Uzsakymas::where('fk_vartotojas', $user->id)->sum('kaina');
        return view('uzsakymoataskaitos', compact('min','max','average', 'sum'));
    }
}
