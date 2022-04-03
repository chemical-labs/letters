@extends('template.app')

@section('content')
    <div class='card shadow'>
        <div class='card-header'>
            <h4 class='text-primary font-weight-bold'>Create a letters</h4>
        </div>

        <div class='card-body'>
            <form class='form' action={{ route('create-custom-letters', $data->id) }} method="post">
                @csrf
                <b class='text-primary'>Name Letters</b>
                <input class='form-control mb-2' placeholder="Name" name='name' />
                <b class='text-primary'>Tanggal Surat</b>
                @if( $data->tanggal )
                    <input type='date' class='form-control mt-1' name='tanggal' />
                @endif

                @if( $data->nomor_surat )
                    <input type='text' class='form-control mt-3' placeholder='Nomor Surat' name='nomor_surat' />
                @endif

                @if( $data->perihal )
                    <input type='text' class='form-control mt-3' placeholder='Perihal' name='perihal' />
                @endif

                @if( $data->tujuan )
                    <input type='text' class='form-control mt-3 mb-3' placeholder='Tujuan' name='tujuan' />
                @endif

                @if( $data->salam_pembuka )
                    <h5 class='text-primary font-weight-bold mt-3'>Salam Pembuka</h5>
                    <textarea id="pembuka" name='salam_pembuka'></textarea>
                @endif

                @if( $data->penutup )
                    <h5 class='text-primary font-weight-bold mt-3'>Salam Penutup</h5>
                    <textarea id="penutup" name='penutup'></textarea>
                @endif

                @if( $data->ttd )
                    <input type='text' class='form-control mt-3 mb-3' placeholder='Tanda Tangan' name='ttd' />
                @endif

                @if( $data->tembusan )
                    <input type='text' class='form-control mt-3 mb-3' placeholder='Tembusan' name='tembusan' />
                @endif
                
                <button class='btn btn-success' type='submit'>Create</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
          tinymce.init({
              selector: 'textarea#pembuka',
              menubar: true
            });

          tinymce.init({
              selector: 'textarea#isi',
              menubar: true
            });

          tinymce.init({
              selector: 'textarea#penutup',
              menubar: true
            });
    </script>
@endsection
