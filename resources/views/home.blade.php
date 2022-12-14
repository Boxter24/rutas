@extends('layouts.master')
@section('content')
    <div class="content-wrapper">            
        <!--MAIN CONTENT-->
        <div class="content">
            <div class="container-fluid">               
                @if (session()->has('msj'))
                    @if (session('msj') == "Exito")
                        <div class="msjExito" onclick="this.style='display:none'">Importación exitosa</div>
                        <div class="msjNota" onclick="this.style='display:none'">Nota: Si una ruta ya esta en la BBDD, ésta será ignorada y no se guardará</div>
                    @elseif (substr(session('msj'),0,5) == "Error")
                        <div class="msjError" onclick="this.style='display:none'">Ya existe el registro: "{{substr(session('msj'),5)}}"</div>
                    @else
                        
                    @endif                    
                @endif
                <div class="col-12 cuerpo-col-card" style="margin-top: 30px;">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 1em">
                        Crear Ruta
                    </button>
                    <div class="" id="contenedor-busqueda">
                    <div class="reportes-datatables">       
                        <div class="export">
                            <a href="{{route('exportar.excel',['nombre' => 'rutas', 'campos' => ['id','nombre_ruta','km_ruta','dias_ruta']])}}"><i style="color: black;width: 40px;" class="icono-herramientas fa-solid fa-file-excel"></i></a>
                            <a href="{{route('exportar.pdf',['nombre' => 'rutas', 'campos' => ['nombre_ruta','km_ruta','dias_ruta']])}}"><i style="color: black;width: 40px;" class="icono-herramientas fa-solid fa-file-pdf"></i></a>
                        </div>                                         
                        <div class="import">                            
                            <form action="{{route('importar.excel')}}" method="post" enctype="multipart/form-data">                                
                                @csrf

                                <input type="file" id="documento" name="documento" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel">
                                <span class="subir-archivo">Subir Archivo</span>
                                <button id="importar" disabled="disabled" type="submit">Importar</button>
                            </form>                            
                        </div>
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabla" style="width: 100%;">
                            <thead class="thead-datatables">
                                <tr>
                                    <th>Item</th> 
                                    <th>Nombre Ruta</th>                                     
                                    <th>Km</th>       
                                    <th>Días</th>   
                                    <th>Estado</th>   
                                    <th>Opciones</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rutas as $ruta)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>  
                                        <td>{{$ruta->nombre_ruta}}</td>                                         
                                        <td>{{$ruta->km_ruta}}</td>
                                        <td>{{$ruta->dias_ruta}}</td>
                                        <td> 
                                            <div class="opciones">
                                                <a href="#" onclick="cambiarEstado('{{$ruta->id}}' , '{{$ruta->estado_ruta}}')">                                            
                                                    <i class="fa {{$ruta->estado_ruta == "activo" ? "fa-eye" : "fa-eye-slash"}}"></i>
                                                </a>
                                            </div>                                                                                                   
                                        </td>
                                        <td class="opciones">
                                            <div class="opciones">
                                                <a href="#" data-toggle="modal" data-target="#editar" onclick="consultarTabla('{{$ruta->id}}' , '{{$ruta->nombre_ruta}}' , '{{$ruta->km_ruta}}' , '{{$ruta->dias_ruta}}' , '{{$ruta->estado_ruta}}');">
                                                    <i class="fa fa-edit"></i>
                                                </a>                                            
                                                <span class="separador">/</span>
                                                <a href="#" data-toggle="modal" data-target="#borrar" onclick="borrar('{{$ruta->id}}')">                                            
                                                    <i class="fa fa-trash" style="color: red"></i>
                                                </a>
                                            </div>                                                                                        
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
                    <h5 class="modal-title" id="exampleModalLabel">Crear Ruta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crear') }}" methods="POST">                    
                        <div class="form-group">
                            <label for="nombre_ruta">Nombre Ruta</label>
                            <input required type="text" class="form-control" name="nombre_ruta" id="nombre_ruta" aria-describedby="nombre_ruta" placeholder="Nombre Ruta" onkeypress="return check(event)">
                        </div>                                                
                        <div class="form-group">
                            <label for="km_ruta">Km</label>
                            <input required type="number" class="form-control" name="km_ruta" id="km_ruta" placeholder="Km Ruta" spellcheck="false" autocomplete="off" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label for="dias_ruta">Días</label>
                            <input required type="number" class="form-control" name="dias_ruta" id="dias_ruta" aria-describedby="dias_ruta" placeholder="Dias">                       
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear Ruta</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Ruta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('editar') }}" methods="POST">

                        <input type="text" class="form-control" name="id" id="id" style="display: none">

                        <div class="form-group">
                            <label for="nombre_ruta">Nombre Ruta</label>
                            <input required type="text" class="form-control" name="nombre_ruta" id="nombre" aria-describedby="nombre_ruta" placeholder="Nombre Ruta" onkeypress="return check(event)">
                        </div>                                                
                        <div class="form-group">
                            <label for="km_ruta">Km</label>
                            <input required type="number" class="form-control" name="km_ruta" id="km" placeholder="Km Ruta" spellcheck="false" autocomplete="off" maxlength="5">                     
                        </div>
                        <div class="form-group">
                            <label for="dias_ruta">Días</label>
                            <input required type="number" class="form-control" name="dias_ruta" id="dias" aria-describedby="dias_ruta" placeholder="Dias">                       
                        </div>
                        <div class="form-group">
                            <label for="estado_ruta">estado</label>
                            <select name="estado_ruta" id="estado" class="form-control">
                                <option value="" id="estado1"></option>
                                <option value="" id="estado2"></option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar Ruta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Cambiar Estado-->
    <form action="{{route('cambiar.estado')}}" methods="POST" style="display: none">
        <input type="number" class="form-control" name="id" id="id_cambiar_estado_ruta"> 
        <div class="form-group">
            <label for="cambiar_estado">Estado</label>
            <input required type="text" class="form-control" name="cambiar_estado" id="cambiar_estado_ruta">                       
        </div>               
        <button type="submit" class="btn btn-primary" id="cambiarEstado">Cambiar Estado Ruta</button>                        
    </form>

    <!-- Modal Delete -->
    <div class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Ruta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('borrar')}}" methods="POST">
                        <input type="number" class="form-control" name="id" id="borrar_ruta" style="display: none">
                        Estas seguro de eliminar esta Ruta?.   
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Borrar Ruta</button>
                        </div>                 
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

