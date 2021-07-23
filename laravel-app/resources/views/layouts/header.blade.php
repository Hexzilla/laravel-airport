<div class="mainheader">

    <div class="row header nomargin-side">

        <div class="col-4 logo">
            <a href="/home"><img src="/images/logo_aena.png"></a>
        </div>

        <div class="col-lg-4 col-md-5 col-sm-6 search animated">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" id="searchFilter" class="css-input" value="" placeholder="BUSCAR POR NOMBRE DE PROYECTO">
            <div class="clear" style="display:none">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </div>

        <div class="col-lg-4 col-md-3 col-sm-2 col-xs-8 view-user animated">
            <div class="row">

                <!-- VIEW -->
                <div class="col-md-5 col-sm-8 view filters animated">
                    <div class="row">
                        <div class="col-md-13 phase-views">
                            <!-- FILTER -->
                            <div class="row filter change-view-container">
                                <div class="phase-text">VISTA LISTA</div>
                                <div class="toggle-container" id="change-view-slidder">
                                    <div></div>
                                </div>
                            </div>
                            <!-- END FILTER -->
                        </div>
                    </div>
                </div>
                <!-- END VIEW -->

                <!-- USER -->
                <div class="col-md-7 col-sm-2 user">
                    <div class="row">
                        <div class="col-md-9 userDataWelcome">
                            <div class="row">
                                <div class="col-md-12 welcome">Bienvenido</div>
                                <div class="col-md-12 username">{{ $username }} </div>
                            </div>
                        </div>
                        <div class="col-md-3 avatar nomargin-side nopadding-side">
                            <a id="fotoLogout">
                                <img src="{{ $userphoto }}" onerror="this.onerror=null;this.src='images/icons/default-avatar.png';" />
                            </a>
                        </div>
                    </div>
                    <div id="dialogButtonsProfile" class="hide">
                        <div class="arrow-up"></div>
                        <div id="dialogLogoutBackOffice">
                            <button id="buttonBackOffice">ACCESS BACKOFFICE</button>
                            <button id="buttonLogout">LOGOUT</button>
                            <div id="lastLogin" class="col-md-12" style="font-size:0.7em;text-align: center;"></div>
                        </div>
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <!-- EN USER -->

            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    var lastLoginTimestamp = '{{session('last_login_timestamp')}}';
    if(lastLoginTimestamp!=''){
        $('#lastLogin').text('Last Login: '+ new Date(lastLoginTimestamp*1000).toLocaleString());
    }
</script>
