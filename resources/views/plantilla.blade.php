@extends('layouts.master')
@section('content')
    <div class="content-wrapper">            
        <!--MAIN CONTENT-->
        <div class="content">
            <div class="container-fluid">               
                @if (session()->has('msj'))
                    @if (session('msj') == "Exito")
                        <div class="msjExito" onclick="this.style='display:none'">Importación exitosa</div>
                        <div class="msjNota" onclick="this.style='display:none'">Nota: Si un Registro ya esta en la BBDD, ésta será ignorado y no se guardará</div>
                    @elseif (substr(session('msj'),0,5) == "Error")
                        <div class="msjError" onclick="this.style='display:none'">Ya existe el registro: "{{substr(session('msj'),5)}}"</div>
                    @else
                        
                    @endif                   
                @endif
                <div class="col-12 cuerpo-col-card" style="margin-top: 30px;">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-bottom: 1em">
                        Crear {{$modulo['singular']}}                        
                    </button>
                    <div class="" id="contenedor-busqueda">
                    <div class="reportes-datatables">       
                        <div class="export">
                            <a href="{{route('exportar.excel',['nombre' => $modulo['nombre'], 'campos' => ['nombre','estado']])}}"><i style="color: black;width: 40px;" class="icono-herramientas fa-solid fa-file-excel"></i></a>
                            <a href="{{route('exportar.pdf',['nombre' => $modulo['nombre'], 'campos' => ['nombre','estado']])}}"><i style="color: black;width: 40px;" class="icono-herramientas fa-solid fa-file-pdf"></i></a>
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
                                    @for ($i = 0; $i < count($campos); $i++)                                    
                                        <th>{{strtoupper($campos[$i])}}</th>
                                    @endfor                                                                        
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datos as $dato)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>  
                                        @for ($i = 0; $i < count($data); $i++)     
                                            @php
                                                $campo = $data[$i];
                                            @endphp                                   
                                            <td>{{$dato->$campo}}</td>                                       
                                        @endfor
                                        <td> 
                                            <div class="opciones">
                                                <a href="#" onclick="cambiarEstado('{{$dato->id}}' , '{{$dato->estado}}')">                                            
                                                    <i class="fa {{$dato->estado == "activo" ? "fa-eye" : "fa-eye-slash"}}"></i>
                                                </a>
                                            </div>                                                                                                   
                                        </td>
                                        <td class="opciones">
                                            <div class="opciones">
                                                <a href="#" data-toggle="modal" data-target="#editar" onclick="consultarTabla('{{$dato->id}}' , '{{$dato->nombre}}' , '{{$dato->estado}}');">
                                                    <i class="fa fa-edit"></i>
                                                </a>                                            
                                                <span class="separador">/</span>
                                                <a href="#" data-toggle="modal" data-target="#borrar" onclick="borrar('{{$dato->id}}')">                                            
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
                    <h5 class="modal-title" id="exampleModalLabel">Crear {{$modulo['singular']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('crear_'.$modulo['nombre']) }}" methods="POST">                    
                        <div class="form-group">
                            <label for="nombre_{{$modulo['nombre']}}">Nombre {{$modulo['singular']}}</label>
                            <input required type="text" class="form-control" name="nombre" id="name" aria-describedby="nombre" placeholder="Nombre {{$modulo['singular']}}" onkeypress="return check(event)">
                        </div>                                                                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Crear {{$modulo['singular']}}</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar {{$modulo['singular']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('editar_'.$modulo['nombre']) }}" methods="POST">

                        <input type="text" class="form-control" name="id" id="id" style="display: none">

                        <div class="form-group">
                            <label for="nombre_ruta">Nombre {{$modulo['singular']}}</label>
                            <input required type="text" class="form-control" name="nombre" id="nombre_data" aria-describedby="nombre_ruta" placeholder="Nombre {{$modulo['singular']}}" onkeypress="return check(event)">
                        </div>                                                                        
                        <div class="form-group">
                            <label for="estado_ruta">Estado</label>
                            <select name="estado_ruta" id="estado" class="form-control">
                                <option value="" id="estado1"></option>
                                <option value="" id="estado2"></option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Editar {{$modulo['singular']}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Cambiar Estado-->
    <form action="{{route('cambiar_estado_'.$modulo['nombre'])}}" methods="POST" style="display: none">
        <input type="number" class="form-control" name="id" id="id_cambiar_estado_{{$modulo['nombre']}}"> 
        <div class="form-group">
            <label for="cambiar_estado">Estado</label>
            <input required type="text" class="form-control" name="cambiar_estado" id="cambiar_estado_{{$modulo['nombre']}}">                       
        </div>               
        <button type="submit" class="btn btn-primary" id="cambiarEstado">Cambiar Estado {{$modulo['singular']}}</button>                        
    </form>

    <!-- Modal Delete -->
    <div class="modal fade" id="borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar {{$modulo['singular']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('borrar_'.$modulo['nombre'])}}" methods="POST">
                        <input type="number" class="form-control" name="id" id="borrar_{{$modulo['nombre']}}" style="display: none">
                        Estas seguro de eliminar esta {{$modulo['singular']}}?.   
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Borrar {{$modulo['singular']}}</button>
                        </div>                 
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

