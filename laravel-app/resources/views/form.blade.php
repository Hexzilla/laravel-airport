<!DOCTYPE html>
<html>

<head>
    <title>Form</title>
    <!-- LIBRARY CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" integrity="sha256-rDWX6XrmRttWyVBePhmrpHnnZ1EPmM6WQRQl6h0h7J8=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.2.0/MarkerCluster.css" integrity="sha256-+bdWuWOXMFkX0v9Cvr3OWClPiYefDQz9GGZP/7xZxdc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.2.0/MarkerCluster.Default.css" integrity="sha256-LWhzWaQGZRsWFrrJxg+6Zn8TT84k0/trtiHBc6qcGpY=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css" integrity="sha256-LcmP8hlMTofQrGU6W2q3tUnDnDZ1QVraxfMkP060ekM=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.4.3/css/scroller.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.0.23/style/jquery.jscrollpane.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <!--CUSTOM CSS-->
    <link href="{{asset('css/jquery.jscrollpane.lozenge.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style-front.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- FONT AWESOME 5 CSS-->
    <link href="{{asset('fontawesome/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome/css/solid.css')}}" rel="stylesheet">

    <!-- LIBRARY JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js" integrity="sha256-kdEnCVOWosn3TNsGslxB8ffuKdrZoGQdIdPwh7W1CsE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.2.0/leaflet.markercluster.js" integrity="sha256-F2IexcTxWZ5YrNfc+MhXBE3n61CnB2JHKhdkZKua5KE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.2/highcharts.js" integrity="sha256-/VEowm8tPbokrIUlmW68jf1pHTKBlKkA8iHh/okHcUo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha256-eZNgBgutLI47rKzpfUji/dD9t6LRs2gI3YqXKdoDOmo=" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/733beb794c.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jScrollPane/2.0.23/script/jquery.jscrollpane.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <!--SWEET ALERT-->
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">

    <!--CUSTOM JS -->
    <script src="{{asset('js/script-front.js')}}"></script>

    <!-- FONT AWESOME 5 JS-->
{{--    <script src="{{asset('fontawesome/js/brands.js')}}"></script>--}}
{{--    <script src="{{asset('fontawesome/js/solid.js')}}"></script>--}}
{{--    <script src="{{asset('fontawesome/js/fontawesome.js')}}"></script>--}}
</head>

