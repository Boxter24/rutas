<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini" >
    <div id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>            
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Sistema de Rutas</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                
                    <li class="nav-item">
                        <a href="/home" class="nav-link">
                        <i class="fa-solid fa-route nav-icon"></i>
                        <p>Rutas</p>
                        </a>
                    </li> 
                    
                    <li class="nav-item">
                        <a href="{{route('unidades_de_negocios')}}" class="nav-link">
                        <i class="fa-solid fa-briefcase nav-icon"></i>
                        <p>Unidades de Negocios</p>
                        </a>
                    </li> 

                    <li class="nav-item">
                        <a href="{{route('paises')}}" class="nav-link">
                        <i class="fa-solid fa-earth-americas nav-icon"></i>
                        <p>Paises</p>
                        </a>
                    </li> 
                    
                    </ul>
                </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <main>            
            @yield('content')                      
        </main>
    </div>
    <script src="/js/app.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        let URLactual = window.location.href;
        
        //Rutas
        if(URLactual == "{{route('home')}}"){
            $(document).ready(function () {
                $('#tabla').DataTable({
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Rutas",
                        "infoEmpty": "Mostrando 0 de 0 of 0 Rutas",
                        "infoFiltered": "(Filtrado de _MAX_ total Rutas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Rutas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin Rutas encontradas",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                },);
            });        
            //Rellenar Modal
            function consultarTabla(id_ruta,nombre,km,dias,estado){               
                document.getElementById("id").value = id_ruta;
                document.getElementById("nombre").value = nombre;
                document.getElementById("km").value = km;
                document.getElementById("dias").value = dias;

                //Agregando opciones al select
                document.getElementById("estado1").value = estado;
                document.getElementById("estado1").text = estado;
                if(estado == "activo"){
                    document.getElementById("estado2").value = "inactivo";
                    document.getElementById("estado2").text = "inactivo";
                }
                else{
                    document.getElementById("estado2").value = "activo";
                    document.getElementById("estado2").text = "activo";
                }
            }
            //Cambiar Estado Ruta
            function cambiarEstado(id,estado){
                console.log(id,estado);
                document.getElementById("id_cambiar_estado_ruta").value = id;            
                document.getElementById("cambiar_estado_ruta").value = estado;
                $('#cambiarEstado').trigger('click');
                
            }
            //Borrar Registro
            function borrar(id){
                console.log(id);
                document.getElementById("borrar_ruta").value = id;
            }
        }

        //Unidades de Negocios        
        else if(URLactual == "{{route('unidades_de_negocios')}}"){            
            $(document).ready(function () {
                $('#tabla').DataTable({
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Unidades de Negocios",
                        "infoEmpty": "Mostrando 0 to 0 de 0 Unidades de Negocios",
                        "infoFiltered": "(Filtrado de _MAX_ total Unidades de Negocios)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Unidades de Negocios",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin Unidades de Negocios encontradas",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                },);
            });   
            //Rellenar Modal
            function consultarTabla(id,nombre,estado){                    
                document.getElementById("id").value = id;        
                document.getElementById("nombre").value = nombre;

                //Agregando opciones al select
                document.getElementById("estado1").value = estado;
                document.getElementById("estado1").text = estado;
                if(estado == "activo"){
                    document.getElementById("estado2").value = "inactivo";
                    document.getElementById("estado2").text = "inactivo";
                }
                else{
                    document.getElementById("estado2").value = "activo";
                    document.getElementById("estado2").text = "activo";
                }
            }
            //Cambiar Estado 
            function cambiarEstado(id,estado){                
                document.getElementById("id_cambiar_estado_unidad_de_negocios").value = id;            
                document.getElementById("cambiar_estado_unidad_de_negocios").value = estado;
                $('#cambiarEstado').trigger('click');
                
            }
            //Borrar Registro
            function borrar(id){
                console.log(id);
                document.getElementById("borrar_unidad_de_negocios").value = id;
            }
        }
        
        //Paises       
        else if(URLactual == "{{route('paises')}}"){
            $(document).ready(function () {
                $('#tabla').DataTable({
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Paises",
                        "infoEmpty": "Mostrando 0 to 0 de 0 Paises",
                        "infoFiltered": "(Filtrado de _MAX_ total Paises)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Paises",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin Paises encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                },);
            });   
            //Rellenar Modal
            function consultarTabla(id,nombre,codigo_telefonico,estado){               
                document.getElementById("id").value = id;        
                document.getElementById("nombre").value = nombre;
                document.getElementById("codigo").value = codigo_telefonico;

                //Agregando opciones al select
                document.getElementById("estado1").value = estado;
                document.getElementById("estado1").text = estado;
                if(estado == "activo"){
                    document.getElementById("estado2").value = "inactivo";
                    document.getElementById("estado2").text = "inactivo";
                }
                else{
                    document.getElementById("estado2").value = "activo";
                    document.getElementById("estado2").text = "activo";
                }
            }
            //Cambiar Estado 
            function cambiarEstado(id,estado){
                console.log(id,estado);
                document.getElementById("id_cambiar_estado_pais").value = id;            
                document.getElementById("cambiar_estado_pais").value = estado;
                $('#cambiarEstado').trigger('click');
                
            }
            //Borrar Registro
            function borrar(id){
                console.log(id);
                document.getElementById("borrar_pais").value = id;
            }
        }

        //General
        //Habilitar boton de importar una vez cargado un archivo EXCEL
        $("#documento").change(function(){
            $("#importar").prop("disabled", this.files.length == 0);
            $("#importar").css("background", "rgba(0, 0, 0, 0) linear-gradient(169deg, rgb(0, 0, 0) 0%, rgb(0, 186, 255) 100%) repeat scroll 0% 0%");
        });
        
        //Restringir uso de nr y Caracteres Especiales en el nombre de una ruta
        function check(e) {
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patrón de entrada, en este caso solo acepta numeros y letras
            patron = /[A-Za-z--]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
    </script>
</body>
</html>
