@extends('template')

<style type="text/css">
    .guide-item{
        margin-bottom: 25px;
    }

</style>


@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Parada - {{$parada->nombre}}</h1>
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
                            <h5>Horarios de Parada</h5>
                            
                         <!--    <div style="text-align: right;">
                                <a class="btn btn-primary mb-3" href="#">
                                    Agregar posición
                                </a>
                            </div>
 -->
                        </div>

                        <div class="card mb-2">
                            <table id="datatable1" class="table display responsive nowrap data-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Horario</th>

                                        <th>Datos asignados</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($horarios as $horario)
                                        <tr>
                                            <td>
                                                @if(!empty($horario->parada))

                                                    <a href="{{url('/admin/paradas')}}/{{$parada->id}}/horario/{{$horario->id}}/info/{{$horario->parada->id}}">
                                                        <i class="menu-item-icon icon ion-eye tx-22"></i>
                                                    </a>

                                                @endif
                                            </td>

                                            <td>
                                                {{$horario->hora}} {{$horario->periodo}} 
                                                (
                                                    @if($horario->activo == 1)
                                                        Horario Activo
                                                    @else
                                                        Horario Inactivo
                                                    @endif
                                                )
                                            </td> 


                                            <td>
                                                @if(!empty($horario->parada))
                                                    <i class="menu-item-icon icon ion-ios-checkmark tx-22" style="color: blue;"></i>
                                                @else
                                                    <i class="menu-item-icon icon ion-ios-close tx-22" style="color: red;"></i>
                                                @endif
                                                             
                                            </td>


                                            <td>
                                                @if(empty($horario->parada))
                                                    <a href="{{url('/admin/paradas')}}/{{$parada->id}}/horario/{{$horario->id}}/crear">Asignar</a>
                                                @else

                                                    <a href="{{url('/admin/paradas')}}/{{$parada->id}}/horario/{{$horario->id}}/info/{{$horario->parada->id}}/editar">Editar</a>


                                                    <form id="delete-form" action="{{url('/admin/paradas')}}/{{$parada->id}}/horario/{{$horario->id}}/info/borrar" method="post" class="form-delete">
                                                        {{ csrf_field() }}

                                                        <input type="hidden" value="{{$horario->parada->id}}" name="id">
                                                        <button class="table-btn btn-delete" style="color: red;" type="button"  data-toggle="modal" data-target="#modal-confirm-delete">Borrar</button>
                                                    </form>  

                                                @endif

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
