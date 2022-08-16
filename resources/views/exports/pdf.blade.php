
<head>
    <style>
        @page {
            margin: 100px 25px;
        }
        body {
            margin-top: 2cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
            font-family: open sans;
        }
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 90px;
            background-color: #23888a;
            color: white;
            text-align: center;
        }
        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 38px;
            background-color: #23888a;
            color: white;
            text-align: center;
            font-size: 12px;
        }
        table {
            width: 100%;
        }
        .contenido th,
        .contenido td {
            width: 20%;
            text-align: center;
            color: rgba(52, 58, 74, 1);
        }
        .contenido td {
            height: 35px;
            font-size: 10px;
        }
        .contenido th {
            color: white;
            font-size: 12px;
        }
        .t-header {
            border-bottom: 1px solid #999;
            background: #23888a;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<title>Rutas</title>

<body>
    <header>
        <div style="display:flex; margin:0; padding: 0 10px">
            <div style="width: 150px; margin: 0;padding:10px 0">
                <img style="margin:0;padding:0" src="{{ asset('/img/logo.jpg') }}" width="100%" height="70px" style="border-radius: 12px">
            </div>
            <div style="margin:0;text-align: right">
                <p style="width: 100%;text-align: right;margin:0; padding:10px 0; font-size: 12px;font-family: Arial;">
                    Reporte Generado el {{ $fecha }}
                </p>
            </div>
            <div style="text-align: center;margin:0;padding:25px 0;font-family: Arial;">
                <h3 style="margin:0;padding:0">{{strtoupper($modulo)}}</h3>
                <h4 style="margin:0;padding:10px 0">Listado de {{ $modulo }}</h4>
            </div>
        </div>
    </header>

    <main>
        <div style="column-count: 1;">
            <div class="contenido">
                <table class="table table-stripe w-100" id="tabla">
                    <thead>
                        <tr class="t-header">
                            <th style="width: 5%;">Nº</th>  
                            @for ($i = 0; $i < count($campos); $i++)                                    
                                <th style="width: (100/count($campos))%;">{{str_replace("_", " ", strtoupper($campos[$i]))}}</th>
                            @endfor                                                       
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consulta as $data)                                                    
                            <tr>                                
                                <td style="width: 5%;">{{ $loop->iteration }}</td>
                                @for ($i = 0; $i < count($campos); $i++)     
                                    @php
                                        $campo = $campos[$i];
                                    @endphp                                   
                                    <td>{{ strtoupper($data->$campo) }}</td>                                       
                                @endfor                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/php">
            if ( isset($pdf) ) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Open sans, Helvetica, sans-serif", "normal");
                    $pdf->text(270, 740, "Página $PAGE_NUM de $PAGE_COUNT", $font, 9);
                ');
            }
        </script>
    </main>
    <footer>
        <p style="padding-top: 1px;margin:0; font-size: 14px; font-weight: bold">Sistema de {{$modulo}}</p>
        <p style="padding-top: 1px;margin:0"> © 2022 Todos los derechos reservados.</p>

    </footer>

</body>

</html>