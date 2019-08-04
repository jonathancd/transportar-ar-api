@extends('template')

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

          <form action="{{url('/admin/horarios')}}" method="post" class="form-content fadeIn animated">
            {{ csrf_field() }}
            
            <div class="bg-gray-200">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="text" name="hora" class="form-control"  placeholder="Ejemplo: 9:45 AM" value="{{ old('hora') }}" >

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('hora') }}</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                	<label>-</label>
                                    <select name="periodo" class="form-control">
                                    	<option value="AM" selected>AM</option>
                                    	<option value="PM">PM</option>
                                    </select>

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('periodo') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                	<label>Horario activo</label>
                                    <select name="activo" class="form-control">
                                    	<option value="1" selected>Si</option>
                                    	<option value="0">No</option>
                                    </select>

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('activo') }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                <button id="btn-continue-auth" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>

        </div>    
    </div>

@endsection
