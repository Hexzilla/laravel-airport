<div class="airport image-full-screen hide">
    <img class="show-image" src="" />
    <span class="minimize " onclick="showImage('airport');"><img src="/images/icons/close_modal.png" /></i></span>
</div>

<div class="fullScreen airport-modal animated" style="display:none">
    <!-- airport -->
    <div class="row nomargin-side nopadding-side modal-small">
        <div class="modal-popup" style="">
            <div class="modal-close-button close-airport-modal">
                <img src="/images/icons/close_modal.png" />
            </div>
            <!-- CONTENT -->
            <div class="nomargin-side nopadding-side data modal-min">
                <div class="nomargin-side row title-row">
                    <span class="modal-icon fa fa-plane-departure"></span>
                    <span class="airport-title">AIRPORT SUMMARY</span>
                    <span class="fa fa-info-circle" onclick="OpenCloseSecondModal();"></span>
                    <span class="airport-name"></span>
                </div>
                <div class="nomargin-side row">
                    <div class="col-md-4">
                        <div class="mini-card">
                            <span class="title-master">COUNTRY</span>
                            <span class="airport-country-value"></span>
                        </div>
                        <div class="mini-card">
                            <span class="title-master">IATA / OACI CODE</span>
                            <span class="airport-iata-value"></span>
                        </div>
                        <div class="mini-card">
                            <span class="title-master">TYPE OF AIRPORT</span>
                            <span class="airport-type-value"></span>
                        </div>
                        <div class="mini-card">
                            <span class="title-master">SIZE (Mpax)</span>
                            <span class="airport-size-value"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mini-card">
                            <span class="title-master">REVENUES AERONAUTICAL (€ mn)</span>
                            <span class="airport-aero-revenues-value"></span>
                        </div>
                        <div class="mini-card">
                            <span class="title-master">REVENUES NON-AERONAUTICAL (€ mn)</span>
                            <span class="airport-non-aero-value"></span>
                        </div>
                        <div class="mini-card">
                            <span class="title-master">TOTAL REVENUES (€ mn)</span>
                            <span class="airport-total-revenues-value"></span>
                        </div>
                        <div class="mini-card">
                            <span class="title-master">TOTAL OPEX (€ mn)</span>
                            <span class="airport-total-opex-value"></span>
                        </div>
                        <div class="mini-card">
                            <span class="title-master">EBITDA (€ mn)</span>
                            <span class="airport-ebitda-value"></span>
                        </div>                        
                    </div>
                    <div class="col-md-4">
                        <div class="mini-card">
                            <span class="title-master">KPIS</span>
                            <span class="title">REVENUES AERONAUTICAL (€/pax)</span>
                            <span class="airport-kpis-revenues-aeronautical value"></span>
                            <span class="title">REVENUES NON-AERONAUTICAL (€/pax)</span>
                            <span class="airport-kpis-revenues-non-aeronautical-value value"></span>
                            <span class="title">EBITDA/PAX</span>
                            <span class="airport-kpis-ebitda-value value"></span>
                            <span class="title">DEBT/EBITDA</span>
                            <span class="airport-kpis-debt-value value"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
            <div class="multi-airport-slider" style="display:none">
                <div class="prev" onclick="loadMultiAirportSheet(-1)">
                <i class="fas fa-chevron-left"></i>
                </div>
                <div class="next" onclick="loadMultiAirportSheet(1)">
                <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row nomargin-side nopadding-side modal-big hide">
        <div class="modal-popup" style="">
            <div class="modal-close-button close-airport-modal">
                <img src="/images/icons/close_modal.png" />
            </div>
            <!-- CONTENT -->
            <div class="nomargin-side nopadding-side data modal-min">
                <div class="nomargin-side row title-row">
                    <span class="fa fa-arrow-left" onclick="OpenCloseSecondModal();"></span>
                    <span class="modal-icon fa fa-plane-departure"></span>
                    <span class="airport-title">AIRPORT SUMMARY</span>

                </div>
                <div class="nomargin-side row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mini-card">
                                    <span class="title-master">DETAILED PAX CHARACTERIZATION</span>
                                    <span class="title">% INTERNATIONAL</span>
                                    <span class="airport-international-value value"></span>
                                    <span class="title">% TRANSFER</span>
                                    <span class="airport-transfer-value value"></span>
                                    <span class="title">% LOW COST</span>
                                    <span class="airport-non-low-cost-value value"></span>
                                </div>
                                <div class="mini-card image-container">
                                    <img src="" />
                                    <span class="fas fa-expand" onclick="showImage('airport');"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="airport-competitors mini-card textbox">
                                    <span class="">COMPETITORS</span>
                                    <span class="airport-competitors-description value"></span>
                                </div>
                                <div class="airport-routes mini-card textbox">
                                    <span class="">ROUTES</span>
                                    <span class="airport-routes-description value"></span>
                                </div>
                                <div class="airport-other-info mini-card textbox">
                                    <span class="">OTHER RELEVANT INFORMATION</span>
                                    <span class="airport-other-info-description value">-</span>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="airport-infra-charact mini-card textbox">
                                        <span class="">INFRASTRUCTURE CHARACTERIZATION DESCRIPTION</span>
                                        <span class="airport-infra-charact-description value"></span>
                                    </div>
                                    <div class="airport-catchment mini-card textbox">
                                        <span class="">AIRPORT CATCHMENT AREA</span>
                                        <span class="airport-catchment-description value"></span>
                                    </div>
                                    <div class="airport-magic-container nomargin-side row">
                                        <div class="chart-circle-container top-1 col-md-4">
                                            <div class="c100 small green-chart">
                                                <span class="top">Top 1</span>
                                                <span class="top-value"></span>
                                                <div class="slice">
                                                    <div class="bar"></div>
                                                    <div class="fill"></div>
                                                </div>
                                            </div>
                                            <span class="top-airline"></span>
                                        </div>
                                        <div class="chart-circle-container top-2 col-md-4">
                                            <div class="c100 small green-chart">
                                                <span class="top">Top 2</span>
                                                <span class="top-value"></span>
                                                <div class="slice">
                                                    <div class="bar"></div>
                                                    <div class="fill"></div>
                                                </div>
                                            </div>
                                            <span class="top-airline"></span>
                                        </div>
                                        <div class="chart-circle-container top-3 col-md-4">
                                            <div class="c100 small green-chart">
                                                <span class="top">Top 3</span>
                                                <span class="top-value"></span>
                                                <div class="slice">
                                                    <div class="bar"></div>
                                                    <div class="fill"></div>
                                                </div>
                                            </div>
                                            <span class="top-airline"></span>
                                        </div>                                                                                                                     
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="airport-competitors mini-card textbox">
                                    <span class="">MASTER PLAN ESTIMATIONS</span>
                                    <span class="airport-master-plan-description value"></span>
                                </div>
                                <div class="airport-society-model mini-card textbox">
                                    <span class="">SOCIETY MODEL & REGULATION</span>
                                    <span class="airport-society-model-description value"></span>
                                </div>
                                <div class="airport-aenas-network mini-card textbox">
                                    <span class="">AENA'S NETWORK IMPROVEMENT</span>
                                    <span class="airport-aenas-network-description value"></span>
                                </div>
                                <div class="airport-data-year mini-card textbox">
                                    <span class="">DATA YEAR</span>
                                    <span class="airport-data-year-description value">-</span>
                                </div>
                                <div class="airport-version-date mini-card textbox">
                                    <span class="">VERSION DATE</span>
                                    <span class="airport-version-date-description value">-</span>
                                </div>                                                                

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>

</div>