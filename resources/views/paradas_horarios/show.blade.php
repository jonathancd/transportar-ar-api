@extends('template')

<style type="text/css">
    .form-content{
        width: 100%;
    }


    .order-info{
        padding: 5px 25px;
        text-align: justify;
    }

    .parada-drag{
        border:1px solid gray; 
        font-weight: 600;
        padding: 10px!important;
        text-align: center;
    }
    
    .parada-drag:hover{
        /*cursor: pointer;*/
    }

    .parada-list{
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.15);
        /*min-height: 43px;*/
    }
    .parada-list-title{
        border: 2px solid #5B93D3; 
        font-weight: 600;
        
        text-align: center;
    }
    .parada-list-title h2{
        margin-bottom: 0px;
        padding: 10px 0px!important;
    }


    .parada-new{
        background-color: #5B93D3;
        border-color: #5B93D3;
        color: #fff;
    }
</style>


@section('content') 

    <div>
        <div class="row jumbotron">
            
            <div class="col-md-12">
                <h2>Parada: <span id="parada-nombre">{{$parada->nombre}}</span></h2>
            </div>
            
            @if(!empty($ruta)) 
            <div class="col-md-12">
                <h3>Ruta: {{$ruta->nombre}}</h3> 
            </div>
            @endif
            
            <div class="col-md-12">
                <h3>Horario: {{$horario->hora}} {{$horario->periodo}}</h3>
            </div>
        </div>

        @if (session('status'))
            <div style="margin-top: 10px;">
                <div class="alert alert-dark" style="width: 100%;">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    {{ session('status') }}
                </div>
            </div>
        @endif


        <div class="row">        

            <div class="bg-gray-200">
                <div class="card-body">
                    <div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                
                                    <label>Horario</label>
                                    
                                    <input type="text" class="form-control" value="{{$horario->hora}} {{$horario->periodo}}" readOnly>
                                    <input type="hidden" name="horario" value="{{$horario->id}}">

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Referencia</label>
                                    <input type="text" name="referencia" class="form-control" value="{{ old('referencia') }}" >

                                    <span class="text-danger" style="font-size: 13px;">{{ $errors->first('referencia') }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                                    <label>Orden</label>
                                    
                                    <p class="order-info">
                                        <span>  
                                            Indique la posición que tendrá la parada dentro del recorrido para este horario, utilizando la técnica de <strong>Arrastrar y soltar</strong> que consiste en seleccionar el elemento de color azul con el nombre <strong>{{$parada->nombre}} (Parada actual)</strong>, arrastrarlo y soltarlo en el lugar que deseé, en este caso seria dentro de la lista presentada debajo de elemento señalado como "Orden de Paradas".
                                        </span>

                                        <br>

                                        <span><strong>Nota: </strong> Puede actualizar el orden del resto de las paradas utilizando la misma técnica.</span>
                                    </p>

                                </div>

                                <br>
                            </div>


                            <div class="col-md-12" >
                                
                                <div class="parada-list droppable" ondrop="drop(event)" ondragover="allowDrop(event)">

                                    <div id="parada-list-h2" class="parada-list-title" ondragstart="drag(event)">
                                        <h2 style="color: #5B93D3;" ondragstart="drag(event)">Orden de paradas</h2>
                                    </div>

                                    @foreach($ruta->paradas as $parada_temp)

                                        @if($parada_horario->id_parada == $parada_temp->id)
                                            
                                            <div id="parada-horario-{{$parada_temp->id}}" class="parada-drag parada-new">
                                                
                                                {{$parada_temp->nombre}} - {{$parada_horario->id_parada}}
                                                
                                                <input type="hidden" name="parada" value="{{$parada->id}}">

                                                <input type="hidden" name="ruta" value="{{$ruta->id}}">

                                            </div>

                                        @else

                                            <div class="parada-drag">
                                                
                                                {{$parada_temp->nombre}}

                                            </div>

                                        @endif
                                        
                                    @endforeach

                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div style="min-height:300px;">
                                    <p style="margin-bottom: 0px!important;">Mapa</p>

                                    <div id="map" style="min-height:250px;"> </div> 
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

@endsection



@section('scripts')


    <script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    
    <script>

        var url = $('body').attr('url');

        var parada_horario = $("input[name='parada_horario']").val();
        var horario = $("input[name='horario']").val();
        var ruta = $("input[name='ruta']").val();

        var guayanaLatLng = new google.maps.LatLng("8.278553", "-62.755202");
        var markers = [];
        var parada_actual = [];


        $.get(url+"/ruta/"+ruta+"/horario/"+horario, 
            function(data) {


            console.log(data);

            for(var i=0; i<data.paradas.length; i++){
                
                var paradaLatLng = new google.maps.LatLng(data.paradas[i].latitud, data.paradas[i].longitud);

                if(data.paradas[i].id_parada_horario == parada_horario){
                    putMarker(paradaLatLng, 1, data.paradas[i].nombre);
                }else{
                    putMarker(paradaLatLng, 2, data.paradas[i].nombre);
                }
                
            }

        });


        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: guayanaLatLng.lat(), lng: guayanaLatLng.lng()},
            zoom: 10
        });


        function putMarker(location, color, nombre) {

            var icon = getIcon(color);

            var marker = new google.maps.Marker({
                position: location, 
                map: map,
                icon: icon,
                title: 'Okis'
            });

            switch(color){
                case 1:
                    parada_actual.push(marker);
                    break;
                case 2:
                    markers.push(marker);
                    break;
            }
            

            markerPopup(marker, nombre);
        }


        function markerPopup(marker, nombre){

            var parada_info = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h1 id="firstHeading" class="firstHeading">'+nombre+'</h1>'+
                    '</div>';

            marker.infowindow = new google.maps.InfoWindow({
                content: parada_info
            });

            marker.addListener('click', function() {
                marker.infowindow.open(map, marker);
            });
        }



        function getIcon(color){
            switch(color){
                case 1:
                    return 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                    break;
                case 2:
                    return 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
                    break;
            }
        }

    </script>

@endsection