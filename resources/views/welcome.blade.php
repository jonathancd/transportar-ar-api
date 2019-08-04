@extends('template')

<style type="text/css">
    .guide-item{
        margin-bottom: 25px;
    }

</style>


@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Panel administrativo de Transport-AR</h1>
            <p>Administre los horario, sectores, rutas y paradas del servicio de transporte de la Universidad Nacional Experimental de Guayana, para que estén disponibles en la Aplicación de Realidad Aumentada. </p>
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
                            <a href="{{url('/admin/horarios')}}"><h5>Horarios</h5></a>
                            <div style="text-align: right;">
                                <a class="btn btn-primary mb-3" href="{{url('/admin/horarios/crear')}}">
                                    Agregar Horario
                                </a>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <table id="datatable1" class="table display responsive nowrap data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            Activo
                                        </th>
                                        <th>
                                            Hora
                                        </th>
                                        <th>
                                            
                                        </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(App\Horario::orderBy('hora')->get() as $horario)
                                        <tr>
                                            <td>
                                                @if($horario->activo == 1)
                                                    Activo
                                                @else
                                                    Inactivo
                                                @endif
                                            </td>
                                            <td>
                                                {{$horario->hora}}
                                            </td>
                                            <td>
                                                {{$horario->periodo}}
                                            </td>
                                            <td>
                                                <form action="{{url('/admin/horarios/activar')}}" method="post" class="form-activate">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" value="{{$horario->id}}" name="id">
                                                    <button class="table-btn btn-activate" style="color: blue;" type="submit">
                                                        @if($horario->activo == 0)
                                                            Activar
                                                        @else
                                                            Desactivar
                                                        @endif
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{url('/admin/horarios')}}/{{
                                                $horario->id}}/editar">Editar</a>
                                            </td>
                                            <td>
                                                <form action="{{url('/admin/horarios/borrar')}}" method="post" class="form-delete">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" value="{{$horario->id}}" name="id">
                                                    <button class="table-btn btn-delete" Onclick="return ConfirmDelete();" style="color: red;" type="submit">Eliminar</button>
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


        <div style="margin-top:25px;">
            <div class="row">        
                <div style="width: 100%;">
                    <div class="col-md-12">
                        <div class="sl-page-title" style="margin-bottom: 0px!important;">
                            <a href="{{url('/admin/sectores')}}"><h5>Sectores</h5></a>
                            <div style="text-align: right;">
                                <a class="btn btn-primary mb-3" href="{{url('/admin/sectores/crear')}}">
                                    Agregar Sector
                                </a>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <table id="datatable1" class="table table-striped table-bordered display responsive nowrap data-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            Nombre
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(App\Sector::orderBy('nombre')->get() as $sector)
                                        <tr>
                                            <td>
                                                <a href="{{url('/admin/sectores')}}/{{$sector->id}}">
                                                    <i class="menu-item-icon icon ion-eye tx-22"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{url('/admin/sectores')}}/{{$sector->id}}">{{$sector->nombre}}</a>
                                            </td>

                                            <td>
                                                <a href="{{url('/admin/sectores')}}/{{
                                                $sector->id}}/editar">Editar</a>
                                            </td>

                                            <td>   
                                                <form action="{{url('/admin/sectores/borrar')}}" method="post" class="form-delete">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" value="{{$sector->id}}" name="id">
                                                    <button class="table-btn btn-delete" Onclick="return ConfirmDelete();" style="color: red;" type="submit">Eliminar</button>
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




    </div>
@endsection
