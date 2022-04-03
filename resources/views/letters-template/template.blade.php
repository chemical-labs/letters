<html>
    <head>
        <title>Layout : {{ $title }}.pdf</title>
    </head>

<style>

</style>

    <body>
        @if( $icons == 'none.png' || $icons == null)
            <div>
                <center>
                    <h2 style="color: {{ $tone }}">{{ $title }}</h2>
                    @if( $overview )
                        @if( $address )
                            <p style="margin-top: -2%">[ User Input Address ]</p>
                        @endif
                    @else
                        @if( $address )
                            <p style="margin-top: -2%">{{ $address }}</p>
                        @endif
                    @endif
                    
                    @if( $overview )
                        @if( $contact )
                            <p style="margin-top: -1%">[ User Input Contact ]</p>
                        @endif
                    @else
                        @if( $contact )
                            <p style="margin-top: -1%">{{ $contact }}</p>
                        @endif
                    @endif

                </center>
            </div>
        @else
            <div class='header'>
                <div>
                    <img src= width='90px' height='90px' />
                </div>
                <div style='position: absolute; top: -5; left: 70'>
                    <h2 style="color: {{ $tone }}">{{ $title }}</h2>
                    @if( $overview )
                        @if( $address )
                            <p style="margin-top: -2%">[ User Input Address ]</p>
                        @endif
                    @else
                        @if( $address )
                            <p style="margin-top: -2%">{{ $address }}</p>
                        @endif
                    @endif
                    
                    @if( $overview )
                        @if( $contact )
                            <p style="margin-top: -1%">[ User Input Contact ]</p>
                        @endif
                    @else
                        @if( $contact )
                            <p style="margin-top: -1%">{{ $contact }}</p>
                        @endif
                    @endif
                </div>
            </div>
        @endif
        <hr style="margin-top: -1%; background: black;">
        <hr style="margin-top: -1%; background: black; height: 2px; margin-top: -6px">
        

        <div style="display: flex; flex-direction: row;">
            <div>
                @if( $overview )
                    @if( $nomor_surat )
                        <p>Nomor: [ Nomor Surat ]</p>
                    @endif
                @else
                    @if( $nomor_surat )
                        <p>Nomor: {{ $nomor_surat }}</p>
                    @endif
                @endif
               
                @if( $overview )
                    @if( $perihal )
                        <p style="margin-top: -1.5%">Perihal : [ Input Perihal ]</p>
                    @endif
                @else
                    @if( $perihal )
                        <p style="margin-top: -1.5%">Perihal : {{ $perihal }}</p>
                    @endif
                @endif
            </div>

            <div style="float:right">
                @if( $overview )
                    @if( $tanggal )
                        <p>Bogor, {{ Date('d') }} {{ Date('M') }} {{ Date('Y') }}</p>
                    @endif
                @else
                    @if( $tanggal )
                        <p>Bogor, {{ $tanggal }}</p>
                    @endif
                @endif
            </div>
        </div>

        <div style="margin-top: 5%">
            @if( $overview )
                @if( $salam_pembuka )
                    <b>Yth.Kepada....</b><br>
                    <b>[ User Input ]</b>
                @endif
            @else
                @if( $salam_pembuka )
                    {!! $salam_pembuka !!}
                @endif
            @endif
        </div>

        <div style="margin-top: 5%">
            {!! $body !!}
        </div>

        <div>
            @if( $overview )
                @if( $penutup )
                    <p>Demikian pemberitahuan kami sampaikan, Atas perhatian dan kerjasama Bapak/Ibu kami ucapkan terima kasih <b>/ [ User Input ]</b></p>
                @endif
            @else
                @if( $penutup )
                    {!! $penutup !!}
                @endif
            @endif
        </div>

        <div style="margin-top: 5%; float: right;">
            @if( $overview )
                @if( $ttd )
                    <p style="margin-bottom: 15%">Kepala Sekolah</p>
                    <b style="">[ Users Input ]</b>
                @endif
            @else
                @if( $ttd )
                    <p style="margin-bottom: 15%">Kepala Sekolah</p>
                    <b style="">{{ $ttd }}</b>
                @endif
            @endif
        </div>

        <div style="margin-top: 8%">
            @if( $overview )
                @if( $tembusan )
                    <p>Tembusan : </p>
                    <p><b>[ User Input ]</b><p>
                @endif
            @else
                @if( $tembusan )
                    <p>Tembusan : </p>
                    {!! $tembusan !!}
                @endif
            @endif
        </div>
    </body>
</html>
