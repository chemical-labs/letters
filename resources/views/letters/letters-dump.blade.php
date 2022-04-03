@extends('template.app')

@section('content')
    <div class='card'>
        <div class='card-header'>
            <h4 class='text-primary font-weight-bold'>My Letters</h4>
        </div>

        <div class='card-body'>
            @if( $data->count() != 0 )
                <table class='table'>
                    <tr>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>View</th>
                        <th>Trash</th>
                    </tr>

                    @foreach( $data as $x )
                        <tr>
                            <td>{{ $x->name }}</td>
                            <td>{{ $x->date }}</td>
                            <td><a class='btn btn-outline-success' href={{ route('letters-my-render', $x->id) }}>Overview</a></td>
                            <td><a class='btn btn-outline-danger' href={{ route('letters-my-delete', $x->id) }}><span class='fa fa-trash'></span></a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <center>
                    <h1 class='fas fa-box-open'></h1>
                    <h4>Ups.. Surat anda masih kosong</h4>
                    <h4>Silahkan buat surat di menu "Buat Surat"</h4>
                </center>
            @endif
        </div>
    </div>
@endsection
