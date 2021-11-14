@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Užsakymų ataskaitos langas') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    Daugiausiai išleista užsakymo metu:  {{$max}}€   <br>
                    Mažiausiai išleista užsakymo metu:  {{$min}}€   <br>
                    Vidutiniškai išleista užsakymo metu:  {{$average}}€ <br>
                    Bendra suma:                        {{$sum}}€    <br>
                       
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
