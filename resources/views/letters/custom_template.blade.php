@extends('template.app')

@section('content')
    <div class="card shadow">
        <div class='card-header'>
            <h3 class='text-primary font-weight-bold'>Create a template</h3>
        </div>

        <div class='card-body'>
            <form class='form' action={{ route('custom-template-create') }} method="post" enctype="multipart/form-data">
                @csrf
                <p class='font-weight-bold'>Title</p>
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <input class="input-group-text" type='color' id="x" style="padding: 5px; height: 38px" name='tone'>
                    </div>
                    <input class='form-control' placeholder='Masukkan Judul Surat' name='title' aria-describedby="x" />
                </div>
                <span class='font-weight-bold'>Icons</span>
                <input class='form-control mt-2 mb-3' type='file' name='icons'/>

                <span class='font-weight-bold'>Alamat</span>
                <input class='form-control mt-2 mb-2' placeholder='Masukkan Alamat' name='address' aria-describedby="x" />

                <span class='font-weight-bold'>Kontak</span>
                <input class='form-control mt-2' placeholder='Masukkan Kontak' name='contact' aria-describedby="x" />

                <div class='mt-10' style="margin-top: 3%">
                    <h5 class='mt-10 font-weight-bold text-primary'>Form Input Surat</h5>
                    <div class='row ml-1 mt-3'>
                        <div>
                            <p class='font-weight-bold'>Tanggal Surat</p>
                            <select class='form-control' name='tanggal_surat'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>

                        <div class='ml-5'>
                            <p class='font-weight-bold'>Nomor Surat</p>
                            <select class='form-control' name='nomor_surat'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>

                        <div class='ml-5'>
                            <p class='font-weight-bold'>Perihal</p>
                            <select class='form-control' name='perihal'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>

                        <div class='ml-5'>
                            <p class='font-weight-bold'>Tujuan</p>
                            <select class='form-control' name='tujuan'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>
                    </div>

                    <div class='row ml-1 mt-3'>
                        <div>
                            <p class='font-weight-bold'>Salam Pembuka</p>
                            <select class='form-control' name='salam_pembuka'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>

                        <div class='ml-5'>
                            <p class='font-weight-bold'>Penutup</p>
                            <select class='form-control' name='penutup'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>

                        <div class='ml-5'>
                            <p class='font-weight-bold'>TTD</p>
                            <select class='form-control' name='ttd'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>

                        <div class='ml-5'>
                            <p class='font-weight-bold'>Tembusan</p>
                            <select class='form-control' name='tembusan'>
                                <option value='yes'>Yes</option>
                                <option value='no'>No</option>
                            </select>
                        </div>
                    </div>

                    <div class='mt-5'>
                        <h5 class='mt-10 font-weight-bold text-primary'>Isi Surat</h5>
                        <textarea id='editor' name='body'></textarea>
                    </div>
                    <button class='btn btn-success mt-4 ml-1' type='submit'>Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
          tinymce.init({
              selector: 'textarea#editor',
              menubar: true
            });
    </script>
@endsection
