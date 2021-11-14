@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Nepatvirtinti užsakymai') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap mt-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Nr</th>
                                    <th>Data</th>
                                    <th>Suma</th>
                                    <th>Pristatymo būdas</th>
                                    <th>Adresas</th>
                                    <th>Būsena</th>
                                    <th colspan="2">Veiksmai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($uzsakymai as $uzsakymas)
                                    <tr>
                                        <?php  $i=1;?>
                                        <td style="vertical-align: middle"><?php echo $i;?></td>
                                        <td style="vertical-align: middle">{{ $uzsakymas->created_at }}</td>
                                        <td style="vertical-align: middle">{{ $uzsakymas->kaina }}€</td>
                                        <td style="vertical-align: middle">{{ $uzsakymas->kategorija }}</td>
                                        <td style="vertical-align: middle">{{ $uzsakymas->adresas }}</td>
                                        <td style="vertical-align: middle">{{$uzsakymas->statusas }}</td>
                                        <td style="vertical-align: middle"><a href="{{route('uzsakymas', $uzsakymas->id)}}"><button class="btn btn-sm btn-primary">Peržiūrėti</button></a></td>
                                        <td style="vertical-align: middle">
                                            @if( ($uzsakymas->statusas == 'Išsiųstas' ) || ($uzsakymas->statusas == 'Pristatytas'))
                                            @else
                                                <form style="display: inline;" method="post" action="{{ route('deleteOrder', ['ID' => $uzsakymas->id]) }}" onclick="return confirm('Ar tikrai norite pašalinti?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger"  >Atšaukti</button>
                                                </form>
                                            @endif
                                        </td>

                                    </tr>
                                    <?php  $i++;?>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
