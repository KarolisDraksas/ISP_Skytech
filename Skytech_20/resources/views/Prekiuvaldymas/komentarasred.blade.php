@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Komentaro redagavimas') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('komentaras.redagavimas') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="pavadinimas" class="col-md-4 col-form-label text-md-right">{{ __('Pavadinimas') }}</label>

                                <div class="col-md-6">
                                    <input id="pavadinimas" value="{{$komentaras->pavadinimas}}" type="text" class="form-control @error('pavadinimas') is-invalid @enderror" name="pavadinimas" value="{{ old('pavadinimas') }}" required autocomplete="pavadinimas" autofocus>

                                    @error('pavadinimas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="editid" value="{{$komentaras->id}}">
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
