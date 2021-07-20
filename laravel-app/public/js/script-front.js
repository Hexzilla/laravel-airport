var timeOffset = null;
var cityOffset = null;

function downloadFromSharepoint(url){
    var exist = true;
    try{
        let response = $.ajax({
            type: "GET",
            url: url,
            async: false
        }).responseText;    
        //console.log(response);
        if (null !== response && undefined !== response){
            let responseParsed = JSON.parse(response);
            if (null !== responseParsed && undefined !== responseParsed && null !== responseParsed.error && undefined !== responseParsed.error){                    
                alert(responseParsed.error.message.value);
                exist = false;
            }
        }
    }catch(err){
        //console.log(err);
    }
    if (exist){
        location.href=url;
    }
}

$(document).ready(function () {
    
    $('#buttonBackOffice').click(function(){window.location.href = "/";});
    $('.loading').hide().removeClass('hide');
    refreshClock();



    $(document).click(function(event) {
        if ($(event.target).closest('#fotoLogout').length) {
            if($('#dialogButtonsProfile').is(":visible")) {
                $('#dialogButtonsProfile').hide();
            }else{
                showDialogLogout();
            }  
        }
        else if(!$(event.target).closest('#dialogButtonsProfile').length) {
            if($('#dialogButtonsProfile').is(":visible")) {
                $('#dialogButtonsProfile').hide();
            }
        } 
    });
    //################ PROJECT LOAD DATA ONCLICK
    $(document).on('click', '.leaflet-popup'/* .project-show-all*'*/, function () {
        var id = $(this).closest('.leaflet-popup').find('.id').val();
        var projectName = $(this).closest('.leaflet-popup').find('.descrip').html();
        var projectImage = $(this).closest('.leaflet-popup').find('img').attr('src');
        //console.log('ID: ' + id);
        $('.project_thumb').attr('src',projectImage);
        $('.current_project_name').html(projectName);
        $('.current_project_download').attr('onclick','generateProjectPdfById('+id+', true)');
        $('#currentProject').show();
        //TODO get project data (ajax)
        if (!$('#mapFilters').hasClass('hiddenFilters')){
            ShowFilters();
        }
        $('#latestNews').removeClass('showing');
        $('#latestNews').find('.btnSidePress .fa-chevron-right').removeClass('fa-chevron-right').addClass('fa-chevron-left');
        $('#currentProject').removeClass('showing');
        $('#currentProject').find('.fa-chevron-right').removeClass('fa-chevron-right').addClass('fa-chevron-left');        
        loadProjectInfo(id, false);
    });

    //################ FORMS

    

    //############# RELOJ
    setInterval(function () {
        refreshClock();
    },30000);

    
    $('.today').append(getDayMonth());

    //############# MODALS CONTROLLER
    setSliderModalController('projects');
    setModalController('projectdata');
    setModalController('actualphase');
    setModalController('organization');
    setModalController('financial');
    setModalController('country');
    setModalController('airport');
    setModalController('oportunity');
    
    
    //############## CHANGE VIEW
    $('#change-view-slidder, #change-view-slidder2').click(function () {
        
        if ($("#project_list_div").is(":hidden")) {

            $("#timestamp, .open-projects-modal").hide();
            $("#project_list_div").show();
            $("#project_list_div").removeClass('fadeIn').addClass('fadeIn');
            $('#mapContainer').removeClass('blur').addClass('blur');
            $('#change-view-slidder, #change-view-slidder2').removeClass('active');            
            //$(".dataTables_scrollBody").jScrollPane({autoReinitialise: true});
            $(".dataTables_scrollBody").jScrollPane();
            tableProjects.order([1, 'asc']).draw();
            $('#currentProject').hide();
            $('#latestNews').hide();
            
        } else {
            $("#timestamp, .open-projects-modal").show();
            checkShowTimestamp();
            $("#project_list_div").hide();
            $('#mapContainer').removeClass('blur')
            $('#change-view-slidder, #change-view-slidder2').removeClass('active').addClass('active');
            if (loadedProject){
                $('#currentProject').show();
            }
            $('#latestNews').show();
        }
    });
    


    $('.change-view-container > .toggle-container').click(function () {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')){
            $('.change-view-container .phase-text').text('VISTA MAPA');
        }else{
            $('.change-view-container .phase-text').text('VISTA LISTA');
        }
    });

    $('#mapFilters .toggle-container').click(function () {
        $(this).toggleClass('active');

        switchFilterChange();
    });

    //############# PHASES COLORS
    $(".phase-color").each(function () {
        //console.log( $( this ).data( "color" ));
        $(this).css("background", '#' + $(this).data("color"))
    });


    //############# SEARCH LOGIC
    $('#searchFilter').on("paste keyup", function() {
        var contains = $(this).val().length>0;
        if (contains){
            $('.search .clear').removeClass('filterLoading').addClass('filterLoading').show();
            $('.search i.fa-times').hide();
        }else{
            $('.clear').hide();
        }
        filterMarkers($(this).val());
        reloadProjectList($(this).val());
        //loadMarkers();
        if (contains){
            $('.search .clear').removeClass('filterLoading');
            $('.search i.fa-times').show();
        }else{
            $('.search .clear').removeClass('filterLoading');
            $('.search i.fa-times').hide();            
        }
    });

    $('.search .clear').click(function(){
        $('#searchFilter').val('');
        $('.search .clear').removeClass('filterLoading');
        $('.search i.fa-times').hide();  
        filterMarkers('');     
        reloadProjectList('');            
    });
    
    //Security Fix: disable autocomplete
    $(document).on('focus', ':input', function() {
        $(this).attr('autocomplete', 'off');
    });

    checkShowTimestamp();
});
//End $(document).ready


//Eventos al cambiar tamaño de pantalla
window.onresize = function (event) {

    //Si esta visible la tabla de proyectos
    if (!$("#project_list_div").is(":hidden")) {
        //Redibujamos scroll en listado de proyectos
        $(".dataTables_scrollBody").jScrollPane();
    }

    checkShowTimestamp();

};


function checkShowTimestamp(){
    //alert($(window).width());
    if($(window).width()<1400){
        //get element form document
        $('#timestamp').css('display', 'none');
    }
    else{
        $('#timestamp').css('display', 'block');
    }
}

function reloadProjectList(text){
    dataProjectList = [];
    //dataProjectListOriginal.forEach(project => {    
    dataProjectListOriginal.forEach(function (project) {
        //console.log(project.name, project, city, country);
        if (have(project[1],text)) {//|| have(project[2],text) || have(project[3],text) || have(project[8],text)){
            dataProjectList.push(project);
        }
    });
    var table = $('#projects_datatable').DataTable();
    table.clear().rows.add(dataProjectList).draw();
}

function switchFilterChange(){
    text=$("#searchFilter").val();
    filterMarkers(text);
    //filterSwitchs(text);
}

function filterMarkers(text){
    markersEuropa = [];

    markersEuropaOriginal.forEach(function(project){//.forEach(project => {
        //console.log(project.name, project, city, country);
        if (have(project.name,text)){ //|| have(project.project,text) || have(project.city,text) || have(project.country,text)){
            
            //Si pasa el filtro de texto comprobamos si pasa el filtro de los switchs
            if(filterSwitchs(project)){
                markersEuropa.push(project);
            }
        }
    });
    loadMarkers();    
}

/**
 * Comprueba si el proyecto pasado por parametros
 * pasa los filtros y debe ser mostrado en el mapa.
 * @param {*} p - json con la info del proyecto
 * 
 */
function filterSwitchs(proj){

    showMark=true;

    if(proj==null || proj == ''){
        return true;
    }

    $('.switch-filter').each(function(index, elem){
        //console.log( index, elem );
        
        var filter = $(this).attr('class').split(' ')[1];
        var arrayFilter = filter.split("_");

        isActive=$(this).hasClass("active");

        //console.log(index +' - '+ isActive);

        if(isActive==false){

            if ("colorFilter" == arrayFilter[0]) {
                //console.log("colorFilter: "+arrayFilter[1]);
                if(proj.project_status_color.replace('#', '')== arrayFilter[1]){
                    showMark=false;
                    return false;
                }

                
            } else if ("projModelFilter" == arrayFilter[0]) {
                //console.log("projTypeFilter: "+arrayFilter[1]);

                if(proj.som_projects_model_id==arrayFilter[1]){
                    showMark=false;
                    return false;
                }


            } 
            else if ("projStatusInfo" == arrayFilter[0]){

                if(proj.som_project_info_status_id==arrayFilter[1]){
                    showMark=false;
                    return false;
                }
            }
            else if ("airportSize" == arrayFilter[0]){
                if(parseFloat(proj.som_projects_airport_size)>=parseFloat(arrayFilter[1]) 
                    && parseFloat(proj.som_projects_airport_size)<=parseFloat(arrayFilter[2])){
                    showMark=false;
                    return false;
                }
            }/*
            else if ("closedFilter" == arrayFilter[0]) {
                //console.log("closedFilter: "+arrayFilter[1]);

                if(proj.is_closed==arrayFilter[1]){
                    showMark=false;
                    return false;
                }

            }
            else if("awardedFilter" == arrayFilter[0]){
                //console.log("awardedFilter: "+arrayFilter[1]);

                if(proj.som_projects_is_awarded==arrayFilter[1]){
                    showMark=false;
                    return false;
                }
            }
            else if("dismissedFilter" == arrayFilter[0]){
                //console.log("dismissedFilter: "+arrayFilter[1]);
                
                if(proj.som_projects_is_dismissed==arrayFilter[1]){
                    showMark=false;
                    return false;
                }
            }*/

        }

    })

    //console.log("showMark: "+showMark);

    return showMark;
}


/**
 * Comprueba si el array contiene el string, para filtrar búsquedas
 * @param {*} array 
 * @param {*} string 
 */
function have(array, string){
    if (array!=null || string!=null){
        arrayStr = array.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toUpperCase();
        stringStr = string.normalize('NFD').replace(/[\u0300-\u036f]/g, "").toUpperCase();
        return (arrayStr.indexOf(stringStr) !== -1);
    }else{
        return false;
    }
}

function NullOrEmptyString(stringValue,optionalConcat,caps){
    if (stringValue===null || stringValue===undefined || stringValue === ''){
        return '-';
    }else{
        
        if (optionalConcat===null || optionalConcat===undefined || optionalConcat === ''){
            if (typeof stringValue === 'number'){
                return caps?stringValue:stringValue;
            } else{
                return caps?stringValue.toUpperCase():stringValue;
            }
        }else{
            if (typeof stringValue === 'number'){
                return caps?stringValue+optionalConcat:stringValue+optionalConcat;
            }else{
                return caps?stringValue.toUpperCase()+optionalConcat:stringValue+optionalConcat;
            }
        }
    }
}


/**
 * 
 * @param {Capa donde pintar el gráfico} capa 
 * @param {Valores del gráfico} data 
 */
function pintaRate(capa, data){
    var html = "";
    if (data.politics !== null){
        html += '<div class="country-risk-list-politics"><span>POLITICS</span>';
        html += getRate(data.politics);
        html += '</div>';
    }
    if (data.regulatory !== null){
        html += '<div class="country-risk-list-regulatory"><span>REGULATORY</span>';
        html += getRate(data.regulatory);
        html += '</div>';
    }  
    if (data.corruption !== null){
        html += '<div class="country-risk-list-corruption"><span>CORRUPTION</span>';
        html += getRate(data.corruption);
        html += '</div>';
    }  
    if (data.easyBusiness !== null){
        html += '<div class="country-risk-list-easyBusiness"><span>EASY OF DOING BUSINESS</span>';
        html += getRate(data.easyBusiness);
        html += '</div>';
    }  
    if (data.affinity !== null){
        html += '<div class="country-risk-list-affinity"><span>AFFINITY WITH SPAIN</span>';
        html += getRate(data.affinity);
        html += '</div>';
    }                

    $('.'+capa).html(html);
}

