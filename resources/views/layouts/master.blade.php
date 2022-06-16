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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
            <span class="brand-text font-weight-light">AdminLTE 3</span>
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
                        <i class="fa-solid fa-user nav-icon"></i>
                        <p>Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/inverso" class="nav-link">
                        <i class="fa-solid fa-user nav-icon"></i>
                        <p>Inverso</p>
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
        $(document).ready(function () {
            $('#tabla').DataTable();
        });
        function reverse(s){
            let mensaje = document.getElementById("mensaje").value;            
            document.getElementById("estructura1").innerHTML = mensaje.split("").reverse().join("");
        };
        function reverse2(){
            var nuevaCadena = "";
            
            let mensaje = document.getElementById("mensaje2").value;            
            for (var i = mensaje.length - 1; i >= 0; i--) { 
                nuevaCadena += mensaje[i]; 
            }
            document.getElementById("estructura2").innerHTML = nuevaCadena;
        };
        function consultarTabla(id,name,identificacion,email,direccion){
            document.getElementById("id").value = id;
            document.getElementById("name2").value = name;
            document.getElementById("identificacion2").value = identificacion;
            document.getElementById("email2").value = email;
            document.getElementById("direccion2").value = direccion;
        }
        function borrar(id){
            console.log(id);
            document.getElementById("id3").value = id;
        }
    </script>
</body>
</html>
