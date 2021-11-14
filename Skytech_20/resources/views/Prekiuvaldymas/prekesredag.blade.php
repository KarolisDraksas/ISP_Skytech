@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Prekes redagavimas') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('preke.redagavimas') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="kodas" class="col-md-4 col-form-label text-md-right">{{ __('Kodas') }}</label>

                                <div class="col-md-6">
                                    <input id="kodas" value="{{$preke->kodas}}" type="text" class="form-control @error('kodas') is-invalid @enderror" name="kodas" value="{{ old('kodas') }}" required autocomplete="kodas" autofocus>

                                    @error('kodas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pavadinimas" class="col-md-4 col-form-label text-md-right">{{ __('Pavadinimas') }}</label>

                                <div class="col-md-6">
                                    <input id="pavadinimas" value="{{$preke->pavadinimas}}" type="text" class="form-control @error('pavadinimas') is-invalid @enderror" name="pavadinimas" value="{{ old('pavadinimas') }}" required autocomplete="pavadinimas" autofocus>

                                    @error('pavadinimas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gamintojas" class="col-md-4 col-form-label text-md-right">{{ __('Gamintojas') }}</label>

                                <div class="col-md-6">
                                    <input id="gamintojas" value="{{$preke->gamintojas}}" type="text" class="form-control @error('gamintojas') is-invalid @enderror" name="gamintojas" value="{{ old('gamintojas') }}" required autocomplete="gamintojas" autofocus>

                                    @error('gamintojas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aprašymas" class="col-md-4 col-form-label text-md-right">{{ __('Aprašymas') }}</label>

                                <div class="col-md-6">
                                    <input id="aprašymas" value="{{$preke->aprašymas}}" type="text" class="form-control @error('aprašymas') is-invalid @enderror" name="aprašymas" value="{{ old('aprašymas') }}" required autocomplete="aprašymas" autofocus>

                                    @error('aprašymas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kaina" class="col-md-4 col-form-label text-md-right">{{ __('Kaina') }}</label>

                                <div class="col-md-6">
                                    <input id="kaina" value="{{$preke->kaina}}" type="text" class="form-control @error('kaina') is-invalid @enderror" name="kaina" value="{{ old('kaina') }}" required autocomplete="kaina" autofocus>

                                    @error('kaina')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kiekis" class="col-md-4 col-form-label text-md-right">{{ __('Kiekis') }}</label>

                                <div class="col-md-6">
                                    <input id="kiekis" value="{{$preke->kiekis}}" type="text" class="form-control @error('kiekis') is-invalid @enderror" name="kiekis" value="{{ old('kiekis') }}" required autocomplete="kiekis" autofocus>

                                    @error('kiekis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kategorija" class="col-md-4 col-form-label text-md-right">{{ __('Kategorija') }}</label>

                                <div class="col-md-6" id="kategorija">
                                    <input id="motinine" type="radio" name="kategorija" value="motinine">
                                    <label for="motinine" >{{ __('motinine') }}</label>
                                    <input id="vaizdo" type="radio" name="kategorija" value="vaizdo" >
                                    <label for="vaizdo" >{{ __('vaizdo') }}</label>
                                    <input id="diskas" type="radio" name="kategorija" value="diskas">
                                    <label for="diskas" >{{ __('diskas') }}</label>
                                    <input id="ram" type="radio" name="kategorija" value="ram">
                                    <label for="ram" >{{ __('ram') }}</label>
                                    <input id="procesorius" type="radio" name="kategorija" value="procesorius">
                                    <label for="procesorius" >{{ __('procesorius') }}</label>
                                    <input id="korpusas" type="radio" name="kategorija" value="korpusas">
                                    <label for="korpusas" >{{ __('korpusas') }}</label>
                                                        
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="editid" value="{{$preke->id}}">
                                        {{ __('Redaguoti') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

