@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bilietas') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="post" action="{{ route('createBilietas') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="pavadinimas">Pavadinimas</label>
                                    <input type="text" class="form-control" name="pavadinimas" id="pavadinimas" aria-describedby="emailHelp" placeholder="Įveskite Pavadinima uzklausos">
                                        @error('pavadinimas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="kategorija">Kategorija</label>
                                    <select type="text" class="form-control" name="kategorija" id="kategorija" aria-describedby="emailHelp" placeholder="Įveskite kategorija uzklausos">
                                        <option>Pirkimas</option>
                                        <option>Uzsakymai</option>
                                        <option>Grazinimas</option>
                                        <option>Garantinis</option>
                                        <option>Kita</option>
                                    </select>
                                        @error('kategorija')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tekstas">Tekstas</label>
                                    <input type="text" class="form-control" name="tekstas" id="tekstas" aria-describedby="emailHelp" placeholder="Įveskite tekstas uzklausos">
                                    @error('tekstas')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">Sukurti paskyrą</button>
                                @error('generic')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
