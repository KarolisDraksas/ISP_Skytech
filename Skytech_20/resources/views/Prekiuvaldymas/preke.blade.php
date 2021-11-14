@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Prekės peržiūra') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Prekės duomenys') }}
                        <table id="datatable-buttons" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tbody style="text-align:center;">
                                <tr>
                                    <th>Kodas</th>
                                    <th>{{ $preke['kodas'] }}</th>
                                </tr>
                                <tr>
                                    <th>Pavadinimas</th>
                                    <th>{{ $preke['pavadinimas'] }}</th>
                                </tr>
                                <tr>
                                    <th>Gamintojas</th>
                                    <th>{{ $preke['gamintojas'] }}</th>
                                </tr>
                                <tr>
                                    <th>Aprašymas</th>
                                    <th>{{ $preke['aprašymas'] }}</th>
                                </tr>
                                <tr>
                                    <th>Kaina</th>
                                    <th>{{ $preke['kaina'] }}</th>
                                </tr>
                                <tr>
                                    <th>Kiekis</th>
                                    <th>{{ $preke['kiekis'] }}</th>
                                </tr>
                                <tr>
                                    <th>Kategorija</th>
                                    <th>{{ $preke['kategorija'] }}</th>
                                </tr>
                                <tr>
                                    <th>Prekės sukūrimo data</th>
                                    <th>{{ $preke['created_at'] }}</th>
                                </tr>
                                </tbody>
                            </table>
                            <a class="btn btn-primary" href="{{ route('prekesredag', $preke->id) }}">{{ __('Redaguoti') }}</a>
                            <form style="display: inline;" method="post" action="{{ route('salintiPreke', ['ID' => $preke->id]) }}" onclick="return confirm('Ar tikrai norite pašalinti?')">
                                @csrf
                                <button type="submit" class="btn btn-primary">Šalinti</button>
                            </form>
                            <div> {{__('Komentarai: ')}}
                           <br>
                            @foreach($komentaras as $k)
                            @if ($k -> fk_preke == $preke['id'])
                            <tr>
                                <div style="border: 1px solid gray">{{ $k -> pavadinimas}}</div>
                                @if ($k -> fk_user == auth()->user()->id)
                                <a class="btn btn-primary" href="{{ route('redaguotiKom', $k->id) }}"><butto>{{__('Redaguoti komentarą')}}</butto></a>
                                @endif
                                <br>
                            </tr>
                            @endif
                            @endforeach
                            <form method="POST" action="{{ route('pridetiKomentara', ['ID' => $preke->id]) }}">
                            <div">
                                {{ __('Rašyti komentarą: ') }}

                                <div class="height:200px width:150px">
                                    <input id="pavadinimas" type="text"  name="pavadinimas" class="height:200px; width:150px;">                              
                                </div>
                            <br>
                            </div>
                            <div class="form-group row mb-0">
                                <div>
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Komentuoti') }}
                                    </button>
                                </div>
                            </div>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
