@extends('layouts.master')
@section('content')
    <div class="content-wrapper">            
        <!--MAIN CONTENT-->
        <div class="content">
            <div class="container-fluid">        
                <div class="col-12 cuerpo-col-card">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 1em">
                        Crear Usuario
                    </button>
                    <div class="" id="contenedor-busqueda">
                    <div class="reportes-datatables">
                        <i class="icono-herramientas fa-solid fa-file-pdf"></i>
                        <a href="{{route('exportar.excel',['nombre' => 'users', 'campos' => ['id','name','identificacion','direccion','email']])}}"><i style="color: black" class="icono-herramientas fa-solid fa-file-excel"></i></a>
                        <i class="icono-herramientas fa-solid fa-file"></i>
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabla" style="width: 100%;">
                            <thead class="thead-datatables">
                                <tr>
                                    <th>ID</th> 
                                    <th>Nombre</th> 
                                    <th>Identificación</th>  
                                    <th>Correo</th>       
                                    <th>Acciones</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>  
                                        <td>{{$usuario->name}}</td> 
                                        <td>{{$usuario->identificacion}}</td>  
                                        <td>{{$usuario->email}}</td>
                                        <td class="justify-items-center">
                                            <a href="#" data-toggle="modal" data-target="#editar" onclick="consultarTabla('{{$usuario->id}}' , '{{$usuario->name}}' , '{{$usuario->identificacion}}' , '{{$usuario->email}}' , '{{$usuario->direccion}}');">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            /
                                            <a href="#" data-toggle="modal" data-target="#borrar" onclick="borrar('{{$usuario->id}}')">                                            
                                                <i class="fa fa-trash" style="color: red"></i>
                                            </a>
                                        </td>                                  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>              
            </div>
        </div>
    </div>

    <!-- Modal Create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crear') }}" methods="POST">                    
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input required type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Nombre Usuario">
                        </div>
                        <div class="form-group">
                            <label for="identificacion">Identificación</label>
                            <input type="number" min = "0" max="1000" class="form-control" name="identificacion" id="identificacion" placeholder="Identificación" required >
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input required type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Correo"></input>                        
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea required type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" spellcheck="false" autocomplete="off" maxlength="255"></textarea>                        
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contrasena</label>
                            <input required type="password" class="form-control" name="contrasena" id="contrasena" aria-describedby="contrasena" placeholder="Contrasena"></input>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('editar') }}" methods="POST">

                        <input type="text" class="form-control" name="id" id="id" style="display: none">

                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input required type="text" class="form-control" name="name" id="name2" aria-describedby="name2" placeholder="Nombre Usuario">
                        </div>
                        <div class="form-group">
                            <label for="identificacion">Identificación</label>
                            <input required type="number" class="form-control" name="identificacion" id="identificacion2" placeholder="Identificación">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input required type="email" class="form-control" name="email" id="email2" aria-describedby="email" placeholder="Correo"></input>                        
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea required type="text" class="form-control" name="direccion" id="direccion2" placeholder="Dirección" spellcheck="false" autocomplete="off" maxlength="255"></textarea>                        
                        </div>
                        <div class="form-group">
                            <label for="contrasena">Contrasena</label>
                            <input required type="password" class="form-control" name="contrasena" id="contrasena2" aria-describedby="contrasena" placeholder="Contrasena"></input>                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('borrar')}}" methods="POST">
                        <input type="number" class="form-control" name="id" id="id3" style="display: none">
                        Estas seguro de eliminar este usuario!.   
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Borrar Usuario</button>
                        </div>                 
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
