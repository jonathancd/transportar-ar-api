@extends('template')

@section('page_name')
    <span class="breadcrumb-item active">Editar horario</span>
@endsection


<style type="text/css">
    .form-content{
        width: 100%;
    }
</style>



@section('content')
    
    @if (session('status'))
        <div style="margin-top: 10px;">
            <div class="alert alert-dark" style="width: 100%;">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                {{ session('status') }}
            </div>
        </div>
    @endif
    

    <div>
        <div class="row">        

          <form action="{{url('/admin/horarios')}}/{{$horario->id}}" method="post" class="form-content fadeIn animated">
            {{ csrf_field() }}
            
            <div class="bg-gray-200">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="text" name="hora" class="form-control"  placeholder="Ejemplo: 9:45 AM" value="{{ old('hora', $horario->hora) }}" >

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('hora') }}</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>-</label>
                                    <select name="periodo" class="form-control">
                                        @if($horario->periodo=="AM")
                                            <option value="AM" selected>AM</option>
                                        @else
                                            <option value="AM">AM</option>
                                        @endif

                                        @if($horario->periodo=="PM")
                                            <option value="PM" selected>PM</option>
                                        @else
                                            <option value="PM">PM</option>
                                        @endif
                                    </select>

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('periodo') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Horario activo</label>
                                    <select name="activo" class="form-control">
                                        @if($horario->activo==1)
                                            <option value="1" selected>Si</option>
                                        @else
                                            <option value="1">Si</option>
                                        @endif

                                        @if($horario->activo==0)
                                            <option value="0" selected>No</option>
                                        @else
                                            <option value="0">No</option>
                                        @endif

                                    </select>

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('activo') }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <button id="btn-continue-auth" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>

        </div>    
    </div>

@endsection