function getRate(num){
    var htmlRate = '';
    for (var i = 0; i < 5; i++) {
        if (i>=num){
            htmlRate = htmlRate.concat('<i class="far fa-star"></i>');
        }else{
            htmlRate = htmlRate.concat('<i class="far fa-star greenStar"></i>');            
        }
    }
    return htmlRate;
}

/**
 * 
 * @param {Capa donde pintar el gráfico} capa 
 * @param {Valores del gráfico} data 
 */
function pintarYearChart(capa, data, labels, isPdf){
    $('.' + capa).each(function () {

    var defaultColors = {
        backgroundColor:'#000000',
        labelColor:'#96ce00',
        gridLineColor: '#e6e6e6',
        seriesColor: '#96ce00'
    };

    var pdfColors = {
        backgroundColor:'#FFF',
        labelColor:'#96ce00',
        gridLineColor: '#3c3c3c',
        seriesColor: '#96ce00'
    };


    if (isPdf){
        defaultColors = pdfColors;
    }

    var chart = new Highcharts.Chart({
        chart: {
            backgroundColor: defaultColors.backgroundColor,
            polar: true,
            //type: 'line'
            type: 'areaspline',
            renderTo: this,
            height: 150,
            width: 290
        },
    
        title: {
            text: null
        },
    
        subtitle: {
            text: null
        },
    
        credits: {
            enabled: false
        },
        tooltip: {
            enabled: false
        },
        yAxis: {
            title: {
                text: null
            },
            labels: {
                style: {
                    color: defaultColors.labelColor
                }
            }            
        },
        xAxis: {
            categories:labels,
            title: {
                text: null
            },
            gridLineColor: defaultColors.gridLineColor,
            labels: {
                style: {
                    color: defaultColors.labelColor
                }
            },
            tickInterval: 1
        },
        exporting: {
            enabled: false
        },
        legend: {
            enabled: false
        },
    
        plotOptions: {
            areaspline: {
                fillOpacity: 0.0
            },
            line: {
                marker: {
                    enabled: false
                },
                states: {
                    hover: {
                        enabled: false
                    }
                }
            },
            series: {
                label: {
                    enabled: false,
                    connectorAllowed: false
                }
                
            }
        },
    
        series: [{
    
            data: data,//[43934, 52503, 57177, 69658, 97031],
            lineWidth: 3,
            color: defaultColors.seriesColor
        }],
    
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        enabled: false
                    }
                }
            }]
        }
    
    }, null);
        
});
}

/**
 * 
 * @param {Capa donde pintar el gráfico} capa 
 * @param {Valores del gráfico} data 
 * @param {Colores del gráfico} colors 
 */
function pintarChart(capa, data,colors) {
    $('.' + capa).each(function () {
        
        
        var chart = new Highcharts.Chart({
            chart: {
                margin: [0, 0, 0, 0],
                spacingTop: 0,
                spacingBottom: 0,
                spacingLeft: 0,
                spacingRight: 0,
                renderTo: this, //capa,
                type: 'pie',
                backgroundColor: "rgba(255, 255, 255, 0)",
                height: 100
            },
            
            credits: {
                enabled: false
            },
            colors: colors,
            
            title: {
                text: '',
                style: {
                    display: 'none'
                }
            },
            tooltip: {
                enabled: false
            },
            plotOptions: {
                series: {
                    states: {
                        hover: {
                            enabled: false
                        }
                    }
                },
                pie: {
                    slicedOffset: 0,
                    dataLabels: {
                        enabled: false
                    },
                    size: '100%',
                    innerSize: '85%',
                    dataLabels: {
                        enabled: false,
                    },
                    borderWidth: '0.5px',
                    borderColor: 'white'
                }
            },
            series: [{
                data: data
            }]
        }, null);
        
    });
}

/**
 * 
 * @param {Id del form para abrir la url} idForm 
 */
function goForm(idForm){
    loadingShow();
    window.location.href = "/form/"+idForm;
}

/**
 * Crea un modal slider
 * @param {id o clase del modal} modal 
 */
function setSliderModalController(modal) {
    var elementsToHideSlow = '.search, .view';
    var elementsToHideFast = '.open-projects-modal, #timestamp, #currentProject, #latestNews';
    
    var modalId = modal + "-modal"
    $('.open-' + modalId).click(function () {
        $('.' + modalId).css('z-index', '9999');
        $('.' + modalId).removeClass('slideInRight').removeClass('slideOutRight').addClass('slideInRight');
        $(elementsToHideFast).hide();
        $(elementsToHideSlow).removeClass('fadeIn').removeClass('fadeOut').addClass('fadeOut');
        $('#mapContainer').removeClass('blur').addClass('blur');
    });
    $('.close-' + modalId).click(function () {
        $('.' + modalId).removeClass('slideInRight').removeClass('slideOutRight').addClass('slideOutRight');
        $(elementsToHideFast).show();
        checkShowTimestamp();
        $(elementsToHideSlow + ',' + elementsToHideFast).removeClass('fadeIn').removeClass('fadeOut').addClass('fadeIn');
        $('#mapContainer').removeClass('blur');
    });
}

function setModalController(modal) {
    var elementsToHideSlow = '.search, .view, .sideRightHiddingPanel';
    var elementsToHideFast = '.open-projects-modal, #timestamp, #currentProject, #latestNews';
    
    var modalId = modal + "-modal"
    $('.open-' + modalId).click(function () { //SHOW
        loadMultiAirportSheet(0);
        $('.' + modalId).css('z-index', '9999');
        $('.' + modalId).removeClass('fadeIn').removeClass('fadeOut').addClass('fadeIn');
        $(elementsToHideFast).hide();
        $(elementsToHideSlow).removeClass('fadeIn').removeClass('fadeOut').addClass('fadeOut');
        $('#mapContainer').removeClass('blur').addClass('blur');
        $('.' + modalId).show();
        $(".team-scroll").jScrollPane({
            autoReinitialise: true
        });
    });
    $('.close-' + modalId).click(function () { //HIDE
        loadMultiAirportSheet(0);
        $('.' + modalId).removeClass('fadeIn').removeClass('fadeOut').addClass('fadeOut');
        $(elementsToHideFast).show();
        checkShowTimestamp();
        $(elementsToHideSlow + ',' + elementsToHideFast).removeClass('fadeIn').removeClass('fadeOut').addClass('fadeIn');
        $('.' + modalId).hide();
        $('.modal-big').addClass('hide');
        $('.modal-small').removeClass('hide');
        $('#mapContainer').removeClass('blur');
    });
}


/**
 * Refresca el reloj
 */
function refreshClock(){
    var date = new Date;
    var minutes;
    if (date.getMinutes() < 10) {
        minutes = '0' + date.getMinutes();
    } else {
        minutes = date.getMinutes();
    }
    var hour = date.getHours();
    var ampm = hour >= 12 ? 'pm' : 'am';
    if (hour < 10) {
        $('#HORA').css("left", "49px");
    }
    $('#HORA').html('<p>' + hour + ':' + minutes + ' ' + ampm /*'+seconds+'*/ + '</p>');
    if (cityOffset!=null && timeOffset!=null){
        $('#DOHAGMT').html('<p> '+cityOffset+/*' GMT '+timeOffset/3600000*/' ( ' + calcTime(timeOffset) + ' )</p>');
    }else{
        $('#DOHAGMT').html('<p></p>');
    }
}

/**
 * Calcula el horario en el projecto asignado
 * @param {offset en ms sobre la hora utc} offset 
 */
function calcTime(offset) {
    // creamos el objeto Date (la selecciona de la máquina cliente)
    d = new Date();
    // lo convierte  a milisegundos
    // añade la dirferencia horaria
    // recupera la hora en formato UTC
    utc = d.getTime() + (d.getTimezoneOffset() * 60000);

    // crea un nuevo objeto Date usando la diferencia dada.
    nd = new Date(utc + (offset));

    var minutes;
    if (nd.getMinutes() < 10) {
        minutes = '0' + nd.getMinutes();
    } else {
        minutes = nd.getMinutes();
    }

    var ampm = nd.getHours() >= 12 ? 'pm' : 'am';
    // devuelve la hora como string.
    return nd.getHours() + ":" + minutes + " " + ampm; //":"+seconds;
}

function parseShortDate(date){
    var dateObj = parseDate(date);
    return getShortDate(dateObj);
}

function getShortDate(d){
    if (d!=null){
        var month = new Array();
        month[0] = "JAN";
        month[1] = "FEB";
        month[2] = "MAR";
        month[3] = "APR";
        month[4] = "MAY";
        month[5] = "JUN";
        month[6] = "JUL";
        month[7] = "AUG";
        month[8] = "SEP";
        month[9] = "OCT";
        month[10] = "NOV";
        month[11] = "DEC";
        return month[d.getMonth()] + ' ' + d.getDate()+' '+d.getFullYear();
    }
    return "";
}

/**
 * Genera un string con la fecha en formato DD/MMM
 */
function getDayMonth() {
    var d = new Date();
    return getShortDate(d);
}

/**
 * Parsea la fecha en formato string
 * @param {fecha} dateString 
 */
function parseDate(dateString){
    //2023-09-25
    if (dateString!=null){
        var dateTemp = dateString.split("-");
        return new Date(dateTemp[0], dateTemp[1] - 1, dateTemp[2]);
    }else{
        return null;
    }
}

/**
 * Calcula la posición en % de una fecha, entre la fecha inicio y fecha fin
 * @param {*} startDate 
 * @param {*} endDate 
 * @param {*} positionDate 
 */
function getPercentDate(startDate, endDate, positionDate){
    var start = parseDate(startDate).getTime();
    var end = parseDate(endDate).getTime();
    var pos = parseDate(positionDate).getTime();
    end = end-start;
    pos = pos-start;
    var perDay = end/100;
    return pos/perDay;
}

/**
 * Dado el id del proyecto carga su info
 * @param {*} id 
 */
function loadProjectInfo(id, onBack) {
    loadingShow();

    $('#footerProject1').removeClass("fadeOutLeft");
    $('#footerProject1').addClass("fadeInUp");
    

    var xhr = new XMLHttpRequest() // create new XMLHttpRequest2 object
    xhr.open('GET', '/api/get_project?id=' + id) // open GET request
    xhr.onload = function () {
        if (xhr.status === 200) { // if Ajax request successful
            var output = JSON.parse(xhr.responseText) // convert returned JSON string to JSON object
            //console.log(output.status) // log API return status for debugging purposes
            if (output.api_status == 'OK') { // if API reports everything was returned successfully
                loadedProject = true;
                currentProjectInfo = output.data;
                console.log(currentProjectInfo)
                $('#timestamp').css('bottom','29%');

                loadProjectData(currentProjectInfo);
                loadActualPhase(currentProjectInfo);
                loadProjectTeam(currentProjectInfo);
                //console.log('stop');
                loadPhaseMap(currentProjectInfo);

                loadAirportSheet(currentProjectInfo);
                loadCountrySheet(currentProjectInfo);
                loadOportunitySheet(currentProjectInfo);

                multiAirportData = currentProjectInfo.project.multi_airport;
                multiAirportIndex = 0;

                if (!onBack){
                    loadingHide(onBack);
                }

                //Check if load financial_summary
                var layout = document.body.dataset.layout;
                if(layout=='cons'){
                    setTimeout(function(){
                        $('#goRight').show();
                        $('#goRight').addClass("fadeIn animated");
                    }, 1000);
                }
                $('#currentProject').removeClass('hide');

                //Si no existen multiaeropuertos ocultamos los controles para alternarlos
                if (currentProjectInfo.project.multi_airport.length>1){
                    $('.multi-airport-slider').css('display','block');
                }else{
                    $('.multi-airport-slider').css('display','none');
                }
                console.log(onBack)
                if (onBack){
                    loadingHide(onBack);
                    $('.open-projects-modal').click();	
                }
                
                
            } else if (output.api_status == 'KO') {
                alert(output.api_message);
                loadingHide(onBack);
            }
        } else {
            alert('Request failed.  Returned status of ' + xhr.status)
            loadingHide(onBack);
        }
    }
    xhr.send() // send request
    xhr.onerror= function(){
        alert('Request failed.  Returned status of ' + xhr.status)
        loadingHide(onBack);
    }
}

