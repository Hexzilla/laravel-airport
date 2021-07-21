<div class="row div-section-summary">
    <span class="main-title">Elementos de Control</span>
</div>
<div class="div-section-summary">
    @php
        $nElements=0;
    @endphp    
    @foreach($element_list as $element)
        @if($element->is_mandatory && $nElements<4)
            <div class="summary-element row summary-row">
                <div style='display:inline' class="col-7 np">
                    {{$element->name}}
                </div>
                <!-- if doc_url we show the lastUpdate date-->
                @if($element->doc_url != null)
                    <div style='display:inline' class="col-3 np">
                        <span class="approval-calendar glyphicon glyphicon-calendar" style="cursor:default"></span>
                        <span class="date">{{$element->lastupdate!=''?date('d/m/Y', strtotime($element->lastupdate)):''}}</span>
                    </div>
                    <div title="{{$element->name}}" class="circle-ok active" style="margin-top: 0px;" id="e_ok_{{$element->id}}">
                        <span>
                            <i class="fa fa-check" style="vertical-align: text-top;" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div title="{{$element->name}}" class="circle-cancel hide" style="margin-top: 0px;" id="e_cancel_{{$element->id}}">
                        <span>
                            <i class="fa fa-times" style="vertical-align: text-top;" aria-hidden="true"></i>
                        </span>
                    </div>
                @else
                    <div style='display:inline' class="col-3 np">
                        <span class="approval-calendar glyphicon glyphicon-calendar" style="cursor:default"></span>
                        <span class="date">{{$element->lastupdate!=''?date('d/m/Y', strtotime($element->lastupdate)):''}}</span>
                    </div>
                    <div title="{{$element->name}}" class="circle-ok active hide"  id="e_ok_{{$element->id}}">
                        <span>
                            <i class="fa fa-check" style="vertical-align: text-top;" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div title="{{$element->name}}" class="circle-cancel"  id="e_cancel_{{$element->id}}">
                        <span>
                            <i class="fa fa-times" style="vertical-align: text-top;" aria-hidden="true"></i>
                        </span>
                    </div>
                @endif
            </div>
            @php 
                $nElements++;
            @endphp
        @endif
    @endforeach
</div>
		