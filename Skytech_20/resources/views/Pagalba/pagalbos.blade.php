@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Jusu bilietai') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                            <table id="datatable-buttons" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    @if (auth()->user()->user_type != \App\Models\User::ROLE_USER)
                                    <th>ID</th>
                                    @endif
                                    <th>Pavadinimas</th>
                                    <th>Kategorija</th>
                                    <th>Sukurta</th>
                                    <th>Būsena</th>

                                    @if (auth()->user()->user_type != \App\Models\User::ROLE_USER)
                                            <th>uzdarymo data</th>
                                            <th>Darbuotojo Komentaras</th>
                                            <th>Ivertinimo data</th>
                                            <th>Vartotojo Komentaras</th>
                                            <th>Pagalbos ivertis</th>
                                            <th>Bendravimo ivertis</th>
                                            <th>Greicio ivertis</th>
                                        @endif
                                        <th>Veiksmai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bilietas as $biliet)
                                    <tr>
                                        @if (auth()->user()->user_type != \App\Models\User::ROLE_USER)
                                        <td style="vertical-align: middle">{{ $biliet->id }}</td>
                                        @endif
                                        <td style="vertical-align: middle">{{ $biliet->pavadinimas }}</td>
                                        <td style="vertical-align: middle">{{ $biliet->kategorija }}</td>
                                        <td style="vertical-align: middle">{{ $biliet->created_at }}</td>
                                            <td style="vertical-align: middle">
                                                @if ($biliet->aktyvumas == 1)
                                                    Aktyvus
                                                @else
                                                    Uždarytas
                                                @endif
                                            </td>
                                            @if (auth()->user()->user_type != \App\Models\User::ROLE_USER)

                                            <td style="vertical-align: middle">{{ $biliet->uzdarymas }}</td>
                                            <td style="vertical-align: middle">{{ $biliet->darbuotojo_komentaras }}</td>
                                            <td style="vertical-align: middle">{{ $biliet->vertinimo_data }}</td>
                                            <td style="vertical-align: middle">{{ $biliet->vartotojo_komentaras }}</td>
                                            <td style="vertical-align: middle">{{ $biliet->pagalbos_ivertis }}</td>
                                            <td style="vertical-align: middle">{{ $biliet->benravimo_ivertis }}</td>
                                            <td style="vertical-align: middle">{{ $biliet->greicio_ivertis }}</td>
                                            @endif
                                        <td style="vertical-align: middle">
                                                <a class="btn btn-link p-0" href="{{ route('bilietas', ['ID' => $biliet->id]) }}">Perziureti</a>
                                        @if ($biliet->aktyvumas == 1) |
                                                @if (auth()->user()->user_type == \App\Models\User::ROLE_WORKER)
                                                <a class="btn btn-link p-0" href="{{ route('uzdaryti', ['ID' => $biliet->id]) }}">Uždarymas</a>
                                                @endif
                                                @if (auth()->user()->user_type == \App\Models\User::ROLE_ADMIN)
                                                <a class="btn btn-link p-0" href="{{ route('paskirsti', ['ID' => $biliet->id]) }}">priskirimas</a>
                                                @endif
                                            @endif
                                            @if (auth()->user()->user_type == \App\Models\User::ROLE_USER && (is_null($biliet->vertinimo_data)) )
                                                <a class="btn btn-link p-0" href="{{ route('vertinti', ['ID' => $biliet->id]) }}">Vertinti</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