/**
 * Muestra pantalla loading
 */
function loadingShow(){
    $('.loading').show();
    $('#timestamp').hide();
    //$('#mapContainer').removeClass('blur').addClass('blur');
}

/**
 * Oculta pantalla loading
 */
function loadingHide(onBack){
    $('.loading').hide();
    if (!onBack){
        //$('#timestamp').show();
        checkShowTimestamp();
        $('#mapContainer').removeClass('blur');
    }
}
/*
*Muestra los botones de backoffice y logout
*/
function showDialogLogout(){
    $('#dialogButtonsProfile').hide().removeClass('hide');
    $('#dialogButtonsProfile').show();
}

function showMoreCards(){
    $('#footerProject1').removeClass("fadeInUp").addClass("fadeOutLeft");

    $('#footerProject2').removeClass("hide").removeClass("fadeOutDown").removeClass("fadeOutRight").addClass("fadeInRight");

    $('#goRight').hide();

    setTimeout(function(){
        $('#goLeft').show();
        $('#goLeft').addClass("fadeIn");
    }, 1000);
    

}

function showMinusCards(){
    $('#footerProject2').removeClass("fadeInRight").addClass("fadeOutRight");
    $('#footerProject1').removeClass("fadeOutLeft").addClass("fadeInLeft");

    $('#goLeft').hide();

    setTimeout(function(){
        $('#goRight').show();
        $('#goRight').addClass("fadeIn");
    }, 1000);
    

}


/**
 * Carga su modal/footer y muestra panel footer 'project data'
 * @param {Objeto con la info del proyecto} info 
 */
function loadProjectData(info) {
    timeOffset = info.project.som_projects_timeoffset!=0?info.project.som_projects_timeoffset:null;
    cityOffset = info.project.som_projects_city;
    refreshClock();
    //FOOTER
    //MODAL
    $('.img_url').attr('src', info.project.som_projects_img_url);
    $('.name').text(info.project.som_projects_name);

    $('.sub_name').text(info.project.som_projects_sub_name);
    $('.priority').text(ifNull(info.project.som_projects_priority));
    $('.country').text(info.project.som_projects_country);

    if (info.project.som_projects_documentation_folder === null){
        $('.sharepoint-card').hide();
    }else{
        $('.sharepoint-card').show();
        $('.sharepoint_url').attr('onclick',"window.open('"+info.project.som_projects_documentation_folder+"','_blank')")
    }
    
    $('.equity').html(/*parseQty*/getQtyHtml(info.project.som_projects_equity));
    $('.shareholding').html(info.project.som_projects_shareholding+'<span class="percent-symbol">%</span>');
    $('.grantor').text(ifNull(info.project.som_projects_grantor));
    $('.asset_type, .typename').text(ifNull(info.project.som_projects_asset_type));
    $('.process_type').text(ifNull(info.project.som_projects_process_type));
    $('.transaction_type').text(ifNull(info.project.som_projects_transaction_type));

    $('.shareholding_detail').html(ifNull(info.project.som_projects_shareholding)+'<span class="percent-symbol">%</span>');
    $('.nbo_date').text(info.project.som_projects_relevant_date_1);
    $('.bo_date').text(info.project.som_projects_relevant_date_2);
    $('.concession_start').text(ifNull(info.project.som_projects_concession_date_start));
    $('.concession_end').text(ifNull(info.project.som_projects_concession_date_end));

    $('.client').html(ifNull(info.project.som_projects_grantor));
    $('.length').html(ifNull(info.project.length));
    
    
    var partners = "<span>PARTNERS</span>";
    info.project.partners.forEach(function(partner){//.forEach(partner => {
        partners += '<ul class="partner-list">'+
                        '<li><span>'+partner.name+'</span></li>'+
                    '</ul>';
    });
    var advisors = "<span>ADVISORS</span>";
    info.project.advisors.forEach(function(advisor){//.forEach(advisor => {
        advisors += '<ul class="partner-list">'+
                        '<li><span>'+advisor.name+'</span></li>'+
                    '</ul>';
    });        
    $('.partners').html(partners);
    $('.advisors').html(advisors);
    
    $('.footer, .projects-modal, .middle-button').removeClass('hide');
    $('.footer').removeClass('fadeOutDown').addClass('fadeInUp');
}

/**
 * Carga su modal/footer y muestra panel footer 'airport sheet'
 * @param {Objeto con la info del proyecto} info 
 */
function loadAirportSheet(info) {
    //FOOTER DATA
    $('.airport-data .sub-title.airport-name, .airport-modal .airport-name').html(NullOrEmptyString(info.project.airport.name,null,false));
    $('.airport-data .sub-data.airport-size').html(NullOrEmptyString(info.project.airport.size,null,false)+'<span class="percent-symbol">MPax</span>');
    $('.airport-data .sub-data.airport-ebitd').html(NullOrEmptyString(info.project.airport.EBITDA,null,false)+'<span class="percent-symbol">MN €</span>');
    //MODAL DATA 1
    $('.airport .show-image, .airport-modal .image-container img').attr('src',info.project.airport.som_projects_airport_img_url);

    $('.airport-modal .airport-iata-value').html(NullOrEmptyString(info.project.airport.iata_oaci,null,true));
    $('.airport-modal .airport-country-value').html(NullOrEmptyString(info.project.airport.country,null,true));
    
    $('.airport-modal .airport-type-value').html(NullOrEmptyString(info.project.airport.airport_type,null,true));
    $('.airport-modal .airport-size-value').html(NullOrEmptyString(info.project.airport.size,' M Pax',false));
    $('.airport-modal .airport-ebitda-value').html(NullOrEmptyString(info.project.airport.EBITDA,' MN €',true));

    $('.airport-modal .airport-aero-revenues-value').html(NullOrEmptyString(info.project.airport.revenues_aeronautical,' MN €',true));
    $('.airport-modal .airport-non-aero-value').html(NullOrEmptyString(info.project.airport.revenues_non_aeronautical,' MN €',true));
    $('.airport-modal .airport-total-revenues-value').html(NullOrEmptyString(info.project.airport.total_revenues,' MN €',true));
    $('.airport-modal .airport-total-opex-value').html(NullOrEmptyString(info.project.airport.total_opex,' MN €',true));

    $('.airport-modal .airport-kpis-revenues-aeronautical').html(NullOrEmptyString(info.project.airport.kpi_revenues_aeronautical,' €/PAX',true));
    $('.airport-modal .airport-kpis-revenues-non-aeronautical-value').html(NullOrEmptyString(info.project.airport.kpi_revenues_non_aeronautical,' €/PAX',true));
    $('.airport-modal .airport-kpis-ebitda-value').html(NullOrEmptyString(info.project.airport.kpi_ebitda,'  €/PAX',true));
    $('.airport-modal .airport-kpis-debt-value').html(NullOrEmptyString(info.project.airport.debt_ebitda," x",true));
    //MODAL DATA 2
    $('.airport-modal .airport-international-value').html(NullOrEmptyString(info.project.airport.percentage_international,' %',true));
    $('.airport-modal .airport-transfer-value').html(NullOrEmptyString(info.project.airport.percentage_transfer,' %',true));
    $('.airport-modal .airport-non-low-cost-value').html(NullOrEmptyString(info.project.airport.percentage_non_low_cost,' %',true));    
    $('.airport-modal .airport-competitors-description').html(NullOrEmptyString(info.project.airport.competitors,null,false));
    $('.airport-modal .airport-routes-description').html(NullOrEmptyString(info.project.airport.route,null,false));
    $('.airport-modal .airport-infra-charact-description').html(NullOrEmptyString(info.project.airport.infrastructure_characterization_description,null,false));
    $('.airport-modal .airport-catchment-description').html(NullOrEmptyString(info.project.airport.airport_catchment_area,null,false));
    $('.airport-modal .airport-master-plan-description').html(NullOrEmptyString(info.project.airport.master_plan_estimations,null,false));
    $('.airport-modal .airport-society-model-description').html(NullOrEmptyString(info.project.airport.society_model_regulation,null,false));
    $('.airport-modal .airport-aenas-network-description').html(NullOrEmptyString(info.project.airport.aena_network_improvement,null,false));    

    $('.airport-modal .airport-other-info-description').html(NullOrEmptyString(info.project.airport.som_projects_airport_other_info,null,false));    
    $('.airport-modal .airport-data-year-description').html(NullOrEmptyString(info.project.airport.som_projects_airport_data_year,null,false));    
    $('.airport-modal .airport-version-date-description').html(NullOrEmptyString(info.project.airport.som_projects_airport_version_date,null,false));    
    
    $('.airport-modal .top-1 .top-value').html(NullOrEmptyString(info.project.airport.top1_airline_percentage,'%',false));
    $('.airport-modal .top-1 .top-airline').html(NullOrEmptyString(info.project.airport.top1_airline,null,true));
    $('.airport-modal .top-1 .green-chart').addClass('p'+NullOrEmptyString(Math.round(info.project.airport.top1_airline_percentage),null,false));
        
    $('.airport-modal .top-2 .top-value').html(NullOrEmptyString(info.project.airport.top2_airline_percentage,'%',false));
    $('.airport-modal .top-2 .top-airline').html(NullOrEmptyString(info.project.airport.top2_airline,null,true));
    $('.airport-modal .top-2 .green-chart').addClass('p'+NullOrEmptyString(Math.round(info.project.airport.top2_airline_percentage),null,false));
    
    $('.airport-modal .top-3 .top-value').html(NullOrEmptyString(info.project.airport.top3_airline_percentage,'%',false));
    $('.airport-modal .top-3 .top-airline').html(NullOrEmptyString(info.project.airport.top3_airline,null,true));    
    $('.airport-modal .top-3 .green-chart').addClass('p'+NullOrEmptyString(Math.round(info.project.airport.top3_airline_percentage),null,false));
    
}


/**
 * Refresca multi-airport data
 * @param {Objeto con la info del proyecto} info 
 */
