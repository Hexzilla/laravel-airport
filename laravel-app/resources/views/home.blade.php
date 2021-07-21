<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <!-- LIBRARY CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" integrity="sha256-rDWX6XrmRttWyVBePhmrpHnnZ1EPmM6WQRQl6h0h7J8=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.2.0/MarkerCluster.css" integrity="sha256-+bdWuWOXMFkX0v9Cvr3OWClPiYefDQz9GGZP/7xZxdc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.2.0/MarkerCluster.Default.css" integrity="sha256-LWhzWaQGZRsWFrrJxg+6Zn8TT84k0/trtiHBc6qcGpY=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css" integrity="sha256-LcmP8hlMTofQrGU6W2q3tUnDnDZ1QVraxfMkP060ekM=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.4.3/css/scroller.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.0.23/style/jquery.jscrollpane.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.16/integration/font-awesome/dataTables.fontAwesome.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <!--CUSTOM CSS-->
    <link href="{{asset('css/jquery.jscrollpane.lozenge.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style-front.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/circle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/animate.css')}}" rel="stylesheet" type="text/css" />

    <!-- LIBRARY JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js" integrity="sha256-kdEnCVOWosn3TNsGslxB8ffuKdrZoGQdIdPwh7W1CsE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.2.0/leaflet.markercluster.js" integrity="sha256-F2IexcTxWZ5YrNfc+MhXBE3n61CnB2JHKhdkZKua5KE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.2/highcharts.js" integrity="sha256-/VEowm8tPbokrIUlmW68jf1pHTKBlKkA8iHh/okHcUo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.2/js/modules/exporting.js" integrity="sha256-yFkxN0KTA++7S27Tnf/lf0aVsYWbAsJ4VOjB9J23oRU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.2/js/modules/offline-exporting.js" integrity="sha256-H5WWJ+ZH8o3PU2o82IlfytCeEbacsiYG0QGr9SlTBco=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha256-eZNgBgutLI47rKzpfUji/dD9t6LRs2gI3YqXKdoDOmo=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/733beb794c.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.0.23/script/jquery.jscrollpane.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.2.4/jspdf.plugin.autotable.min.js"></script>

    <!--SWEET ALERT-->
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">

    <!--CUSTOM JS -->
    <script src="{{asset('js/script-front.js')}}"></script>
    <script src="{{asset('js/html2canvas.js')}}"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>
