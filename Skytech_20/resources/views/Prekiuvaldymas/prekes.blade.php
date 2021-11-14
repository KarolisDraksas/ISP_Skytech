@extends('layouts.app')

@section('content')
    <div class="container">
    Filtras:
    <a href="{{ route('filtrinti', 'motinine') }}">Motininė ploštė</a> |
    <a href="{{ route('filtrinti', 'vaizdo') }}">Vaidzdo ploktė</a> |
    <a href="{{ route('filtrinti', 'diskas') }}">Diskas</a> |
    <a href="{{ route('filtrinti', 'ram') }}">Ram</a> |
    <a href="{{ route('filtrinti', 'procesorius') }}">Procesorius</a> |
    <a href="{{ route('filtrinti', 'maitinimas') }}">Maitinimo šaltinis</a> |
    <a href="{{ route('filtrinti', 'korpusas') }}">Korpusas</a> |
    <a href="{{ route('filtrinti', '') }}">Visi</a> 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Parduotuves prekes') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class = "alert" role="alert">
                            {{session('success')}}
                            </div>
                        @endif
                        @if (auth()->user()->user_type == \App\Models\User::ROLE_ADMIN)
                        <a class="btn btn-primary" href="{{ route('ataskaitoskriterij') }}">{{ __('Ataskaitos kriterių langas') }}</a>
                           <br>
                           <br>
                           <br>
                        @endif

                        
            <table id="datatable-buttons" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Kodas</th>
                        <th>Pavadinimas</th>
                        <th>Gamintojas</th>
                        <th>Aprašymas</th>
                        <th>Kategorija</th>
                        <th>Kaina</th>
                        <th>Kiekis</th>
                        <th>Veiksmai</th>
                     </tr>
                 </thead>
                    <tbody>
                        @foreach($prekes as $preke)
                            <tr>
                                <td style="vertical-align: middle">{{ $preke-> kodas }}</td>
                                <td style="vertical-align: middle">{{ $preke->pavadinimas }}</td>
                                <td style="vertical-align: middle">{{ $preke->gamintojas }}</td>
                                <td style="vertical-align: middle">{{ $preke->aprašymas }}</td>
                                <td style="vertical-align: middle">{{ $preke->kategorija }}</td>
                                <td style="vertical-align: middle">{{ $preke->kaina }}</td>
                                <td style="vertical-align: middle">{{ $preke->kiekis }}</td>
                                <td style="vertical-align: middle">
                                
                                <a class="btn btn-primary" href="{{ route('preke', $preke->id) }}"><butto>{{__('Peržiūrėti')}}</butto></a>
        

                                @if (auth()->user()->user_type == \App\Models\User::ROLE_USER) 
                                    <form style="display: inline;" method="post" action="{{ route('isiminti', ['ID' => $preke->id]) }}" >
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0">Įsiminti</button>
                                    </form>
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