function loadMultiAirportSheet(action) {
    //multiAirportData
    //multiAirportIndex

    $('.airport-modal .modal-min').css("transition", "200ms -webkit-filter linear");
    $('.airport-modal .modal-min').css("filter", "blur(6px)");
    
    var last = multiAirportData.length-1;
    var first = 0;
    if (action < 0){
        if (multiAirportIndex==first){
            multiAirportIndex=last;
        }else{
            multiAirportIndex--;
        }
    }else if (action >0){
        if (multiAirportIndex==last){
            multiAirportIndex=first;
        }else{
            multiAirportIndex++;
        }
    }else{
        multiAirportIndex = first;
    }

    setTimeout(function(){ 
         //MODAL DATA 1
        $('.airport-modal .airport-name').html(NullOrEmptyString(multiAirportData[multiAirportIndex].name,null,false));
        $('.airport-modal .airport-iata-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].iata_oaci,null,true));
        $('.airport-modal .airport-country-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].country,null,true));

        
        $('.airport .show-image, .airport-modal .image-container img').attr('src',multiAirportData[multiAirportIndex].som_projects_airport_img_url);

        $('.airport-modal .airport-type-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].airport_type,null,true));
        $('.airport-modal .airport-size-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].size,' M Pax',false));
        $('.airport-modal .airport-ebitda-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].EBITDA,' MN €',true));

        $('.airport-modal .airport-aero-revenues-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].revenues_aeronautical,' MN €',true));
        $('.airport-modal .airport-non-aero-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].revenues_non_aeronautical,' MN €',true));
        $('.airport-modal .airport-total-revenues-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].total_revenues,' MN €',true));
        $('.airport-modal .airport-total-opex-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].total_opex,' MN €',true));

        $('.airport-modal .airport-kpis-revenues-aeronautical').html(NullOrEmptyString(multiAirportData[multiAirportIndex].kpi_revenues_aeronautical,' €/PAX',true));
        $('.airport-modal .airport-kpis-revenues-non-aeronautical-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].kpi_revenues_non_aeronautical,' €/PAX',true));
        $('.airport-modal .airport-kpis-ebitda-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].kpi_ebitda,'  €/PAX',true));
        $('.airport-modal .airport-kpis-debt-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].debt_ebitda," x",true));
        //MODAL DATA 2
        $('.airport-modal .airport-international-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].percentage_international,' %',true));
        $('.airport-modal .airport-transfer-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].percentage_transfer,' %',true));
        $('.airport-modal .airport-non-low-cost-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].percentage_non_low_cost,' %',true));    
        $('.airport-modal .airport-competitors-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].competitors,null,false));
        $('.airport-modal .airport-routes-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].route,null,false));
        $('.airport-modal .airport-infra-charact-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].infrastructure_characterization_description,null,false));
        $('.airport-modal .airport-catchment-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].airport_catchment_area,null,false));
        $('.airport-modal .airport-master-plan-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].master_plan_estimations,null,false));
        $('.airport-modal .airport-society-model-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].society_model_regulation,null,false));
        $('.airport-modal .airport-aenas-network-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].aena_network_improvement,null,false));    

        $('.airport-modal .airport-other-info-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].som_projects_airport_other_info,null,false));    
        $('.airport-modal .airport-data-year-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].som_projects_airport_data_year,null,false));    
        $('.airport-modal .airport-version-date-description').html(NullOrEmptyString(multiAirportData[multiAirportIndex].som_projects_airport_version_date,null,false));    
        
        $('.green-chart').each(function(element){
            var lista = $(this).attr("class").split(/\s+/);
            for (var i = 0; i < lista.length; i++) {
                if (lista[i].startsWith('p')){
                    $('.green-chart').removeClass(lista[i]);
                    //console.log('removed class: '+lista[i]);
                }
            }
        });
        


        $('.airport-modal .top-1 .top-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].top1_airline_percentage,'%',false));
        $('.airport-modal .top-1 .top-airline').html(NullOrEmptyString(multiAirportData[multiAirportIndex].top1_airline,null,true));
        $('.airport-modal .top-1 .green-chart').addClass('p'+NullOrEmptyString(Math.round(multiAirportData[multiAirportIndex].top1_airline_percentage),null,false));
            
        $('.airport-modal .top-2 .top-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].top2_airline_percentage,'%',false));
        $('.airport-modal .top-2 .top-airline').html(NullOrEmptyString(multiAirportData[multiAirportIndex].top2_airline,null,true));
        $('.airport-modal .top-2 .green-chart').addClass('p'+NullOrEmptyString(Math.round(multiAirportData[multiAirportIndex].top2_airline_percentage),null,false));
        
        $('.airport-modal .top-3 .top-value').html(NullOrEmptyString(multiAirportData[multiAirportIndex].top3_airline_percentage,'%',false));
        $('.airport-modal .top-3 .top-airline').html(NullOrEmptyString(multiAirportData[multiAirportIndex].top3_airline,null,true));    
        $('.airport-modal .top-3 .green-chart').addClass('p'+NullOrEmptyString(Math.round(multiAirportData[multiAirportIndex].top3_airline_percentage),null,false));
        $('.airport-modal .modal-min').css("filter", "blur(0px)");
    
    }, 200);

    
   
}


/**
 * Carga su modal/footer y muestra panel footer 'country sheet'
 * @param {Objeto con la info del proyecto} info 
 */
function loadCountrySheet(info) {
    //FOOTER DATA
    $('.country-data .country-name-flag').html('<img src="https://www.countryflags.io/'+info.project.country.country_code+'/flat/64.png">'+NullOrEmptyString(info.project.country.country,null,false));
    $('.country-data .country-risk').html(NullOrEmptyString(info.project.country.country_risk,null,true));
    $('.country-data .country-aligned').html(NullOrEmptyString(info.project.country.aena_strategy_align,null,true));

    //MODAL DATA    
    $('.country-modal .country-flag').attr('src','https://www.countryflags.io/'+info.project.country.country_code+'/flat/64.png');
    $('.country-modal .country-name').html(NullOrEmptyString(info.project.country.country,null,false));
    $('.country-modal .country-overall-description').html(NullOrEmptyString(info.project.country.description,null,false));
    $('.country-modal .country-tourism-value').html(NullOrEmptyString(info.project.country.tourism_activity,'%',false));
    $('.country-modal .country-aligned-value').html(NullOrEmptyString(info.project.country.aena_strategy_align,null,true));
    $('.country-modal .country-risk-value').html(NullOrEmptyString(info.project.country.country_risk,null,true));
    $('.country-modal .country-exports-imports-value').html(NullOrEmptyString(info.project.country.imports_exports,'BN €',false));

    $('.country-modal .country-version-date-value').html(NullOrEmptyString(info.project.country.version_date,null,false));
    $('.country-modal .country-exchange-rate-value').html(NullOrEmptyString(info.project.country.exchange_rate,null,false));
    
    var rateData = {
        politics:info.project.country.politics,
        regulatory:info.project.country.regulatory,
        corruption:info.project.country.corruption,
        easyBusiness:info.project.country.business_easyness,
        affinity:info.project.country.spain_affinity
    };
    pintaRate('country-risk-list',rateData);    
    

    var yearLabel = [];

    var inflation = [];
    var population = [];    
    var evolution = [];
    
    info.project.country.additional_info.forEach(function( yearInfo){
        yearLabel.push(yearInfo.year);
        inflation.push(parseFloat(yearInfo.inflation));
        population.push(parseFloat(yearInfo.population));
        evolution.push(parseFloat(yearInfo.gpd_evolution));
    });
    
    pintarYearChart('country-inflation-evolution',inflation,yearLabel,false);
    pintarYearChart('pdf-country-inflation-evolution',inflation,yearLabel,true);

    pintarYearChart('country-population-evolution',population,yearLabel,false);
    pintarYearChart('pdf-country-population-evolution',population,yearLabel,true);

    pintarYearChart('country-evolution-evolution',evolution,yearLabel,false);
    pintarYearChart('pdf-country-evolution-evolution',evolution,yearLabel,true);

}
/**
 * Carga su modal/footer y muestra panel footer 'oportunity sheet'
 * @param {Objeto con la info del proyecto} info 
 */
function loadOportunitySheet(info) {
    //FOOTER
    //NullOrEmptyString(,null,false)
    $('.oportunity-data .oportunity-name, .oportunity-modal .oportunity-name').html(NullOrEmptyString(info.project.som_projects_name,null,false));
    $('.oportunity-data .oportunity-status, .oportunity-modal .oportunity-status-value').html(NullOrEmptyString(info.project.som_project_status_name,null,true));

    $('.oportunity-data .oportunity-transaction, .oportunity-modal .oportunity-process-value').html(NullOrEmptyString(info.project.som_projects_process_type,null,true));
    $('.oportunity-data .oportunity-ev, .oportunity-modal .oportunity-ev-value').html(NullOrEmptyString(info.project.som_projects_ev,null,true));
    $('.oportunity-data .oportunity-duration, .oportunity-modal .oportunity-duration-value').html(NullOrEmptyString(info.project.som_projects_duration,null,true));
    $('.oportunity-data .oportunity-responsability, .oportunity-modal .oportunity-responsability-value').html(NullOrEmptyString(info.project.som_projects_responsibility,null,true));
    //MODAL
    
    
    $('.oportunity .show-image, .oportunity-modal .image-container img').attr('src',info.project.som_projects_img_url);
    $('.oportunity-modal .oportunity-deal-description').html(NullOrEmptyString(info.project.som_projects_sub_name,null,false));
    $('.oportunity-modal .oportunity-clientgrantor-value').html(NullOrEmptyString(info.project.som_projects_grantor,null,false));
    $('.oportunity-modal .oportunity-asset-value').html(NullOrEmptyString(info.project.som_projects_asset_type,null,false));
    $('.oportunity-modal .oportunity-transaction-value').html(NullOrEmptyString(info.project.som_projects_transaction_type,null,false));
    $('.oportunity-modal .oportunity-contract-value').html(NullOrEmptyString(info.project.som_projects_contract_scope,null,false));
    $('.oportunity-modal .oportunity-deal-rational-value').html(NullOrEmptyString(info.project.som_projects_deal_rational,null,false));
    $('.oportunity-modal .oportunity-requeriments-description').html(NullOrEmptyString(info.project.som_projects_other_requeriments,null,false));
    $('.oportunity-modal .oportunity-equity-value').html(NullOrEmptyString(info.project.som_projects_equity,'M €',false));
    $('.oportunity-modal .oportunity-participation-value').html(NullOrEmptyString(info.project.som_projects_percentage_participation,'%',false));
    $('.oportunity-modal .oportunity-valuation-value').html(NullOrEmptyString(info.project.som_projects_valuation,'M €',false));
    $('.oportunity-modal .oportunity-solvency-value').html(NullOrEmptyString(info.project.som_projects_solvency,null,false));
    $('.oportunity-modal .oportunity-bid-presentation-value').html(NullOrEmptyString(info.project.som_projects_bid_presentation_date,null,false));
    $('.oportunity-modal .oportunity-start-execution-value').html(NullOrEmptyString(info.project.som_projects_concession_date_start,null,false));
    $('.oportunity-modal .oportunity-concession-value').html(NullOrEmptyString(info.project.som_projects_pr_length,null,false));
    //process_time
}

function ifNull(value){
    return (value!=null && value!="")?value:'-';
}

/**
 * Carga su modal/footer y muestra panel footer 'current phase'
 * @param {Objeto con la info del proyecto} info 
 */
function loadActualPhase(info) {
    $('.carouselPhasesModal').html('');
    var lastOngoingPhase;
    var firstPhase;
    info.project.phases.forEach(function(phase){//.forEach(phase => {
        //Nos quedamos con la primera fase
        if (firstPhase==null){
            firstPhase = phase;
        }
        //Nos quedamos con la última en curso
        if (phase.som_status_is_behaviour_ongoing==1){
            lastOngoingPhase = phase;
        }
    });
    //Si no hay en curso, nos quedamos con la primera
    if (lastOngoingPhase==null){
        lastOngoingPhase = firstPhase;
    }
    //La pintamos como la actual
    if (lastOngoingPhase!=null){
        $('.som_phases_name').text(lastOngoingPhase.som_phases_name);
        var chartNumber = lastOngoingPhase.formscompletedcount+'/'+lastOngoingPhase.formscount;
        $('.number_milestones').removeClass('4char').removeClass('5char');

        if (chartNumber.length==4){
            $('.number_milestones').addClass('4char');
        }else if (chartNumber.length==5){
            $('.number_milestones').addClass('5char');
        }

        $('.number_milestones').text(chartNumber);
        showPhaseChart(lastOngoingPhase,'phase-progress');
        /*
        var notstarted=0;
        var notstartedColor="#FFFFFF";
        var execution=0;
        var executionColor="#FFEF00";            
        var finished=0;
        var finishedColor="#71B553";            
        lastOngoingPhase.milestones.forEach(miles => {
            if (miles.som_status_is_behaviour_ongoing==1){
                execution++;
                executionColor = miles.som_status_hex_color;
            }else if (miles.som_status_is_behaviour_completed==1){
                finished++;
                finishedColor = miles.som_status_hex_color;
            }else if (miles.som_status_is_behaviour_ongoing==0 && miles.som_status_is_behaviour_completed==0){
                notstarted++;
                //notstartedColor = miles.som_status_hex_color;
            }
        });
        pintarChart('phase-progress',
            [                      
                ['Not Started', notstarted],
                ['Execution', execution],
                ['Completed', finished]
            ],
            [                      
                notstartedColor,
                executionColor,
                finishedColor
            ]
        );
        */
    }

    var htmlCarouselPhasesModal = "";
    var first = false;
    
    info.project.phases.forEach(function(phase){//.forEach(phase => {
        first = (phase == lastOngoingPhase);
        var htmlPhaseModal =         
        "<div class=\"carousel-item "+(first?"active":"")+"\">"+
        "   <div class=\"row\">"+
        "       <div class=\"col-8 offset-4 title\">"+phase.som_phases_name+"</div>"+
        "   </div>"+
        "    <div class=\"row\">"+
        "        <div class=\"col-3 offset-1 phase-stats\">"+
        "           <div class=\"phase-progress-"+phase.som_phases_id+"\"></div>"+
        "           <span class=\"chart-number\">"+phase.formscompletedcount+'/'+phase.formscount+"</span>"+
        "        </div>"+
        "        <div class=\"col-8 phase-stats\">";

        //greenText - yellowText - redText
        phase.milestones.forEach(function(miles){//.forEach(miles => {

            miles.form.forEach(function(form){//.forEach(form => {
                htmlPhaseModal+=
                "            <div style=\"color:"+form.som_status_hex_color+"\">"+
                "                <i class=\"far fa-circle\" aria-hidden=\"true\"></i> "+form.som_forms_name+"</div>";
            });
        });

        htmlPhaseModal +=
        "        </div>"+
        "    </div>"+
        "</div>";
        first = false;
        $('.carouselPhasesModal').append(htmlPhaseModal);

        showPhaseChart(phase,'phase-progress-'+phase.som_phases_id);
    });
}

/**
 * Carga el gráfico de la phase sobre el container
 * @param {*} phase 
 * @param {*} containerClass 
 */
function showPhaseChart(phase, containerClass){
    var finished = phase.formscompletedcount;
    var execution = phase.formsongoingcount;
    var notstarted = phase.formscount-(execution+finished);
    
    
    var notstartedColor="#FFFFFF";
    var executionColor="#FFEF00";            
    var finishedColor="#71B553";            
    phase.milestones.forEach(function(miles){//.forEach(miles => {
        miles.form.forEach(function(form){//.forEach(form => {
            if (form.som_status_is_behaviour_ongoing==1){
                executionColor = form.som_status_hex_color;
            }else if (form.som_status_is_behaviour_completed==1){
                finishedColor = form.som_status_hex_color;
            }else if (form.som_status_is_behaviour_ongoing==0 && form.som_status_is_behaviour_completed==0){
                notstartedColor = form.som_status_hex_color;
            }
        });
    });
    pintarChart(containerClass,
        [                      
            ['Not Started', notstarted],
            ['Execution', execution],
            ['Completed', finished]
        ],
        [                      
            notstartedColor,
            executionColor,
            finishedColor
        ]
    );        
}

/**
 * Carga su modal/footer y muestra panel footer 'organizational chart'
 * @param {Objeto con la info del proyecto} info 
 */
function loadProjectTeam(info) {
    //carousel
    var users = "";
    var team = "";
    var first = true;
    info.project.users.forEach(function(user){//.forEach(user => {
        users += '<div class="carousel-item ' + (first ? 'active' : '') + '">' +
            //'<div class="slide-avatar-icon" style="background-image: url(\''+user.userphoto+'\');"></div>'+
            '<img class="d-block img-fluid slide-avatar-icon" src="' + user.cms_users_photo + '" onerror="this.onerror=null;this.src=\'images/icons/default-avatar.png\';">' +
            '<span class="slide-avatar-name">' + user.cms_users_name + '</span>' +
            '<span class="slide-avatar-charge">'+((user.cms_users_job_title!=null)?user.cms_users_job_title:'') +'</span>'+
            '</div>';

        team += '<div class="team-unit">' +
            '<div class="row">' +
            '<div class="col-2 photo"><!--<div style="background-image: url(\''+user.cms_users_photo+'\');"></div>--><img src="' + user.cms_users_photo + '" onerror="this.onerror=null;this.src=\'images/icons/default-avatar.png\';"></img></div>' +
            '<div class="col-10 name-role">' +
            '<div class="name"><span>' + user.cms_users_name + '</span></div>' +
            ((user.cms_users_job_title!=null)?('<div class="role"><span>' + user.cms_users_job_title + '</span></div>'):'') +
            '</div>' +
            '</div>' +
            '</div>';
        first = false;
    });
    $('#carouselExampleControlsDesktop .carousel-inner, #carouselExampleControlsMobile .carousel-inner').html(users);
    $('.team-scroll').html(team);
}

/**
 * Carga modal 'mapa de decisiones'
 * @param {Objeto con la info del proyecto} info 
 */
function loadPhaseMap(info) {



    //MILESTONE TIMELINE
    $('.dynamic-progress .progress').html(getTimeLine(info.project));
    $('.dynamic-progress .progress').append(getMilestones(info.project));

    //ACORTAMOS LITERALES EN EL TIMELINE DEL FOOTER
    var elementSet = $('.footer .phase-progress-bar .phase-title')
    var length = elementSet.length;
    elementSet.each(function(index, element) {
        if (index != (length - 1)) {
            var text = $(this).html();
            text = text.split(' ')[1];
            $(this).html(text);
        }
    });
    
    //PHASE NAMES BOXES
    $('.fullScreen.projects-modal>.dynamic-milestone').html(getPhasesRow(info.project.phases));
    //FORMS BOXES
    $('.fullScreen.projects-modal>.dynamic-milestone').append(getFormsRow(info.project.phases));
    //$('.fullScreen.projects-modal').append("<div class=\"middle-button left close-projects-modal\"></div>");
    //Move forms across map
    var rows = $('.dynamic-milestone>.row').length;
    $('.empty_row').each(function(index, element) {
        var cellPosition =  $(this).data('cell');
        var phase = cellPosition.split('_')[0];
        var row = cellPosition.split('_')[1];
        for(i=row; i<rows; i++){
            //console.log('row:'+row+',phase:'+phase+', i:'+i);
            var current = $('*[data-cell="'+phase+'_'+i+'"]');
            var next = $('*[data-cell="'+phase+'_'+(parseInt(i)+1)+'"]').clone();
            next.addClass('moved')
            //next.data('cell',row+'_'+i);
            if (next.length>0){
                current.replaceWith(next);
            }else if (current.length>0){
                current.remove();
            }
            $('.moved').removeData('cell');            
            $('.moved').removeAttr('data-cell');
            //$('*[data-cell="'+phase+'_'+(parseInt(i)+1)+'"]').data('cell',row+'-'+i);

        }
    });
}

/**
 * Pinta milestones en 'mapa de decisiones'
 * @param {*} project 
 */
function getMilestones(project){
    
    var ends = null;

    //CONF EN BASE AL TIPO DE PROYECTO
    var layout = document.body.dataset.layout;
    
    ends = [0,20,40,60,80,100];
    // if(layout=='cons'){
    //     ends = [0,19.7,39.4,49.25,68.95,78.8,100];
    //     //ends = [0,19.7,39.4,49.25,88.65,100];
    // }else{
    //     ends = [0,19.7,70.2,100];
    // }


    var timeProgress = "";
    var nFase = 0;
    var leftWidth = 0;
    
    project.phases.forEach(function(phase){//.forEach(phase => {
        //var filteredMilestones = phase.milestones.filter(milestone => milestone.som_phases_milestones_is_hidden != 1);
        var filteredMilestones = new Array();
        phase.milestones.forEach(function(milestone){
            if (milestone.som_phases_milestones_is_hidden != 1){
                filteredMilestones.push(milestone);
            }
        });
        

        if(filteredMilestones.length>0){

            var milesWidth = (ends[nFase+1]-ends[nFase])/filteredMilestones.length;
        
            var miles = 1;
            filteredMilestones.forEach(function(milestone){//.forEach(milestone => {
            //phase.milestones.forEach(milestone => {
                leftWidth += milesWidth;
                timeProgress += 
                    "<div class=\"phase-check\" style=\"left:"+leftWidth+"%;\">"+
                    "    <div class=\"phase-title\">"+milestone.som_phases_milestones_name+"</div>"+
                    //"    <div class=\"phase-status green\" style=\"background-color: "+milestone.som_status_hex_color+" !important;\"></div><span class=\"duedate\">"+ parseShortDate(milestone.som_phases_milestones_due_date)+"</span>"+
                    "    <div class=\"phase-status green\" style=\"background-color: "+milestone.som_status_hex_color+" !important;\"></div><span class=\"duedate\"></span>"+
                    "</div>";
                
                //<div class=\"progress-bar\" data-id=\""+phase.som_phases_id+"-"+miles+"-"+phase.milestones.length+"\" role=\"progressbar\" style=\"width:"+(milesWidth/*(miles)*/)+"%;background-color:"+milestone.som_status_hex_color+"\"></div>";
                miles++;
            })

        }
        else{
            //Si no tengo milestones visibles
            var milesWidth = (ends[nFase+1]-ends[nFase]);
            leftWidth += milesWidth;
            timeProgress += 
            "<div class=\"phase-check\" style=\"left:"+leftWidth+"%;\">"+
            "</div>";

        }
       
        nFase++;
    });
    return timeProgress;
}

/**
 * Pinta timeline en 'mapa de decisiones'
 * @param {*} project 
 */
function getTimeLine(project){
    //0 - 19.7 -Primera fase
    //19.7 - 70.2 -Segunda fase
    //70.2 - 100 -Tercera fase
    //CONF EN BASE AL TIPO DE PROYECTO
    var layout = document.body.dataset.layout;
           
    ends = [
        0,
        20,
        40,
        60,
        80,
        100
    ];


    // if(layout=='cons'){
    //     //ends = [0,19.7,39.4,49.25,68.95,88.65,100];
    //     //ends = [0,19.7,39.4,49.25,68.95,100];
    //     ends = [0,19.7,39.4,49.25,68.95,78.8,100];
    // }else{
    //     ends = [0,19.7,70.2,100];
    // }

    var timeProgress = "";
    var classStatus = ["progress-bar-success","progress-bar-warning","progress-bar-danger"]
    var nFase = 0;
    var totalWidthDebug = 0;
    project.phases.forEach(function(phase){//forEach(phase => {
        //var filteredMilestones = phase.milestones.filter(milestone => milestone.som_phases_milestones_is_hidden != 1);

        var filteredMilestones = new Array();
        phase.milestones.forEach(function(milestone){
            if (milestone.som_phases_milestones_is_hidden != 1){
                filteredMilestones.push(milestone);
            }
        });

        if(filteredMilestones.length>0){
            var milesWidth = (ends[nFase+1]-ends[nFase])/filteredMilestones.length;
            
            //var milesWidth = (ends[nFase+1]-ends[nFase])/phase.milestones.length;
            var miles = 1;
            filteredMilestones.forEach(function(milestone){//.forEach(milestone => {
            //phase.milestones.forEach(milestone => {
                timeProgress += "<div class=\"progress-bar\" data-id=\""+phase.som_phases_id+"-"+miles+"-"+phase.milestones.length+"\" role=\"progressbar\" style=\"width:"+(milesWidth/*(miles)*/)+"%;background-color:"+milestone.som_status_hex_color+"\"></div>";
                miles++;
                totalWidthDebug += milesWidth;                
            })
        }else{
            //Si no tengo milestones visibles
            var milesWidth = (ends[nFase+1]-ends[nFase]);
            timeProgress += "<div class=\"progress-bar\" data-id=\""+phase.som_phases_id+"-"+miles+"-"+phase.milestones.length+"\" role=\"progressbar\" style=\"width:"+(milesWidth/*(miles)*/)+"%;background-color:#FFFFFF\"></div>";
        }

        
        nFase++;
    });
    return timeProgress;
    //TODO poner fecha en timeline
    /*
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:40%"></div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:10%"></div>
    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:20%"></div>
    <div class="today" style="left: 10%;"></div>
    */
}

/**
 * Pinta forms en 'mapa de decisiones'
 * @param {*} phases 
 */
function getFormsRow(phases) {

    var classCol = null;

    //TODO CAMBIAR ESTO EN BASE AL TIPO DE PROYECTO
    var layout = document.body.dataset.layout;
    
    // if(layout=='cons'){
    //     classCol = ['offset-1 col-2','col-2', 'col-1', 'col-2','col-1', 'col-2'];
    // }else{
    //     classCol = ['offset-1 col-2','col-5','col-3'];
    // }
    classCol = ['offset-1 col-2','col-2','col-2','col-2','col-2'];

    var classColSelection = ['offset-1 col-4','col-3','col-3'];

    var formrow = "";

    var moreRows = true;
    var row = 0;
    var maxRow = 0;
    var form = 0;
    var maxForm = 0;
    var selectionHtml = "";
    var ricHtml = "";
    var cierreHtml = "";
    var hasData = false;    
    while (moreRows) {
        moreRows=false;
        hasData = false;  
        var legal_finance_flag_template = "<span class='legal-or-finance-flag'><span class='showOnHover'>#title#</span></span>";
        var formrow_temp = "<div class=\"row nomargin-side nopadding-side\">";
        var i = 0;
        phases.forEach(function(phase){//forEach(phase => {  
                  
            if (phase.milestones[row]!=null && phase.milestones[row].form[form]!=null){
                if (maxForm < phase.milestones[row].form.length){
                    maxForm = phase.milestones[row].form.length;
                }
                if (maxRow < phase.milestones.length){
                    maxRow = phase.milestones.length;
                }                                

                var def_legal_finance_flag_template = '';
                if (phase.milestones[row].form[form].is_legal_finance){
                    def_legal_finance_flag_template = legal_finance_flag_template;
                    def_legal_finance_flag_template = def_legal_finance_flag_template.replace(/#title#/g,phase.milestones[row].form[form].user_department_related);
                }

                var isFormDisabled = phase.milestones[row].form[form].is_inactive==1;

                if (phase.milestones[row].form[form].som_milestones_forms_types_name=='selection'){
                    selectionHtml += "<div class=\"row nomargin-side nopadding-side\">";
                    
                    if (isFormDisabled){
                        selectionHtml += "<div class=\"milestone-unit is-inactive offset-1 col-8\"><div><span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }else{
                        selectionHtml += "<div onclick=\"goForm("+phase.milestones[row].form[form].som_forms_id+");\" class=\"milestone-unit offset-1 col-8\" style=\"border-color: "+phase.milestones[row].form[form].som_status_hex_color+"\"><div>"+def_legal_finance_flag_template+"<span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }
                    
                     selectionHtml += "</div>";
                    formrow_temp +="<div data-cell='"+i+"_"+row+"' class=\"empty_row "+classCol[i++]+"\"><span></span></div>";
                    
                } else if (phase.milestones[row].form[form].som_milestones_forms_types_name=='ric'){
                    ricHtml += "<div class=\"row nomargin-side nopadding-side\">";
                    
                    if (isFormDisabled){
                        ricHtml += "<div class=\"milestone-unit is-inactive offset-1 col-10\"><div><span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }else{
                        ricHtml += "<div onclick=\"goForm("+phase.milestones[row].form[form].som_forms_id+");\" class=\"milestone-unit offset-1 col-10\" style=\"border-color: "+phase.milestones[row].form[form].som_status_hex_color+"\"><div>"+def_legal_finance_flag_template+"<span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }
                    
                     ricHtml += "</div>";
                    formrow_temp +="<div data-cell='"+i+"_"+row+"' class=\"empty_row "+classCol[i++]+"\"><span></span></div>";

                } else if (phase.milestones[row].form[form].som_milestones_forms_types_name=='cierre_financiero'){
                    cierreHtml += "<div class=\"row nomargin-side nopadding-side\">";
                    
                    if (isFormDisabled){
                        cierreHtml += "<div class=\"milestone-unit is-inactive offset-7 col-4\"><div><span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }else{
                        cierreHtml += "<div onclick=\"goForm("+phase.milestones[row].form[form].som_forms_id+");\" class=\"milestone-unit offset-7 col-4\" style=\"border-color: "+phase.milestones[row].form[form].som_status_hex_color+"\"><div>"+def_legal_finance_flag_template+"<span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }
                    
                    cierreHtml += "</div>";
                    formrow_temp +="<div data-cell='"+i+"_"+row+"' class=\"empty_row "+classCol[i++]+"\"><span></span></div>";
                                        

                }else{
                    hasData = true;
                    if (isFormDisabled){
                        formrow_temp +="<div data-cell='"+i+"_"+row+"' class=\"milestone-unit is-inactive "+classCol[i++]+"\"><div><span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }else{
                        formrow_temp +="<div data-cell='"+i+"_"+row+"' onclick=\"goForm("+phase.milestones[row].form[form].som_forms_id+");\" class=\"milestone-unit "+classCol[i++]+"\" style=\"border-color: "+phase.milestones[row].form[form].som_status_hex_color+"\"><div>"+def_legal_finance_flag_template+"<span>"+phase.milestones[row].form[form].som_forms_name+"</span></div></div>";
                    }
                }
                
                moreRows = true;
            }else{
                formrow_temp +="<div data-cell='"+i+"_"+row+"' class=\""+classCol[i++]+"\"><span></span></div>";
                if (row<maxRow){
                    moreRows=true;
                }
            }
        });
        formrow_temp +="</div>";

        if (moreRows){
            if (hasData){
                formrow += formrow_temp;
            }
            row++;                
        }
        if (form<maxForm){
            row--;
            form++;
        }else{
            form = 0;
            maxForm = 0;
        }
    }
    return formrow+cierreHtml+selectionHtml+ricHtml;
}

/**
 * Pinta phases en 'mapa de decisiones'
 * @param {*} phases 
 */
function getPhasesRow(phases){
    

    var classCol = null;

    //TODO CAMBIAR ESTO EN BASE AL TIPO DE PROYECTO
    var layout = document.body.dataset.layout;
    
    // if(layout=='cons'){
    //     classCol = ['offset-1 col-2','col-2', 'col-1', 'col-2','col-1', 'col-2'];
    // }else{
    //     classCol = ['offset-1 col-2','col-5','col-3'];
    // }
    classCol = ['offset-1 col-2','col-2','col-2','col-2','col-2'];         

    //var classCol = ['offset-1 col-2','col-5','col-3'];
    var phaserow = "<div class=\"row nomargin-side nopadding-side\">";
    var i = 0;
    phases.forEach(function(phase){//.forEach(phase => {
        var is_inactive = phase.is_inactive==1?" is-inactive":" is-active";
        phaserow +="<div class=\"phase-name "+classCol[i++]+is_inactive+"\"><span>"+phase.som_phases_name+"</span></div>";
    });
    phaserow +="</div>";
    return phaserow;
}


/**
 * Obtiene la fecha actual en formato dd/mm/yyyy
 */
function getCurrentDateString(){
    var d = new Date();

    function pad(s) { return (s < 10) ? '0' + s : s; }

    return [pad(d.getDate()) , pad(d.getMonth()+1), d.getFullYear()].join('/');
}

/**
 * Lógica toggles en forms
 * Por defecto los elementos se muestran desactivados.
 * Este JS activa sólo los elementos dentro de una seccion en concreto (tasks or approvals)
 */
function switchesForm(element, reload, showModal) {


    element.find('.circle-ok, .circle-review, .circle-cancel, .circle-na, .circle-done').css('cursor','pointer');
    element.find('.circle-ok.disabled, .circle-review.disabled, .circle-cancel.disabled, .circle-na.disabled, .circle-done.disabled').css('cursor','no-drop');

    element.find('.circle-ok, .circle-review, .circle-cancel, .circle-na, .circle-done').click(function () {
        
        switchElem=$(this);

        //Si esta desactivado no hacemos nada
        if (!switchElem.hasClass('disabled')) {

            //Si mostramos modal de confirmacion
            if(showModal && showApprovalDialog()){

                $("#modal-btn-si").unbind( "click" );
                $("#modal-btn-no").unbind( "click" );


                $("#approval-confirm").modal('show');

                $("#modal-btn-si").on("click", function(){
                    $("#approval-confirm").modal('hide');
                    //Añadimos logica al pulsar el boton ok del modal
                    changeSwitchs(switchElem, reload);
                });

                $("#modal-btn-no").on("click", function(){
                    $("#approval-confirm").modal('hide');
                });
                

            }else{
                changeSwitchs(switchElem, reload);
            }
        }
        RefreshTaskProgressBar();
    });
}

function RefreshTaskProgressBar()
{
    $(".task-order").each(function(indes,el){
        var parentId=el.closest(".task-header").id;

        var subTasks= $("[data-parent='" + parentId + "']");
        var totalSubTasks=subTasks.length;
        var subTasksDone=0;
        
        subTasks.each(function(indes,el){
            if(el.value==1)
            subTasksDone++;
        });

        var tpb = $("#tbp_" + parentId);

        var percentage=totalSubTasks==0?0:Math.round(subTasksDone*100/totalSubTasks);
        tpb.width(percentage + "%");
        tpb.html(percentage + "%");
        tpb.attr('aria-valuenow', percentage)

    }); 


    // var nCircles = $(".circle-done").length;
    // var circlesDone=0;
    // $("[name='done_']").each(function(indes,el){
    //     if(el.value==1)
    //         circlesDone++;
    // });
    // var tpb = $(".task-progress-bar");

    // var percentage=nCircles==0?0:Math.round(circlesDone*100/nCircles);
    // tpb.width(percentage + "%");
    // tpb.html(percentage + "%");

}

function RefreshElementSummary(id, status)
{
    if(id!=null)
    {
        var circle_ok = $('#e_ok_' + id);
        var circle_cancel = $('#e_cancel_' + id);
        if(status)
        {
            circle_ok.removeClass("hide")
            circle_cancel.addClass("hide");
            
        }
        else
        {
            circle_ok.addClass("hide");
            circle_cancel.removeClass("hide");
        }
    }
    

    //only the mandatoiry fields displayed

    var mandatories = $('.mandatory-field[style*="display:"]');
    var nMandatories = mandatories.length;

    var mandatoriesDone=$('.blueicon.mandatory').length;
    var mandatoriesDone2=$('.blueicon.disabled.mandatory').length 

   var epb = $(".elements-progress-bar");
    //var percentage=(mandatoriesDone-mandatoriesDone2)*100/nMandatories;

    var percentage=nMandatories==0?0:Math.round((mandatoriesDone-mandatoriesDone2)*100/nMandatories);
    epb.width(percentage + "%");
    epb.html(percentage + "%");

}

function RefreshApprovalSummary(id, status)
{
    if(id!=null)
    {
        var shc = $('#shc_a_' + id);
        if(status)
        {
            shc.find(".circle-ok").addClass("active");
            shc.find(".circle-cancel").removeClass("active");
        }
        else
        {
            shc.find(".circle-ok").removeClass("active");
            shc.find(".circle-cancel").addClass("active");
        }
    }
         //only the mandatoiry fields displayed
        
    var approvals = $("div[id^=approval_]");

    //divide by 2 because we have upload and download for the same approval
    var approvalsWithNoDoc=approvals.find(".blueicon.disabled").length/2;

    var epb = $(".approvals-progress-bar");
    //var percentage=(approvals.length-approvalsWithNoDoc)*100/approvals.length;
    var percentage=approvals.length==0?0:Math.round((approvals.length-approvalsWithNoDoc)*100/approvals.length);
    epb.width(percentage + "%");
    epb.html(percentage + "%");
}


function changeSwitchs(switchElem, reload){
    if (!switchElem.hasClass('disabled')) {
             
        //comprobamos si el estado previo es activo o inactivo
        if (switchElem.hasClass('active')) {
            // estado previo activo -> desactivamos
            switchElem.closest('.task-swich').find("[name='ok_'], [name='review_'], [name='cancel_'], [name='na_'], [name='done_']").val(0);
            switchElem.closest('.task-swich').find(".active").removeClass('active');
            
            switchElem.closest(".row").find(".taskDate").text("");
            if(reload){
                loadingShow();
                idApp=switchElem.closest('.approvalHeader').attr("id");
                //RefreshApprovalSummary(idApp,false);
                dataSubmit(switchElem.closest("form")[0], true, "#"+idApp);
            }else{
                dataSubmit(switchElem.closest("form")[0], false, null);
            }   
        } else {
            // estado previo inactivo -> activamos
            // eliminamos la clase active de todos los controles del grupo y ponemos a 0 (false) los inputs
            switchElem.closest('.task-swich').find("[name='ok_'], [name='review_'], [name='cancel_'], [name='na_'], [name='done_']").val(0);
            switchElem.closest('.task-swich').find(".active").removeClass('active');
            // añadimos la clase active al control
            switchElem.addClass('active');
            // seteamos a 1 (true) el input
            if (switchElem.hasClass('circle-ok')) {
                switchElem.closest('.task-swich').find("[name='ok_']").val(1);
            } else if (switchElem.hasClass('circle-review')) {
                switchElem.closest('.task-swich').find("[name='review_']").val(1);
            } else if (switchElem.hasClass('circle-cancel')) {
                switchElem.closest('.task-swich').find("[name='cancel_']").val(1);
            } else if (switchElem.hasClass('circle-na')) {
                switchElem.closest('.task-swich').find("[name='na_']").val(1);
            } else if (switchElem.hasClass('circle-done')) {
                switchElem.closest('.task-swich').find("[name='done_']").val(1);
            }

            switchElem.closest(".row").find(".taskDate").text(getCurrentDateString());

            if(reload){
                loadingShow();
                idApp=switchElem.closest('.approvalHeader').attr("id");
                //RefreshApprovalSummary(idApp,true);
                dataSubmit(switchElem.closest("form")[0], true, "#"+idApp);
            }else{
                dataSubmit(switchElem.closest("form")[0], false, null);
            }

        }

    }
}


/**
 * Envia forms via ajax
 * @param {*} form 
 * @param {*} reload 
 */
function dataSubmit(form, reload, link) {
 
    return $.ajax({ // create an AJAX call...
        //data: $(form).serialize(), // get the form data
        data: new FormData(form), // get the form data
        contentType: false,
        processData: false,
        type: $(form).attr('method'), // GET or POST
        url: $(form).attr('action'), // url
        success: function (response) { // on success..
            if(reload==true){
                url = window.location.href;

                var ini = url.indexOf('#') ; 

                if(ini>-1){
                    url = url.slice(0, ini)
                }
                
                window.location.href= url + link;
                location.reload();
            }
            //$('#here').html(response); // update the DIV
        }
    });
}

function parseNumber(number){
    return Number.parseInt(number, 10);
}

function getQty(number){
    var numberParsed = parseNumber(number);
    if (numberParsed!=null && !isNaN(numberParsed)){
        return numberParsed+" "+currency;
    }else{
        return '-';
    }
}

function getQtyHtml(number){
    var numberParsed = parseNumber(number);
    if (numberParsed!=null && !isNaN(numberParsed)){
        return "<span class=\"amount\">"+numberParsed+"</span><span class=\"million-currency\">"+currency+"</span>";
    }else{
        return '-';
    }
}

function getQtyDecimalHtml(number){
    var numberParsed = parseFloat(number).toFixed(1);
    if (numberParsed!=null && !isNaN(numberParsed)){
        return "<span class=\"amount\">"+numberParsed+"</span><span class=\"million-currency\">"+currency+"</span>";
    }else{
        return '-';
    }
}


function unloadProject(){
    if (loadedProject){
        loadedProject = false;
        multiAirportData = [];
        timeOffset = null;
        cityOffset = null;
        refreshClock();
        $('#timestamp').css('bottom','4%');
        $('.footer').removeClass('fadeOutDown').addClass('fadeOutDown');
        $('.footer2').removeClass('fadeOutDown').addClass('fadeOutDown');
        $('.middle-button').addClass('hide');
        $('#goRight').hide();
        $('#goLeft').hide();
        $('#currentProject').hide();
        $('#latestNews').removeClass('showing');
        $('#latestNews').find('.btnSidePress .fa-chevron-right').removeClass('fa-chevron-right').addClass('fa-chevron-left');
        $('#currentProject').removeClass('showing');        
        $('#currentProject').find('.fa-chevron-right').removeClass('fa-chevron-right').addClass('fa-chevron-left');         
        $('#currentProject').hide();
        if (!$('#mapFilters').hasClass('hiddenFilters')){
            ShowFilters();
        }
        
    }
}

function showApprovalDialog(){
    showDialog=false;

    //If some Task is inactive show dialog
    $('#task-element-list .switch-container-2').each(function(index, el){
        
        taskInactive=$(el).find(".active").length==0;
        //console.log("taskInactive "+index + ": "+taskInactive);
        if(taskInactive){
            showDialog=true;
        }
    });

    //If some element dont have document show dialog
    if(showDialog==false){

        $('#control-element-list .modalDocElement').each(function(index, el){
            //console.log("element "+index + ": ");

            elementDoc=$(el).find("[name='doc']").val();

            //console.log("element val: "+elementDoc);
            if(elementDoc == null || elementDoc =='' ){
                showDialog=true;
            }
        });

    }

    //If task and elements are not complete
    //check if we have started any approval
    if(showDialog==true){
        
        $('#approval-element-list .task-swich').each(function(index, el){
            //console.log("approval "+index + ": ");

            approvalActive=$(el).find(".active").length>0;

            //console.log("approval active: "+approvalActive);
            if(approvalActive ){
                showDialog=false;
            }
        });

    }
    
    //console.log("showDialog: "+showDialog);

    return showDialog;
}

function initialNewsLoad(){
    var today = new Date();
    loadNews(today);
}

function loadNews(newDate){
    currentNewsDate = dateOfTheFirstWeekDay(newDate);    
    var firstDay = dateToParsedStringForApi(dateOfTheFirstWeekDay(newDate));
    var lastWeekDay = dateToParsedStringForApi(dateOfTheLastWeekDay(newDate));
    $('.news-week-period').html(dateToParsedString(currentNewsDate));
    
    //TODO call news api
    var xhr = new XMLHttpRequest() // create new XMLHttpRequest2 object
    xhr.open('GET', '/api/news?date_from='+firstDay+'&date_until=' + lastWeekDay) // open GET request
    xhr.onload = function () {
        if (xhr.status === 200) { // if Ajax request successful
            var output = JSON.parse(xhr.responseText) // convert returned JSON string to JSON object
            //console.log(output.status) // log API return status for debugging purposes
            if (output.api_status == 'OK') { // if API reports everything was returned successfully
                newsInfo = output.data;
                var newsContent = '';
                newsInfo.news.forEach(function(news){
                    newsContent += '<div class="news-section">';
					newsContent += '<h1 class="news-section-title">'+news.title+'</h1>';
					newsContent += '<p class="news-section-content">'+news.news_description+'</p>';
                    newsContent += '</div>';
                });
                if (newsContent === ''){
                    $('.news-section-container').html('<span class="no-news">There is no news for this week</span>');
                }else{
                    $('.news-section-container').html(newsContent);
                }
               
            } else if (output.api_status == 'KO') {
                alert(output.api_message);
                loadingHide(onBack);
            }
        } else {
            alert('Request failed.  Returned status of ' + xhr.status)
            loadingHide(onBack);
        }
        loadingHide(false);
    }
    xhr.send();// send request
    xhr.onerror= function(){
        alert('Request failed.  Returned status of ' + xhr.status)
        loadingHide(onBack);
    }

}

var month_name = function(dt){
    mlist = [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ];
      return mlist[dt.getMonth()];
    };

function dateOfTheFirstWeekDay(dateTemp){    
    //var strDate = parseDate(str);
    return new Date(dateTemp.setDate(dateTemp.getDate() - (dateTemp.getDay()-1)));
}

function dateOfTheLastWeekDay(dateTemp){    
    var strDate = dateOfTheFirstWeekDay(dateTemp)
    return new Date(strDate.setDate(strDate.getDate() - strDate.getDay()+7));
}

function dateToParsedString(dateStr){
    var dateResult = "";
    dateResult += dateStr.getDate();
    dateResult += " de ";
    dateResult += month_name(dateStr);//.getMonth()+1;
    dateResult += "/";
    dateResult += dateStr.getFullYear();
    return dateResult;
}

function dateToParsedStringForApi(dateStr){
    var dateResult = "";
    dateResult += dateStr.getFullYear();
    dateResult += "-";
    dateResult += dateStr.getMonth()+1;
    dateResult += "-";
    dateResult += dateStr.getDate();
    return dateResult;
}

function previousWeek(){
    loadingShow();
    var newDate = currentNewsDate;
    //console.log(currentNewsDate);
    newDate.setDate(newDate.getDate() - 1 * 7);
    loadNews(newDate);
}

function nextWeek(){
    loadingShow();
    var newDate = currentNewsDate;
    //console.log(currentNewsDate);
    newDate.setDate(newDate.getDate() + 1 * 7);
    loadNews(newDate);
}

function showImage(typeImage){
    $('.'+typeImage+'.image-full-screen').toggleClass('hide');
}
function OpenCloseSecondModal(){
    $('.airport-modal .modal-small, .airport-modal .modal-big').each(function(){
        $(this).toggleClass('hide');
        //console.log($(this));
    })       
}

function layerToggleClass(e,className){    
    $(e).toggleClass(className);
}

function showHideSideItem(e){
    $(e).closest('.sideRightHiddingPanel').toggleClass('showing');
    $(e).find('.fas').toggleClass('fa-chevron-left').toggleClass('fa-chevron-right');
}

function ShowFilters(){
    //console.log('filters');
    $('#mapFilters').toggleClass('hiddenFilters');  
    $('#mapFilters').find('.fas').toggleClass('fa-chevron-left').toggleClass('fa-chevron-right');  
}


/**
 * Invoca el envio de una notificacion para una task y un user
 * @param {*} form 
 * @param {*} reload 
 */
function taskNotificationSubmit(ele, senderId) {

    var form = $('#taskForm_'+ele);
    var dataArray = form.serializeArray();
    var dataObj = {};

    $(dataArray).each(function(i, field){
        dataObj[field.name] = field.value;
      });

    var _taskId         =   dataObj['taskId'];
    var _responsibleId  =   dataObj['responsibleId'];
    var _deadline       =   dataObj['deadline'];

    var dateField=$('#sendTask_'+ele).closest(".row").find(".taskReqDate");
    
    if(_responsibleId==''){
        dateField.text("Please, select a user");
        return true;
    }
        
    dateField.text("Sending...");

    $.ajax({ // create an AJAX call...
        data: {type:"form", taskId:_taskId, receiverUserId:_responsibleId, senderUserId: senderId, deadline:_deadline}, // get the form data
        type: 'GET', // GET or POST
        url: '/api/sendnotifications', // url
        success: function (response) { // on success..
            
            //Check response
            var data = $.parseJSON(response);
            
            if(data != null && data['api_status']=='OK'){
                $('#sendTask_'+ele).removeClass('disabled');
                dateField.removeClass("disabled");
                dateField.text(getCurrentDateString());
            }
            else{
                $('#sendTask_'+ele).addClass('disabled');
                dateField.addClass("disabled");
                dateField.text("Error sending request");    
            }

        },
        error: function (){
            dateField.addClass("disabled");
            dateField.text("Error sending request");
        }
    });
}

function notifyConsulted(taskId, senderId, consultedName, consultedEmail){
    $.ajax({ // create an AJAX call...
        data: {type:"consulted", taskId:taskId, receiverUserId:consultedEmail+'###'+consultedName, senderUserId: senderId, deadline:null}, // get the form data
        type: 'GET', // GET or POST
        url: '/api/sendnotifications', // url
        success: function (response) { // on success..
            //Check response
            var data = $.parseJSON(response);
        },
        error: function (){
        }
    });
}

function generateProjectPdfById(id, showGraphs){
    loadingShow();
    $("body").css("cursor", "progress");
    var onBack=true;
    var xhr = new XMLHttpRequest() // create new XMLHttpRequest2 object
    xhr.open('GET', '/api/get_project?id=' + id) // open GET request
    xhr.onload = function () {
        if (xhr.status === 200) { // if Ajax request successful
            var output = JSON.parse(xhr.responseText) // convert returned JSON string to JSON object
            //console.log(output.status) // log API return status for debugging purposes
            if (output.api_status == 'OK') { // if API reports everything was returned successfully
                loadedProject = true;
                currentProjectInfo = output.data;                
                generateProjectPdf(showGraphs);                
            } else if (output.api_status == 'KO') {
                alert(output.api_message);
                //loadingHide(onBack);
                $("body").css("cursor", "default");
            }
        } else {
            alert('Request failed.  Returned status of ' + xhr.status)
            //loadingHide(onBack);
            $("body").css("cursor", "default");
        }
    }
    xhr.send() // send request
    xhr.onerror= function(){
        alert('Request failed.  Returned status of ' + xhr.status)
        //loadingHide(onBack);
        $("body").css("cursor", "default");
    }

}

/**
 * Function to create PDF with current project info
 */
async function generateProjectPdf(showGraphs){
    if(currentProjectInfo!=null){

        var projName=currentProjectInfo.project.som_projects_name.replace(' ', '_');
        var country=currentProjectInfo.project.som_projects_country;
    
        var doc = new jsPDF();
        
        var finalY= 0;
    
        //1) Set Header
        doc.setFontSize(30);
        doc.setFontStyle("bolditalic");
        doc.setTextColor("#1a2732");
        doc.text("aena", 14, finalY + 15);
        doc.setFontStyle("normal");
        doc.setTextColor("#96ce00");
        doc.text("gpi", 42, finalY + 15);
        doc.setTextColor("#1a2732");
        doc.setFontStyle("bold");
        finalY= finalY + 15;
    
        doc.setFontSize(16);

        //2) Set Project Info
        doc.text("Project Info", 14, finalY + 15);
        
        var col = ["Field", "Value"];
        var rows = [];
    
        var excludedColumns=["som_projects_id",
                            "users",
                            "financial_summary",
                            "phases",
                            "som_projects_img_url",
                            "som_status_hex_color",
                            "airport",
                            "country",
                            "multi_airport",
                            "som_status_is_behaviour_completed",
                            "som_status_is_behaviour_ongoing",
                            "project_due_date",
                            "project_start_date",
                            "partners",
                            "advisors"]
    
        for(var key in currentProjectInfo.project){
            if(excludedColumns.includes(key)){
                continue;
            }
            var code=key.replace('som_projects_','').replace(/_/g,' ');
            var temp = [code, currentProjectInfo.project[key]];
            rows.push(temp);
            //console.log(temp);
        }
        var first = true;
        for(var key in currentProjectInfo.project['partners']){
            if(excludedColumns.includes(key)){
                continue;
            }
            var code=key.replace('som_projects_','').replace(/_/g,' ');
            var temp = [first?'partners':'', currentProjectInfo.project.partners[key].name];
            first = false;
            rows.push(temp);
            //console.log(temp);
        }
        if (first){
          rows.push(['partners','-']);
        }
        first = true;
        for(var key in currentProjectInfo.project['advisors']){
            if(excludedColumns.includes(key)){
                continue;
            }
            var code=key.replace('som_projects_','').replace(/_/g,' ');
            var temp = [first?'advisors':'', currentProjectInfo.project.advisors[key].name];
            first = false;
            rows.push(temp);
            //console.log(temp);
        }
        if (first){
          rows.push(['advisors','-']);
        }   
    
        doc.autoTable(col, rows, {
            headStyles: {fillColor: [26, 39, 50], textColor: [150,206,0], fontStyle: 'bold'},
            startY: finalY + 20,
            columnStyles: {
                0: {cellWidth: 40},
                1: {cellWidth: 60},
            }
        });
    
        
        //3) Set Project Users
        finalY = doc.previousAutoTable.finalY;
        doc.text("Project Users", 14, finalY + 15);
        
        var col = ["Name", "Email", "Job Profile"];
        var rows = [];
    
        for(var key in currentProjectInfo.project.users){
            //var code=key.replace('cms_users_','').replace('_',' ');
            var temp = [currentProjectInfo.project.users[key].cms_users_name, currentProjectInfo.project.users[key].cms_users_email, currentProjectInfo.project.users[key].cms_users_job_title];
            rows.push(temp);
            //console.log(temp);
        }
    
        doc.autoTable(col, rows, {
            headStyles: {fillColor: [26, 39, 50], textColor: [150,206,0], fontStyle: 'bold'},
            startY: finalY + 20,
            columnStyles: {
                0: {cellWidth: 33},
                1: {cellWidth: 33},
                2: {cellWidth: 33}
            }
        });

        //4) Set Project Phahses
        finalY = doc.previousAutoTable.finalY;
        doc.text("Project Phases", 14, finalY + 15);
        
        var col = ["Name", "Status", "Nº Forms", "Completed Forms", "On going Forms" ];
        var rows = [];
    
        for(var key in currentProjectInfo.project.phases){
            //var code=key.replace('cms_users_','').replace('_',' ');
            var temp = [currentProjectInfo.project.phases[key].som_phases_name, 
                        currentProjectInfo.project.phases[key].som_status_name, 
                        currentProjectInfo.project.phases[key].formscount,
                        currentProjectInfo.project.phases[key].formscompletedcount,
                        currentProjectInfo.project.phases[key].formsongoingcount];
            rows.push(temp);
            //console.log(temp);
        }
    
        doc.autoTable(col, rows, {
            headStyles: {fillColor: [26, 39, 50], textColor: [150,206,0], fontStyle: 'bold'},
            startY: finalY + 20
        });

        

        //5) Set Country Info
        //finalY = doc.previousAutoTable.finalY;
        doc.addPage();
        finalY=0;
        doc.text("Country Info", 14, finalY + 15);
        
        var col = ["Field", "Value"];
        var rows = [];
    
        var excludedColumns=["additional_info"]
    
        for(var key in currentProjectInfo.project.country){
            if(excludedColumns.includes(key)){
                continue;
            }
            var code=key.replace('som_projects_','').replace('_',' ');
            var temp = [code, currentProjectInfo.project.country[key]];
            rows.push(temp);
            //console.log(temp);
        }
    
        doc.autoTable(col, rows, {
            headStyles: {fillColor: [26, 39, 50], textColor: [150,206,0], fontStyle: 'bold'},
            startY: finalY + 20,
            columnStyles: {
                0: {cellWidth: 40},
                1: {cellWidth: 60},
            }
        });        


        if(showGraphs == true){
            doc.setFontSize(13);
            doc.setTextColor("#96ce00");
            
            doc.addPage();
            finalY=0;
    
            const chartInflation = document.getElementById('country-inflation-evolution-export');
            await html2canvas(chartInflation, { scale: 1 }).then(function (canvas) { 
                doc.text("INFLATION EVOLUTION", 14, finalY + 15 );
                doc.addImage(canvas.toDataURL('image/jpeg'), 'JPEG', 14, finalY + 20, 290/4, 150/4);          
            });
            
            
            const chartPopulation = document.getElementById('country-population-evolution-export');
            await html2canvas(chartPopulation, { scale: 1 }).then(function (canvas) { 
                doc.text("POPULATION", 120, finalY + 15 );
                doc.addImage(canvas.toDataURL('image/jpeg'), 'JPEG', 120, finalY + 20, 290/4, 150/4);          
            });
                    
            finalY=60;
    
            const chartEvolution = document.getElementById('country-evolution-evolution-export');
            await html2canvas(chartEvolution, { scale: 1 }).then(function (canvas) { 
                doc.text("GDP EVOLUTION AND FORECAST (€ MN)", 14, finalY + 15 );
                doc.addImage(canvas.toDataURL('image/jpeg'), 'JPEG', 14, finalY + 20, 290/4, 150/4);          
            });                
    
        }
        //---------

        // if(doc.previousAutoTable.finalY>230)
        // {
        //     doc.addPage();
        //     finalY=0;

        // }
        // else
        // {
        //     finalY = doc.previousAutoTable.finalY;
        // }        
       
        //6) Set Airport Info
        //As image doens´t move to new page if doesn´t fit, we control it
        doc.addPage();
        finalY=0;
        // if(doc.previousAutoTable.finalY>230)
        // {
        //     doc.addPage();
        //     finalY=0;

        // }
        // else
        // {
        //     finalY = doc.previousAutoTable.finalY;
        // }        
        doc.setTextColor("#1a2732");
        doc.setFontSize(16);
        doc.text("Airport Info", 14, finalY + 15);
        //console.log("Airport starts in: " + (finalY+15))
        var airportHasImage = false;
        var img = new Image();
        if (currentProjectInfo.project.airport.som_projects_airport_img_url!=null){
            img.src = currentProjectInfo.project.airport.som_projects_airport_img_url;
            console.log('img',img)
            doc.addImage(img, 'JPEG', 14, finalY + 20, 100, 50);
            airportHasImage = true;
        }
        
        var col = ["Field", "Value"];
        var rows = [];
    
        var excludedColumns=["som_projects_id", "som_projects_airport_img_url", "city"]
    
        for(var key in currentProjectInfo.project.airport){
            if(excludedColumns.includes(key)){
                continue;
            }
            var code=key.replace('som_projects_','').replace('_',' ');
            var temp = [code, currentProjectInfo.project.airport[key]];
            rows.push(temp);
            //console.log(temp);
        }
    
        doc.autoTable(col, rows, {
            headStyles: {fillColor: [26, 39, 50], textColor: [150,206,0], fontStyle: 'bold'},
            startY: finalY +airportHasImage?85:20,
            columnStyles: {
                0: {cellWidth: 40},
                1: {cellWidth: 60},
            }
        });

        if (currentProjectInfo.project.multi_airport.length>1){

            doc.setTextColor("#1a2732");
            doc.setFontSize(16);
    
            
            var multiairports = currentProjectInfo.project.multi_airport.splice(1);
            firstMultiAirport = true;

            var numAirport=1;
            multiairports.forEach(airport => {
                doc.addPage();
                finalY=0;
                /*
                if (firstMultiAirport){
                    doc.text("Additional Airports Info", 14, finalY + 15);
                    firstMultiAirport=false;
                }
                */

                doc.text("Additional Airports Info ("+numAirport+")", 14, finalY + 15);
                numAirport++;

                //console.log("Airport starts in: " + (finalY+15))
                var img = new Image();
                console.log(airport.som_projects_airport_img_url);
                var hasImage = false;
                if (airport.som_projects_airport_img_url!=null){
                    img.src = airport.som_projects_airport_img_url;
                    doc.addImage(img, 'JPEG', 14, finalY + 20, 100, 50);
                    hasImage = true;
                }
                
                var col = ["Field", "Value"];
                var rows = [];
            
                var excludedColumns=["som_projects_id", "som_projects_airport_img_url", "city"]
            
                for(var key in airport){
                    if(excludedColumns.includes(key)){
                        continue;
                    }
                    var code=key.replace('som_projects_','').replace('_',' ');
                    var temp = [code, airport[key]];
                    rows.push(temp);
                    //console.log(temp);
                }
            
                doc.autoTable(col, rows, {
                    headStyles: {fillColor: [26, 39, 50], textColor: [150,206,0], fontStyle: 'bold'},
                    startY: finalY + hasImage?85:20,
                    columnStyles: {
                        0: {cellWidth: 40},
                        1: {cellWidth: 60},
                    }
                });
                
            });

        }

        //---------
        doc.save(country+'_'+projName+'.pdf');
        $("body").css("cursor", "default");
        
        if(showGraphs){
            //Disable blur and show time
            loadingHide(false);
        }else{
            loadingHide(true);
        }
        
        
    }



}

