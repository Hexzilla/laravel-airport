<div id="country-inflation-evolution-export" class="pdf-country-inflation-evolution" style="z-index:-99999;position: fixed;"></div>
<div id="country-population-evolution-export" class="pdf-country-population-evolution" style="z-index:-99999;position: fixed;"></div>
<div id="country-evolution-evolution-export" class="pdf-country-evolution-evolution" style="z-index:-99999;position: fixed;"></div>

<div class="fullScreen country-modal animated" style="display:none">
    <!-- country -->
    <div class="row nomargin-side nopadding-side ">
        <div class="modal-popup" style="">
            <div class="modal-close-button close-country-modal">
                <img src="/images/icons/close_modal.png" />
            </div>
            <!-- CONTENT -->
            <div class="nomargin-side nopadding-side data">
                <div class="row">
                    <img class="img-fluid img_url country-flag" src=""
                        onerror="this.onerror=null;this.src='images/icons/default_project_img.png';">
                    <span class="country-name"></span>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="country-overall mini-card textbox">
                            <span class="">DESCRIPTION</span>
                            <span class="country-overall-description">-</span>
                        </div>

                        <div class="country-tourism mini-card">
                            <span class="title-master">TOURISM SITUATION (% PIB FROM TOURISM ACTIVITY)</span>
                            <span class="country-tourism-value">-</span>
						</div>
                        <div class="country-exports-imports mini-card">
                            <span class="title-master">EXPORTS AND IMPORTS (€ bn)</span>
                            <span class="country-exports-imports-value">-</span>
						</div>	
                        <div class="country-version-date mini-card">
                            <span class="title-master">VERSION DATE</span>
                            <span class="country-version-date-value">-</span>
						</div>	
                        <div class="country-exchange-rate mini-card">
                            <span class="title-master">EXCHANGE RATE</span>
                            <span class="country-exchange-rate-value">-</span>
						</div>																		
                    </div>

                    <div class="col-4">

                        
						<div class="mini-card country-inflation-panel" id="chart-country-inflation-panel">
							<span class="country-inflation-title">INFLATION (%)</span>
							<div class="country-inflation-evolution"></div>							
						</div>		
						<div class="mini-card">
                            <span class="title-master">COUNTRY RISK</span>
                            <span class="country-risk-value">-</span>
						</div>			
						<div class="mini-card country-risk-panel">
                            <span class="country-risk-title">COUNTRY RISK</span>
							<div class="country-risk-list">
								<div class="country-risk-list-politics">
									<span>POLITICS</span>
									<i class="fas fa-star"></i>									
									<i class="fas fa-star"></i>		
									<i class="fas fa-star"></i>		
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</div>
								<div class="country-risk-list-regulatory">
									<span>REGULATORY</span>
									<i class="fas fa-star"></i>									
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</div>	
								<div class="country-risk-list-regulatory">
									<span>REGULATORY</span>
									<i class="fas fa-star"></i>									
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</div>	
								<div class="country-risk-list-regulatory">
									<span>REGULATORY</span>
									<i class="fas fa-star"></i>									
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</div>																								
								<div class="country-risk-list-regulatory">
									<span>REGULATORY</span>
									<i class="fas fa-star"></i>									
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</div>	
							</div>
                        					
						</div>						
					</div>
                    <div class="col-4">

						<div class="mini-card country-population-panel">
							<span class="country-population-title">POPULATION (mn)</span>
							<div class="country-population-evolution">-</div>							
						</div>					
						<div class="mini-card country-evolution-panel">
							<span class="country-evolution-title">GDP (€ bn)</span>
							<div class="country-evolution-evolution">-</div>							
						</div>				
                        <div class="country-tourism mini-card">
                            <span class="title-master">LOCATION ALIGNED WITH AENA INTERNACIONAL STRATEGY</span>
                            <span class="country-aligned-value">-</span>
						</div>																			
                    </div>
                </div>

            </div>

            <!-- END CONTENT -->
        </div>
    </div>
</div>