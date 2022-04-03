@extends('template.app')

@section('content')
    <div class='card shadow'>
        <div class='card-header'>
            <h4 class='text-primary font-weight-bold'>Letters Template</h4>
        </div>
        <div class='card-body'>
            @if( $mode == 'fully_custom' )
                <a class='btn btn-outline-success mb-3 mr-5' href={{ route('template-letter', ['template' => 'template']) }} name='template' value='x' style="float: right;">Template</a>
            @else
                <a class='btn btn-outline-success mb-3 mr-5' href={{ route('template-letter', ['template' => 'fully_custom']) }} name='template' value='x' style="float: right;">Fully Custom</a>
            @endif
            @if( $data->count() == 0 )
                <center style="margin-top: 10%">
                    <h2 class='fas fa-box-open'></h2>
                    <h4>Template Masih Kosong !</h4>
                    <h5>Silahkan Tambahkan Template Terlebih Dahulu</h5>
                </center>
            @else
                <table class='table'>
                    <tr>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Overview</th>
                        <th>Modify</th>
                    </tr>
                @foreach($data as $x)
                    <tr>
                        <td>{{ $x->title }}</td>
                        <td>{{ $x->date }}</td>
                        <td>
                            <a class='btn btn-success' href={{ route('overview-letter', ['id' => $x->id, 'type' => $mode]) }}>Overview</a>
                        </td>
                        <td>
                            <a class='btn btn-danger' href={{ route('delete-letter', ['id' => $x->id, 'type' => $mode]) }}><span class='fas fa-trash'></span></a>
                            <a class='btn btn-warning'><span class='fas fa-edit'></span></a>
                        </td>
                    </tr>
                @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection
