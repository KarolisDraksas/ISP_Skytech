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
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Pavadinimas</th>
                                <th>Kategorija</th>
                                <th>Sukurta</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="vertical-align: middle">{{ $bilietas->pavadinimas }}</td>
                                    <td style="vertical-align: middle">{{ $bilietas->kategorija }}</td>
                                    <td style="vertical-align: middle">{{ $bilietas->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <br>
                        @foreach($zinutes as  $index=>$zinute)
                            <div class="row justify-content-left">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div>
                                            <div class="float-left meta">
                                                <div class="title h5">
                                                    <a href="#"><b>#{{$index+1}}. {{$zinute->zinutesUser->name}}</b></a>
                                                </div>
                                                <h6 class="text-muted time">{{$zinute->created_at}}</h6>
                                            </div>
                                        </div>
                                        <div>
                                            <p>{{$zinute->tekstas}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <br>
                        <br>
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                <form method="post" action="{{ route('createKomentaras') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tekstas">Naujas Komentaras</label>
                                        <textarea rows="3" type="text" class="form-control" name="tekstas" id="tekstas" aria-describedby="emailHelp" placeholder="Įveskite tekstą"></textarea>
                                        @error('tekstas')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <input type="hidden" id="id" name="id" value={{ $bilietas->id }}>
                                    <button type="submit" class="btn btn-success">Parašyti žinutę</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
