@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Uzdarymo forma') }}</div>

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
                            <form method="post" action="{{ route('createBilietoUzdarymas') }}">
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

                                <input type="hidden" id="id" name="id" value={{ $ID }}>
                                <button type="submit" class="btn btn-success">Uždaryti</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
