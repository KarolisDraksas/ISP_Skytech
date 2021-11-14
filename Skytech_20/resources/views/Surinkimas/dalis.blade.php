@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('kompiuterio surinkimas') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <a class="btn btn-primary" href="{{ route('filtravimo') }}">{{ __('Filtravimo kriteriju langas') }}</a>
<br>
<br>
                        {{ __('kompiuterio surinkimas langas') }}
                            <a class="btn btn-primary" href="{{ route('daliesduomenu') }}">{{ __('Dalies duomenu langas') }}</a>
                            <br>
                            <br>
                            <a class="btn btn-primary" href="{{ route('surinkimopasirinkimolangas') }}">{{ __('Surinkimo pasirinkimu langas') }}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