<body style="overflow-x: hidden;">
    <!-- HEADER -->
    @include("layouts.form.header-form")
    <!-- END HEADER -->
    <!-- FORM -->
    <div id="forms" style="display:none;">
        <div class="body">
            <!-- LOADING MODAL-->
            @include("layouts.loading_modal")
            <!-- GREEN -->
            <div class="headgreen" style="z-index:2;"></div>
            <!-- WALLPAPER -->
            <div class="headwallpaper" style="z-index:2;">
                <div class="row">
                    <div class="col-11 country" style="z-index:2;">{{$project_form_info->project_country}}</div>
                </div>
                <div class="row">
                    <div class="col-7 proyect" style="z-index:2;">{{$project_form_info->project_name}}</div>
                    <div class="col-5 qty-currency"></div>
                </div>
            </div>
            <!-- dark gradient & project img -->
            <div id="project_dark" style="">
            </div>
            <div id="project_background">
                <img src="/{{$project_form_info->project_image}}" >
            </div>
            <!-- CONTENT -->
            <div class="row form-breadcrumb">
                <div class="col-12">
                    <a href="#" onclick="goToUrl('/home?project_id={{$project_form_info->project_id}}')" title="Back to Project Info">MAPA</a>
                    <i class="fa fa-angle-right separator" aria-hidden="true"></i>
                    <a href="#" onclick="goToUrl('/home?project_id={{$project_form_info->project_id}}&show_phases=true')" title="Back to Project Phases View"><i class="fa fa-key" aria-hidden="true"></i> FASES</a>
                    <i class="fa fa-angle-right separator" aria-hidden="true"></i>
                    <a href="#"onclick="goToUrl('/home?project_id={{$project_form_info->project_id}}&show_phases=true')" title="Back to Project Phases View">{{$project_form_info->phase_name}}</a>
                    <i class="fa fa-angle-right separator" aria-hidden="true"></i>
                    <span>{{$project_form_info->form_name}}</span>
                </div>
            </div>
            <!-- SECTION 1: SUMMARY ********************************************************* -->
            <div class="row mt-5 summary">
                <div class="col-12 align-self-center section" style="background: linear-gradient(rgba(26, 39, 50, 0.75), rgba(26, 39, 50, 1)), url(/{{$project_form_info->project_image}});padding-bottom: 30px;">
                    @include("layouts.form.cons.form-body-tasks-summary-cons")
                </div>
            </div>
            <div class="row mt-4 summary">
                <div class="col-6">
                    <div class="h-100 section" style="background: linear-gradient(rgba(26, 39, 50, 0.75), rgba(26, 39, 50, 1)), url(/{{$project_form_info->project_image}});">
                        @include("layouts.form.cons.form-body-elements-summary-cons")
                    </div>
                </div>
                <div class="col-6">
                    <div class="h-100 section" style="background: linear-gradient(rgba(26, 39, 50, 0.75), rgba(26, 39, 50, 1)), url(/{{$project_form_info->project_image}});">
                        @include("layouts.form.cons.form-body-approvals-summary-cons")
                    </div>
                </div>
            </div>
            <!-- SECTION 2: Tasks ********************************************************* -->
            @include("layouts.form.cons.form-body-tasks-cons")

            <!-- SECTION 3: Elements of control ******************************************* -->
            @include("layouts.form.cons.form-body-elements-cons")

            <!-- SECTION 4: Approvals ***************************************************** -->
            @include("layouts.form.cons.form-body-approvals-cons")

            <!-- FOOTER MILESTONE NAVIGATION -->
            <div class="footer row">
                <div class="offset-1 col-5 align-self-center">
                    @if(@$prev_milestone!=null)
                        <div class="prev-button align-self-center" onclick="goToUrl('/form/{{$prev_milestone->id}}');" title="{{$prev_milestone->name}}">
                            <span>Hito Previo</span>
                        </div>
                    @endif
                    &nbsp
                </div>
                <div class="col-6 pull-right">
                    @if(@$next_milestone!=null)
                        <div class="next-button pull-right" onclick="goToUrl('/form/{{$next_milestone->id}}');" title="{{$next_milestone->name}}">
                            <span>Hito Siguiente</span>
                        </div>
                    @endif
                </div>
            </div>
            <!-- END FOOTER MILESTONE NAVIGATION -->
        </div>
    </div>
    <!-- END FORM -->
    <script>
        var userId = '<?php echo $userid?>';
        window.onresize = function (event) {
            calcMarginLeft();
        };
        /*
        *	Magic function to align section title with task order circle (responsive)
        */
        function calcMarginLeft(){
            w=$( window ).width();
            padding=(w/12) - 15 - $('#task-element-list > div:nth-child(1) > div.row.task-header.section-header.collapsed > div.col-1.task-order > span').width();
            //Control bootstrap padding
            if(padding<15){
                padding=15;
            }
            $('.proyect, .country, .form-breadcrumb > div, .div-section-title, .div-section-summary').css('padding-left',padding+'px');
        }
        $(document).ready(function() {
            //Activate Bootstrap Tooltips
            $(function () {
                $('[data-toggle="tooltip"]').tooltip({ html: true});
            });
            //$('#project_background').css("background-image", "url(/{{$project_form_info->project_image}})");
            calcMarginLeft();
            $( "#forms" ).fadeIn('slow');
            $('.js-example-basic-single').select2({
                placeholder: 'Select user',
                allowClear: true,
                val:""
            });
            @if(@$taskEditAllowed)
                //Activate Task Switches
                switchesForm($('#task-element-list'), false, false);
            @else
            $('.task-area.tasks').each(function(index,value){
                if ($(this).data('rolevalidationexception')==1){
                    switchesForm($(this), false, false);
                }
            });
            @endif
            @if(@$approvalEditAllowed)
                //Activate Approval Switches with data reload and confirm dialog
                switchesForm($('#approval-element-list'), true, true);
            @endif
            //Refresh the progress bar
            RefreshTaskProgressBar();
            RefreshElementSummary();
            RefreshApprovalSummary();
            if(window.location.hash!=null && window.location.hash!=''){
                $('#approval-element-list').removeClass('collapse');
                anchor=window.location.hash;
                $(document).scrollTop( $(anchor).offset().top );
                appBody='#appBody_'+anchor.split("_")[1];
                $(appBody).collapse();
            }
        });

        function goToUrl(url){
            loadingShow();
            window.location.href=url;
        }
        /**
         * Enable/Disable option to remove file in Modal of Task/Elems/Approv documents
         */
        function removeFileDoc(type, idElem){
            $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div.input-group').toggle();
            $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div:nth-child(3)').toggle();
            $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div:nth-child(3) > input').filestyle('clear');
            $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div.input-group > input').val('');
        }
        /**
         * Actualiza el modal de documentos segun la informacion del submit
         */
        function toggleFileDoc(type, idElem){
            //If not select a file
            if ($('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div:nth-child(3) > input').get(0).files.length === 0){
                if ($('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div.input-group > input').val()=='') {
                    $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div.input-group').hide();
                    $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div:nth-child(3)').show();
                }
            }
            else{
                //If select a file
                var fileName=$('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div:nth-child(3) > input').get(0).files[0].name;
                $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div.input-group').show();
                $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div.input-group > input').val(fileName);
                $('#'+type+'Modal_'+ idElem +' > div > div > div > div.modal-body > div:nth-child(3)').hide();
            }
        }
        /**
         * Recibe el submit de un document, actualiza los elementos de la pagina
         * y realiza el submit
         */
        function documentSubmit(form){
            $('#forms > div > div.loading').show();
            let id  = form.id.value;
            let doc = form.doc.value;
            let desc = form.description.value;
            let type = form.formType.value;
            let originalDoc = form.originalDoc.value;
            let projectId = form.projectId.value;

            let prefijo = "";
            let fileName = "";
            let div = "";
            if(type == "taskDocUrl"){
                prefijo = "taskDoc";
                div = "docUrl";
            }else if(type == "elementDocUrl"){
                prefijo = "eleDoc";
                div = "eleDocUrl";
            }
            else if(type == "elementTemplateUrl"){
                prefijo = "eleTemp";
                div = "tempDocUrl"
            }
            else if(type == "approvalDocUrl"){
                prefijo = "approvalDoc";
                div = "approvDocUrl";
            }
            if(doc!=''){
                fileName = $('#'+div+'Modal_'+ id +' > div > div > div > div.modal-body > div:nth-child(3) > input').get(0).files[0].name;
            }
            dataSubmit(form, false, null).then(function(res){
                if(res == 'true'){
                    $('#forms > div > div.loading').hide();
                    if(prefijo != ""){
                        if(desc != ""){
                            $('#'+ prefijo+'DescId_'+id).text(desc);
                            $('#'+ prefijo+'DescId_'+id).removeClass("disabled");
                        } else{
                            $('#'+prefijo+'DescId_'+id).text("No document available");
                            $('#'+prefijo+'DescId_'+id).addClass("disabled");
                        }
                        if(doc!=""){
                            $('#'+prefijo+'UploadId_'+id).removeClass("disabled");
                            $('#'+prefijo+'DownloadId_'+id).removeClass("disabled");

                            $('#'+prefijo+'DownloadId_'+id).attr('onclick','').unbind('click');
                            $('#'+prefijo+'DownloadId_'+id).click(
                                function(){
                                    downloadFromSharepoint('/downloadDoc/'+projectId+'/'+type+'/'+id+'/'+fileName);
                                }
                            );
                        }
                        else if(originalDoc==""){
                            $('#'+prefijo+'UploadId_'+id).addClass("disabled");
                            $('#'+prefijo+'DownloadId_'+id).addClass("disabled");
                            $('#'+prefijo+'DownloadId_'+id).unbind("click");
                            $('#'+prefijo+'DownloadId_'+id).attr('onclick','').unbind('click');
                        }
                        toggleFileDoc(div, id);
                    }
                    //update element summary
                    if(type=="elementDocUrl"){
                        //if description we send true
                        RefreshElementSummary(id, doc!=""?true:false);
                    }
                    else if(type=="approvalDocUrl"){
                        RefreshApprovalSummary(id, doc!=""?true:false);
                    }
                }
                else{
                    $('#forms > div > div.loading').hide();
                    if(res=='error.maxsize'){
                        alert("Error: el fichero supera el tamaño máximo");
                    }
                    else if(res=='error.projectFolder'){
                        alert("Error al cargar el documento en Sharepoint.\nEl proyecto no tiene asociada ninguna carpeta de Sharepoint.");
                    }
                    else if(res=='error.sharepoint'){
                        alert("Error al cargar el documento en Sharepoint.\nRevise que exista la carpeta correspondiente en Sharepoint y que tenga permisos para operar en ella.");
                    }
                    else if(res=='error.login'){
                        alert("Error al intentar conectar con Sharepoint");
                    }
                    else{
                        alert("Error cargando el documento");
                    }
                }
            });
        }

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

        $('.consultedContainer').each(function(index,value){
            var taskId = $(this).data('taskid');
            var dropdown = '#consulted_user_taskForm_'+taskId;
            $(dropdown).select2({
                minimumInputLength: 3,
                ajax: {
                    url: '/form/findUser',
                    type: 'POST',
                    minimumInputLength: 3,
                    delay: 250,
                    data: function (params) {
                        var query = {
                            search_term: params.term,
                            _token: '{{ csrf_token() }}'
                        };
                        return query;
                    },
                    processResults: function (data) {
                        console.log(data);
                        return {
                            results: data
                        };
                    }
                }
            });
            $(dropdown).on("select2:selecting", function (e) {
                var currentValue = e.params.args.data;
                var previousValue = $(this).val();
                var thisElement = this;
                if (currentValue!=undefined){
                    $.confirm({
                        title: 'Notificar al usuario',
                        content: 'Se notificará a '+currentValue.text,
                        buttons: {
                            notificar: {
                                btnClass: 'btn-corp-color',
                                action: function () {
                                    $.data(thisElement, 'current', $(thisElement).val());
                                    sendConsultedForm(taskId,currentValue.text,currentValue.id);
                                }
                            },
                            cancelar: function () {
                                $(thisElement).val(previousValue).trigger('change');
                            },
                        }
                    });
                }
            });
        });

        function sendConsultedForm(taskId, name, email){
            var form = 'consulted_form';
            $("#consulted_form input[name='consulted_taskId']").val(taskId);
            $("#consulted_form input[name='consulted_name']").val(name);
            $("#consulted_form input[name='consulted_email']").val(email);

            return $.ajax({ // create an AJAX call...
                //data: $(form).serialize(), // get the form data
                data: new FormData(document.getElementById(form)), // get the form data
                contentType: false,
                processData: false,
                type: $('#'+form).attr('method'), // GET or POST
                url: $('#'+form).attr('action'), // url
                success: function (response) { // on success..
                    if (response.data){
                        notifyConsulted(taskId,userId,name,email);
                    }
                }
            });
        }
        function findUser(searchTerm){
            var form = 'findUser';
            $("#findUser input[name='search_term']").val(searchTerm);

            return $.ajax({ // create an AJAX call...
                data: new FormData(document.getElementById(form)), // get the form data
                contentType: false,
                processData: false,
                type: $('#'+form).attr('method'), // GET or POST
                url: $('#'+form).attr('action'), // url
                success: function (response) { // on success..
                }
            });
        }
    </script>
</body>
</html>
