@extends('template.app')

@section('content')
    <div class='card shadow'>
        <div class='card-header'>
            <h3 class='text-primary p-3'>Choose Template</h3>
        </div>

        <div class='card-body'>
            <center>
                <div class='mt-5'>
                    <h1 class='fa fa-scroll'></h1>
                    <h4>Pilih mode template, manual atau otomatis</h4>
                </div>
                <div class='row p-5 mt-10 justify-content-center'>
                    <a href={{ route('custom-letter') }} class='card w-10 shadow p-5 mr-5'>
                        <center>
                            <img src={{ url('assets/illustrations/manual.svg') }} width="200px" />
                            <h4 class='mt-3 text-primary'>Fully Custom</h4>
                        </center>
                    </a>

                    <a href={{ route('custom-template-letter') }} class='card w-10 shadow p-5 ml-5'>
                        <center>
                            <img src={{ url('assets/illustrations/template.svg') }} width="200px" />
                            <h4 class='mt-3 text-primary'>Template</h4>
                        </center>
                    </a>
                </div>
            </center>
        </div>
    </div>
@endsection
