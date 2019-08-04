@extends('template')

<style type="text/css">
    .guide-item{
        margin-bottom: 25px;
    }

</style>


@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Sector - {{$sector->nombre}}</h1>
        </div>

        @if (session('status'))
            <div style="margin-top: 10px;">
                <div class="alert alert-dark" style="width: 100%;">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    {{ session('status') }}
                </div>
            </div>
        @endif


        <div style="margin-top:25px;">
            <div class="row">        
                <div style="width: 100%;">
                    <div class="col-md-12">
                        <div class="sl-page-title" style="margin-bottom: 0px!important;">
                            <h5>Rutas</h5>
                            <div style="text-align: right;">
                                <a class="btn btn-primary mb-3" href="{{url('/admin/sectores')}}/{{$sector->id}}/rutas/crear">
                                    Agregar Ruta
                                </a>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <table id="datatable1" class="table display responsive nowrap data-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            Activo
                                        </th>
                                        <th>
                                            Nombre
                                        </th>

                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sector->rutas as $ruta)
                                        <tr>
                                            <td>
                                                <a href="{{url('/admin/sectores')}}/{{$sector->id}}/rutas/{{$ruta->id}}">
                                                    <i class="menu-item-icon icon ion-eye tx-22"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($ruta->activo == 1)
                                                    Activa
                                                @else
                                                    Inactiva
                                                @endif
                                            </td>
                                            <td>
                                                {{$ruta->nombre}}
                                            </td>

                                            <td>
                                                                     
                                                <form action="{{url('/admin/sectores')}}/{{$sector->id}}/rutas/{{$ruta->id}}/activar" method="post" class="form-activate">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" value="{{$ruta->id}}" name="id">
                                                    <button class="table-btn btn-activate" style="color: blue;" type="submit">
                                                        @if($ruta->activo == 0)
                                                            Activar
                                                        @else
                                                            Desactivar
                                                        @endif
                                                    </button>
                                                </form>
                                                
                                            </td>
                                            <td>
                                                <a href="{{url('/admin/sectores/')}}/{{$sector->id}}/rutas/{{
                                                $ruta->id}}/editar">Editar</a>
                                            </td>
                                            <td>
                                                <form id="delete-form" action="{{url('/admin/sectores')}}/{{$sector->id}}/rutas/borrar" method="post" class="form-delete">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" value="{{$ruta->id}}" name="id">
                                                    <button class="table-btn btn-delete" style="color: red;" type="button"  data-toggle="modal" data-target="#modal-confirm-delete">Borrar</button>
                                                </form>    
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

@endsection
