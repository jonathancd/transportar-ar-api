@extends('template')

@section('page_name')
    <span class="breadcrumb-item active">Editar sector</span>
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

          <form action="{{url('/admin/sectores')}}/{{$sector->id}}" method="post" class="form-content fadeIn animated">
            {{ csrf_field() }}
            
            <div class="bg-gray-200">
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $sector->nombre) }}" >

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('nombre') }}</span>
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