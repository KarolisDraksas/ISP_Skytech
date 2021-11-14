@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Užsakymo informacija') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="datatable-buttons" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <tbody style="text-align:center;">
                            <tr>
                                <th>ID</th>
                                <th>{{ $uzsakymas['id'] }}</th>
                            </tr>
                            <tr>
                                <th>Sukūrimo data</th>
                                <th>{{ $uzsakymas['created_at'] }}</th>
                            </tr>
                            <tr>
                                <th>Suma</th>
                                <th>{{ $uzsakymas['kaina'] }}</th>
                            </tr>
                            <tr>
                                <th>Prekių kiekis</th>
                                <th>{{ $uzsakymas['kiekis'] }}</th>
                            </tr>
                            <tr>
                                <th>Adresas</th>
                                <th>{{ $uzsakymas['adresas'] }}</th>
                            </tr>
                            <tr>
                                <th>Pristatymo būdas</th>
                                <th>{{ $uzsakymas['kategorija'] }}</th>
                            </tr>
                            <tr>
                                <th>Būsena</th>
                                <th>{{ $uzsakymas['statusas'] }}</th>
                            </tr>
                            </tbody>
                        </table>

                        @if($uzsakymas -> statusas == 'Nepatvirtintas')
                            <form method="post" action=" {{ route('patvirtintiUzsakyma', ['confirmOrder' => $uzsakymas->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Ar tikrai norite patvirtinti?')">Patvirtinti</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