<body id="bodyMap" data-layout="cons">
    <!-- LOADING -->
    @include("layouts.loading_modal")

    <!-- HEADER -->
    @include("layouts.header")
    <!-- END HEADER -->

    <!-- PROJECT LIST DIV -->
    @include("layouts.home.project-list-cons")

    <div id='mapContainer' class="home-container nomargin-side" style="z-index:0">
        <div id="mapFilters" class="filters nomargin-side cons hiddenFilters">
            <i class="fas fa-chevron-right"></i>
            <img src="/images/filters.png" class="showFilters" onclick="ShowFilters();"/>

            <!-- PHASES FILTER -->
            <div class="phase-filter">
            @foreach ($phases_list as $phase)
                <!-- FILTER -->
                    <div class="row filter">
                        <div class='switch-filter colorFilter_{{ str_replace("#","",$phase->hex_color) }} toggle-container active'>
                            <div></div>
                        </div>
                        <div class="phase-color" style="background:{{ $phase->hex_color }}"></div>
                        <div class="phase-text">{{ $phase->name }}</div>
                    </div>
                    <!-- END FILTER -->
                @endforeach
            </div>

            <!-- PROJECT STATUS -->
            @if(Session::get('layout') != 'cons')
                <div class="project-status-filter">
                    @foreach ($proj_status_info as $statusInfo)
                        <div class="row filter">
                            <div class="switch-filter projStatusInfo_{{ $statusInfo->id }} toggle-container active">
                                <div></div>
                            </div>
                            <div class="phase-text">{{ $statusInfo->name }}</div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- AIRPORT SIZE -->
            <div class="airport-size-filter">
            @foreach ($airport_size_list as $airport_size)
                <!-- FILTER -->
                    <div class="row filter">
                        <div class="switch-filter airportSize_{{ $airport_size['min'] }}_{{ $airport_size['max'] }} toggle-container active">
                            <div></div>
                        </div>
                        <div class="phase-text">{{ $airport_size["name"] }}</div>
                    </div>
                    <!-- END FILTER -->
                @endforeach
            </div>

            <!-- PROJECT TYPES -->
            <div class="project-model-filter">
            @foreach ($proj_model_list as $proj_model)
                <!-- FILTER -->
                    <div class="row filter">
                        <div class="switch-filter projModelFilter_{{ $proj_model->id }} toggle-container active">
                            <div></div>
                        </div>
                        <img src="{{ $proj_model->image }}" class="img-circle round-project-type">
                        <div class="phase-text">{{ $proj_model->name }}</div>
                    </div>
                    <!-- END FILTER -->
                @endforeach
            </div>
        </div>
        <!-- PROJECT FOOTER -->
        @include("layouts.home.project-footer-carousel")
        @include("layouts.home.project-footer-carousel-mobile")
    </div>

    <!-- RELOJ -->
    <div id="timestamp" class="fadeIn animated">
        <div id="HORA"></div>
        <div id="DOHAGMT"></div>
    </div>
    <!-- END RELOJ -->

    <div class="middle-button right open-projects-modal fadeIn animated hide"></div>

    <!-- MODALS ############################################################################################ -->

    @include("layouts.home.project-phase-map")

    @include("layouts.home.project-data-modal-cons")
    @include("layouts.home.project-financial-modal-cons")

    @include("layouts.home.actual-phase-modal")
    @include("layouts.home.project-team-modal")

    @include("layouts.home.project-country-modal")
    @include("layouts.home.project-oportunity-modal")
    @include("layouts.home.project-airport-modal")

    <!-- END MODALS ############################################################################################ -->

    <div id="currentProject" class="sideRightHiddingPanel animated" style="display:none">
        <div class="btnSidePress" onclick="showHideSideItem(this);">
            <i class="fas fa-chevron-left"></i>
            <img class="project_info label" src="/images/project_info.png"/>
        </div>
        <img class="project_thumb" src="/images/icons/default_project_img.png"/>
        <span class="current_project_name ellipsis-3lines">Current project name </span>
        <span class="current_project_download"><i class="fas fa-file-download"></i>Descargar</span>
    </div>

    <div id="latestNews" class="sideRightHiddingPanel animated">
        <div class="btnSidePress" onclick="showHideSideItem(this);">
            <i class="fas fa-chevron-left"></i>
            <img class="news label" src="/images/news.png"/>
        </div>
        <div class="news-container" style="">
            <div class="news-header">
                <span class="news-header-label">Resumen Semanal</span>
                <div class="week-component">
                    <i class="fas fa-chevron-left" onclick="previousWeek()"></i>
                    <span class="news-week">Semana del <span class="news-week-period"></span></span>
                    <i class="fas fa-chevron-right" onclick="nextWeek()"></i>
                </div>
            </div>
            <div class="news-section-container sideScroll">

            </div>
        </div>
    </div>

