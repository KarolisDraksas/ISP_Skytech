@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Vertinimo forma') }}</div>

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

                            <form method="post" action="{{ route('createBilietoIvertis') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="komentaras">Komentaras</label>
                                    <input type="text" class="form-control" name="komentaras" id="komentaras" aria-describedby="emailHelp" placeholder="Įveskite komentara">
                                    @error('komentaras')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pagalba">Pagalbos ivertis</label>
                                    <select type="text" class="form-control" name="pagalba" id="pagalba" aria-describedby="emailHelp" placeholder="Įveskite pagalbos iverti">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                    @error('pagalba')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="bendravimas">Bendravimo ivertis</label>
                                    <select type="text" class="form-control" name="bendravimas" id="bendravimas" aria-describedby="emailHelp" placeholder="Įveskite pagalbos iverti">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                    @error('bendravimas')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="greitis">Greičio ivertis</label>
                                    <select type="text" class="form-control" name="greitis" id="greitis" aria-describedby="emailHelp" placeholder="Įveskite greičio iverti">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                    @error('greitis')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" id="id" name="id" value={{ $ID }}>
                                <button type="submit" class="btn btn-success">Įvertinti</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
