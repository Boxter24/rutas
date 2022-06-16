@php
    $fecha = 0;
    $dia = date('Y-m-d H:i:s');
@endphp

<table>
    <thead>
        @for($i=0; $i<2; $i++)
            <tr>
                @for($j=0; $j<=sizeof($header); $j++)
                    @if($fecha == 0)                              
                        <td>
                            Reporte Generado el: {{$dia}}
                        </td> 
                        @php
                            $fecha = 1;
                        @endphp                  
                    @endif
                @endfor
            </tr>
            <tr>
                <td>Listado de {{str_replace("_", " ", $nombre)}}</td>
            </tr>
        @endfor
        <tr>             
            @foreach($header as $text)
                <td>{{str_replace("_", " ", $text)}}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($datos ?? '' as $dato)
            <tr>
                @foreach($header as $text)
                    <td>{{$dato->$text}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>