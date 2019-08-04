<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

 
        <title>Transport-AR - Administrador</title>

        <!-- vendor css -->
        <link href="{{ url('templates') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="{{ url('templates') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
        <link href="{{ url('templates') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <link href="{{ url('templates') }}/lib/rickshaw/rickshaw.min.css" rel="stylesheet">

        <link href="{{url('/templates')}}/lib/datatables/jquery.dataTables.css" rel="stylesheet">

        <!-- Starlight CSS -->
        <link rel="stylesheet" href="{{ url('templates') }}/css/starlight.css">
        <link rel="stylesheet" href="{{ url('templates') }}/css/style.css">



        <link rel="stylesheet" href="{{ url('assets') }}/highlight/styles/atelier-heath-dark.css">
        
        <style type="text/css">
          body{
            background: #fff!important;
          }
          td{
            /*line-height: 36px;*/
          }
          .btn-activate{
            /*line-height: 36px;*/
          }
          .form-delete, .form-activate{
            margin-bottom: 0px;
          }
        </style>

    </head>
    <body url="http://localhost:8000">
        
      @if(Auth::user())
    <!-- ########## START: LEFT PANEL ########## -->
        <div class="sl-logo">
            <a href="#">
              <!-- <i class="icon ion-pizza"></i> -->
              <img src="{{url('/images/bus.png')}}">
              Transport-AR
            </a>
        </div>

        <div class="sl-sideleft">

          <label class="sidebar-label">Navegar</label>
          
          <div class="sl-sideleft-menu">
            <a href="{{url('/admin')}}" class="sl-menu-link active">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Inicio</span>
              </div><!-- menu-item -->
            </a><!-- sl-menu-link -->

            <a href="{{url('/admin/horarios')}}" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-clock tx-22"></i>
                <span class="menu-item-label">Horarios</span>
              </div><!-- menu-item -->
            </a><!-- sl-menu-link -->

            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-map tx-22"></i>
                <span class="menu-item-label">Sectores</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div>
            </a>
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{url('/admin/sectores')}}" class="nav-link">Ver todos</a></li>
              @foreach(App\Sector::orderBy('nombre')->get() as $sector)
                <li class="nav-item"><a href="{{url('/admin/sectores')}}/{{$sector->id}}" class="nav-link">{{$sector->nombre}}</a></li>
              @endforeach
            </ul>
           

          </div><!-- sl-sideleft-menu -->
          <br>
        </div><!-- sl-sideleft -->
        <!-- ########## END: LEFT PANEL ########## -->


        <!-- ########## START: HEAD PANEL ########## -->
        <div class="sl-header">
          <div class="sl-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
          </div><!-- sl-header-left -->
          <div class="sl-header-right">
            <nav class="nav">
              <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                  <span class="logged-name"><span class="hidden-md-down"> {{Auth::user()->nombre}}</span></span>
                  <i class="icon ion-person"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                  <ul class="list-unstyled user-profile-nav">
                    <!-- <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li> -->
                    <!-- <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li> -->
                    <li><a href="{{url('/logout')}}"><i class="icon ion-power"></i> Salir</a></li>
                  </ul>
                </div><!-- dropdown-menu -->
              </div><!-- dropdown -->
            </nav>

          </div><!-- sl-header-right -->
        </div><!-- sl-header -->
        <!-- ########## END: HEAD PANEL ########## -->


        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
          <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('/panel')}}">Inicio</a>
            @yield('page_name')
          </nav>

          <div class="sl-pagebody">

            @yield('content')


            <div class="modal fade" id="modal-confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          Confirmar acción
                      </div>
                      <div class="modal-body">
                          <p>¿Seguro de realizar esta acción?</p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                          <button id="btn-confirm-delete" class="btn btn-success success" Onclick="confirmDelete();">Aceptar</button>
                      </div>
                  </div>
              </div>
            </div>


          </div><!-- sl-pagebody -->
          
          <footer class="sl-footer">
            <div class="footer-left" style="margin: 0 auto;">
              <div class="mg-b-2">Copyright &copy; 2018. <a href="#"> <strong>Trabajo de Grado, UNEG</strong></a>. Derechos reservados.</div>
            </div>

          </footer>
        </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
      @endif

        <script src="{{ url('templates') }}/lib/jquery/jquery.js"></script>
        <script src="{{ url('templates') }}/lib/popper.js/popper.js"></script>
        <script src="{{ url('templates') }}/lib/bootstrap/bootstrap.js"></script>
        <script src="{{ url('templates') }}/lib/jquery-ui/jquery-ui.js"></script>
        <script src="{{ url('templates') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
        <script src="{{ url('templates') }}/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
        <script src="{{ url('templates') }}/lib/d3/d3.js"></script>
        <script src="{{ url('templates') }}/lib/rickshaw/rickshaw.min.js"></script>
        <script src="{{ url('templates') }}/lib/chart.js/Chart.js"></script>
        <script src="{{ url('templates') }}/lib/Flot/jquery.flot.js"></script>
        <script src="{{ url('templates') }}/lib/Flot/jquery.flot.pie.js"></script>
        <script src="{{ url('templates') }}/lib/Flot/jquery.flot.resize.js"></script>
        <script src="{{ url('templates') }}/lib/flot-spline/jquery.flot.spline.js"></script>

        <script src="{{url('/templates')}}/lib/datatables/jquery.dataTables.js"></script>
        <script src="{{url('/templates')}}/lib/datatables-responsive/dataTables.responsive.js"></script>


        <script src="{{ url('templates') }}/js/starlight.js"></script>
        <script src="{{ url('templates') }}/js/ResizeSensor.js"></script>
        <script src="{{ url('templates') }}/js/dashboard.js"></script>


        <script src="{{ url('assets') }}/highlight/highlight.pack.js"></script>
       <!--  <script src="{{ url('assets') }}/BootstrapFormHelpers/dist/js/bootstrap-formhelpers.min.js"></script>

        <script src="{{ url('assets') }}/BootstrapFormHelpers/js/bootstrap-formhelpers-languages.js"></script>

        <script src="{{ url('assets') }}/BootstrapFormHelpers/js/bootstrap-formhelpers-countries.js"></script>

        <script src="{{ url('assets') }}/BootstrapFormHelpers/js/lang/en_US/bootstrap-formhelpers-languages.en_US.js"></script>
 -->
        @yield('scripts')
        <script type="text/javascript">
          var table = $('.data-table').dataTable( {
                        "ordering": false,
                        "paging": true,
                        "language": {
                            "lengthMenu": "Mostrar _MENU_ registros por pagina",
                            "zeroRecords": "Sin registros",
                            "info": "Mostrando pagina _PAGE_ de _PAGES_",
                            "infoEmpty": "Sin registros disponibles",
                            "infoFiltered": "(Filtrar desde _MAX_ registro totales)",
                            "search": "Buscar",
                            "paginate": {
                              "next": "Siguiente",
                              "sPrevious": "Anterior"
                            }
                        }
                      } );

          table.columns.adjust().draw();

          // function ConfirmDelete()
          // {
          //   var x = confirm("Seguro que quieres eliminar este registro?");
          //   if (x)
          //     return true;
          //   else
          //     return false;
          // }


          function confirmDelete(){

            $('.form-delete').submit();
          }
        </script>
    </body>
</html>
