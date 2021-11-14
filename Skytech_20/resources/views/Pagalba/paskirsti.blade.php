@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Paskirstimo forma') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

{{--                        {{ __('Paskirstimo informacija') }}--}}
{{--                        <a class="btn btn-primary" href="{{ route('pagalbos') }}">{{ __('uzpildziau') }}</a>--}}
                            <table id="datatable-buttons" class="table table-sm table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vardas</th>
                                    <th>Kiek priskirta</th>
                                    <th>Veiksmai</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td style="vertical-align: middle">{{ $user->id }}</td>
                                        <td style="vertical-align: middle">{{ $user->name }}</td>
                                        <td style="vertical-align: middle">{{ $result[$key] }}</td>
                                        <td style="vertical-align: middle">
                                            @if ($user->id == $ID_pris)
                                                Priskirtas šiam darbuotojui
                                            @else
                                            <form style="display: inline;" method="post" action="{{ route('createBilietoPriskirimas', ['ID' => $ID, 'ID_user' => $user->id]) }}" onclick="return confirm('Are jūs tikras?')">
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0">Priskirti</button>
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
