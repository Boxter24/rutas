@extends('layouts.master')

@section('content')
<div class="content-wrapper">            
    <!--MAIN CONTENT-->
    <div class="content">
        <div class="container-fluid">
            <div class="col-12 cuerpo-col-card">
                <label for="mensaje">Con funcion:</label>
                <textarea oninput="reverse()" type="text" name="mensaje" id="mensaje" placeholder="Invertir" spellcheck="false" autocomplete="off" maxlength="255" style="width: 100%;"></textarea>
            </div>     
            <span id="estructura1" style="color: #0a49a3; margin-top: 2em; display: flex; justify-content: center;"></span>

            <div class="col-12 cuerpo-col-card">
                <label for="mensaje">Con Ciclo:</label>
                <textarea oninput="reverse2()" type="text" name="mensaje2" id="mensaje2" placeholder="Invertir" spellcheck="false" autocomplete="off" maxlength="255" style="width: 100%;"></textarea>
            </div>     
            <span id="estructura2" style="color: red; margin-top: 2em; display: flex; justify-content: center;"></span>
        </div>
    </div>
</div>
@endsection