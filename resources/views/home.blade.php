@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('welcomeYhome.subtitulo')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div id="mensajeStatus" class="alert alert-success">  
                            <span class="boton" onclick="cerraranuncio('mensajeStatus')">x</span>
                            {{ session('status') }}
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