<script>
    var currentProjectInfo;
    var markersEuropaOriginal=<?php echo $project_map_marks ?>;
    var dataProjectListOriginal=<?php echo $project_list ?>;
    var currency = '<?php echo $currency ?>';
    var markersEuropa = markersEuropaOriginal;
    var map;
    var tableProjects;
    var loadedProject = false;
    var currentNewsDate = null;
    var multiAirportData = [];
    var multiAirportIndex = 0;

    var currentProjectId = <?php echo (isset($selected_project)?$selected_project:'null') ?>;
    var openDecisionMap = <?php echo (isset($decision_map)?$decision_map:false) ?>;
    console.log(currentProjectInfo, openDecisionMap);
    $(document).ready(function() {
        loadingShow();
        initializeMap();
        $( "#mapContainer div.leaflet-pane.leaflet-tile-pane" ).append( "<div id=\"background\"></div>" );
        initializeProjectList();
        loadMarkers();
        initialNewsLoad();

        if (currentProjectId != null){
            loadProjectInfo(currentProjectId, openDecisionMap);
        }
    });

    $('#buttonLogout').on('click', function(){
        Swal.fire({
            title: 'Do you want to logout ?',
            type:'info',
            showCancelButton:true,
            allowOutsideClick:true,
            confirmButtonColor: '#00438d',
            confirmButtonText: 'Logout',
            cancelButtonText: 'Cancel',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $('#logout-form').submit();
            }
        })
    });

    function initializeMap(){
        if (map!=null){
            map.remove();
        }
        //Definimos el footer del mapa
        var mbAttr = 'SOM',
            //styles: dark_all or dark_nolabels
            mbUrl = 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
        //Definimos el tema del mapa
        var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox.light', attribution: mbAttr});
        //Aplicamos posición, zoom, tema y ciudades
        map = L.map('mapContainer', {
            center: [29.434504, 11.928594],
            zoom: 3,
            layers: [grayscale],
            minZoom: 2.5,
            zoomSnap: 0.25
        });
    }

    function initializeProjectList(){

        tableProjects = $('#projects_datatable').DataTable( {
            data:           dataProjectListOriginal,
            deferRender:    true,
            scrollY:        600,
            scrollCollapse: true,
            scroller:       true,
            paging:         false,
            searching:      false,
            info:           false,
            order: [[ 1, "asc" ]],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend:'excelHtml5',
                    text: 'Export as Excel',
                    title: 'aena gpi - Project List',
                    //messageTop: 'Project List',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ,10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24 ]
                    }
                },
                {
                    extend:'pdfHtml5',
                    text: 'Export as PDF',
                    title: 'aena gpi - Project List',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    //messageTop: 'Project List',
                    exportOptions: {
                        columns: [ 1, 2, 3, 4, 5, 6, 7, 8 ]
                    }
                }
            ],
            columnDefs: [
                {
                    "targets"  : 'no-sort',
                    "orderable": false,
                }
            ],
            "fnInitComplete": function() {
                var table_header = $('.dataTables_scrollHeadInner').css('position', 'relative');
                $('.dataTables_scrollBody').bind('jsp-scroll-x', function(event, scrollPositionX, isAtLeft, isAtRight) {
                    table_header.css('right', scrollPositionX);
                })
            }
        }).columns([9 ,10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]).visible(false);
    }

    var markerClusters;

    function loadMarkers(){
        //initializeMap();
        if(markerClusters!=null){
            map.removeLayer(markerClusters);
        }

        var markersAsia = [];
        markerClusters = L.markerClusterGroup({
            maxClusterRadius: 50,
            removeOutsideVisibleBounds: false,
            zoomToBoundsOnClick: true,
            showCoverageOnHover: true
        });

        map.addLayer(markerClusters);
        markerClusters = getMarkerGroup(markersEuropa, markerClusters);
        map.addLayer(markerClusters);


        markerClusters.on("click", function (event) {
            var clickedMarker = event.layer;
            unloadProject();
        });
    }
    function parseQty(qty){
        if (qty==null){
            return "";
        }
        var resultparsed="";
        var amount="";
        var currency="";
        var amountChar="0123456789.,";
        var charRemove=" %";
        for (var i = 0, len = qty.length; i < len; i++) {
            if (amountChar.indexOf(qty.charAt(i))>-1){ //ES NUMERO
                if (currency!=""){
                    resultparsed+="<span class=\"million-currency\">"+currency+"</span>";
                    currency="";
                }
                amount += qty.charAt(i);
            }else{
                if (amount!=""){
                    resultparsed+="<span class=\"amount\">"+amount+"</span>";
                    amount="";
                }
                currency += qty.charAt(i);
            }
        }
        if (amount!=""){
            resultparsed+="<span class=\"amount\">"+amount+"</span>";
        }
        if (currency!=""){
            resultparsed+="<span class=\"million-currency\">"+currency+"</span>";
        }
        return resultparsed;
    }

    function getMarkerGroup(markers, markerClusters){
        for ( var i = 0; i < markers.length; ++i ){
            var myIcon = L.divIcon(
                {className: 'marker-construction2',
                    html: '<div class="marker-icon color'+markers[i].project_status_color.replace('#', '')+' type'+markers[i].project_type +' closed'+markers[i].is_closed+' awarded'+markers[i].som_projects_is_awarded+' dismissed'+markers[i].som_projects_is_dismissed+ '" style="background:'+markers[i].project_status_color+'"></div><div class="circle-white"></div><div class="custom-icon" style="background:'+markers[i].project_status_color+';-webkit-mask-image: url('+markers[i].project_icon+');"></div>'
                });
            var popup = '<img src="'+markers[i].image+'" onerror="this.onerror=null;this.src=\'images/icons/default_project_img.png\';"/>'+
                '<input type="hidden" class="id" value="'+markers[i].id+'"/>'+
                '<div class="row nomargin-side">'+
                '<div class="col-md-2 icon-type nopadding-side">'+
                '<div class="icon-container" style="border: solid 4px '+markers[i].project_status_color+';"></div><div class="icon" style="background:'+markers[i].project_status_color+';-webkit-mask-image: url('+markers[i].project_icon+');"></div>'+
                '</div>'+
                '<div class="col-md-10 nopadding-side">'+
                '<div class="title">'+markers[i].country+'</div>'+
                '<div class="descrip">'+markers[i].project+'</div>'+
                '</div>'+
                //'<div class="col-md-5 quantity-currency nopadding-side">'+parseQty(markers[i].qty)+'</div>'+
                //'<span class="project-show-all">Details</span>'+
                '</div>';

            var m = L.marker( [markers[i].lat, markers[i].lng], {icon: myIcon} ).bindPopup( popup );
            markerClusters.addLayer( m );
        }
        return markerClusters;
    }

</script>
</body>
</html>