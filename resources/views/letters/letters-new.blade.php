@extends('template.app')

@section('content')
    <div class='card shadow'>
        <div class='card-header'>
            <h4 class='text-primary font-weight-bold'>Create New Letter</h4>
        </div>

        <div class='card-body'>
            @if( $template->count() != 0 )
                <center>
                    <h2 class='fas fa-envelope'></h2>
                    <p>Buat Surat Dengan Template Yang Tersedia</p>
                
                    <div>
                        <table class='table'>
                            <tr>
                                <th>Name</th>
                                <th>From</th>
                                <th>Use</th>
                            </tr>

                            @foreach( $template as $data )
                                <tr>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->from }}</td>
                                    <td><a class='btn btn-success' href={{ route('custom-template-input', $data->id) }}>Use This!</a></td>
                                </tr>
                            @endforeach
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                  <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                               @foreach( $template->links()->elements[0] as $x )
                                    <li class="page-item"><a class="page-link" href="{{ $x }}">{{ $loop->iteration }}</a></li>
                               @endforeach
                                    <li class="page-item">
                                      <a class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>
                              </ul>
                        </nav>
                    </div>
            </center>
        @else
            @if( Session::get('role') == 'admin' )
                <center>
                    <h1 class='fas fa-box-open'></h1>
                    <h4>Template Masih Kosong !</h4>
                    <h5>Silahkan buat template baru</h5>
                </center>
            @else
                <center>
                    <h1 class='fas fa-box-open'></h1>
                    <h4>Template Masih Kosong !</h4>
                    <h5>Hubungi admin untuk membuat template baru</h5>
                </center>
            @endif
        @endif
        </div>
    </div>
@endsection
