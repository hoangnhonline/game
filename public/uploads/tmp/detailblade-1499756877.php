@extends('layouts.superstar') @section('title') Booking Details @stop
@section('css_page')
<style>
    #tbOptourPrice tr.spot,
    #tbOptourPrice tr.campaign {
        background-color: #fff;
    }
    #tbOptourPrice #tableOptourPrice_tbody .grs_campaign {
        color: #ff0000;
    }
</style>
@stop
@section('content')
<div class="sidebar-option-position">
    <div class="sidebar-icon">
        <span class="icon icon-setting"><i class="fa fa-cog"></i></span>
        @if (!empty($infoOneShotCallVendor) && ($infoOneShotCallVendor->sup_cty != ''
        && $infoOneShotCallVendor->sup_cd != '' && $infoOneShotCallVendor->nm_en != ''))
            <span class="icon icon-call icon-panel-more btn-show-panel btnShowCalVendorPanel"
                  style="top:56px;"><i class="fa fa-phone fa-rotate-270 text-red"></i></span>
        @else
            <span class="icon icon-call icon-panel-more disable" style="top:56px;">
                <i class="fa fa-phone fa-rotate-270 text-red"></i></span>
        @endif
        <span class="icon icon-person icon-panel-more" style="top:98px;"><i class="fa fa-user"></i></span>
    </div>
    <div class="sidebar-body">
        <!-- star sidebar-option-position -->
        @include('superstar.booking-detail.side-panel.booking-change')
        @include('superstar.booking-detail.side-panel.call-vendor')
        @include('superstar.booking-detail.side-panel.inventory-refund')
        @include('superstar.booking-detail.side-panel.no-show')
        @include('superstar.booking-detail.side-panel.op-services')
        @include('superstar.booking-detail.side-panel.select-referring-booking')
        @include('superstar.booking-detail.side-panel.spot-price-partial-refund')
        @include('superstar.booking-detail.side-panel.travel-with')
        @include('superstar.booking-detail.side-panel.update-status')
        @include('superstar.booking-detail.side-panel.upgrade')
        @include('superstar.booking-detail.side-panel.xc-refund')
    </div><!-- end /.sidebar-body -->

</div><!-- end /.sidebar-option-position -->

<section class="content-header">
    <h1 class="page-title">Booking Details</h1>
</section>
<section class="content-main">
    @include('flash::message')
    @include('superstar.common.alert')
    @include('superstar.common.errors', ['noclose' => true])
    {{--*/
        	$listbk = route('superstar.booking.index',[urldecode(REQUEST_URI)]);
        	$oldtime = Carbon\Carbon::parse($BkgData->updated_at_jst)->timestamp;
   			$dataform = ['tour_no' => $BkgData->tour_no,'bkg_seq_no' => $BkgData->bkg_seq_no,
                        'req_seq_no' => $BkgData->req_seq_no,
                        'model' => 'App\Models\Entity\SuperStar\Booking\SS_Booking_Optour_Data',
                        'oldtimejst'=>$oldtime];
    /*--}}
    <div class="box">
        <div class="box-body">
			<div class="text-left mb10">
                 <a class="btn btn-primary" href="{{ $listbk }}">
                     <i class="fa fa-long-arrow-left"></i> Go To Booking List</a>
            </div>
            <!-- H1 -->
            <div class="clearfix mb10">
                {{-- Service Injection --}}
                @inject('ssMstBkgSourceInstance', 'App\Models\Entity\SuperStar\Master\SS_Mst_Bkg_Source')

                {{--*/
                // Get All [ss_mst_bkg_source], data master for DropDownList
                $bkgSourceCollection = $ssMstBkgSourceInstance->getForBookingSearch();

                /*--}}
                <div class="pull-left">
                    <div class="form-group w100px">
                        <label>BKG Source</label>
                        <select class="selectpicker show-tick" data-width="100%" name="bkg_source" disabled="disabled">
                            @foreach($bkgSourceCollection as $bkgSource)
                            <option value="{{ $bkgSource->cd }}"
                            {!! (strtolower($bkgSource->cd) == old('bkg_source', strtolower($BkgData->bkg_source))) ?
                            ' selected="selected"' : '' !!}> {{ $bkgSource->nm }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="pull-right">
                    @if( $TrfData->voucher_issue_fg == 1 &&  $OpTourClient->pickup_loc_cd != 'TBA' )
                        <button type="button"
                                data-link="{{ route('superstar.reports.exportvoucher.index',
                                [ $BkgData->tour_no, $BkgData->bkg_seq_no ])}}"
                                class="btn btn-primary export-voucher">Output Voucher</button>
                    @else
                        <button type="button" class="btn btn-primary" disabled>Output Voucher</button>
                    @endif

                    @if( $BkgData->status == 'OK' &&  $BkgData->pay_status == 'CCDECLINE' )
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#ArrangementEmail"
                                data-bkg_seq_no="{{$BkgData->bkg_seq_no}}" data-tour_no="{{$BkgData->tour_no}}"
                                data-req_seq_no="{{$BkgData->req_seq_no}}"
                                id="btArrangementEmail" onclick="">HIOP CC DECLINE</button>
                    @else
                        <button type="button" class="btn btn-primary" disabled>HIOP CC DECLINE</button>
                    @endif
                    <?php
                    $classDisabled = ' disabled';
                    $routeClientFile = '#';
                    if ($OpTourClient && $OpTourClient->id) {
                        $classDisabled = '';
                        $routeClientFile = route(
                            'superstar.booking.client-file.detail',
                            $OpTourClient->id
                        );
                    }
                    ?>
                    <a target="_blank" href="{{$routeClientFile}}"{{$classDisabled}}
                        class="btn btn-primary">Go To Client File</a>
                    <a target="_blank" href="{{route('superstar.booking.client-file.index')}}"
                       class="btn btn-primary">Go To Client Lists</a>
                </div>
            </div>

            <!-- Client Information -->
            <form onsubmit="checksameupdate(this)" data-model="{{ json_encode($dataform) }}"
                  action="{{ route('superstar.booking.detail.update') }}" method="POST"
                  name="frmClientInfo" id="frmClientInfo">
            	<input type="hidden" name="req_url" value="{{REQUEST_URI}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="tour_client_id" value="{{ $OpTourClient->id }}">
                <input type="hidden" id="tour_client_id_no" value="{{ $OpTourClient->id_no }}">
                <input type="hidden" id="tour_no" value="{{ old('tour_no', $TourNo) }}" >
                <div class="box-accordion in">
                    <div class="accordion-header box-header mb05">
                        <h2 class="box-title">Client Information</h2>
                        <a href="javascript:void(0);" class="btn-opened" title="Down Up"></a>
                    </div><!-- end /.accordion-header -->

                    <div class="box-collapse">
                        <div class="table-responsive">
                            <table class="table table-form mb05">
                                <thead>
                                <tr>
                                    <th class="w150px">Last Name <span class="required"></span></th>
                                    <th class="w150px">First Name <span class="required"></span></th>
                                    <th class="w70px">Title <span class="required"></span></th>
                                    <th class="w90px">PAX Type</th>
                                    <th class="w10px">BirthDay</th>
                                    <th class="w10px">Age</th>

                                    <th class="w120px">Phone No</th>
                                    <th>E-Mail Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" readonly="readonly" name="last_nm"
                                               value="{{ old('last_nm', $OpTourClient->last_nm ) }}"
                                               id="last_nm" class="form-control half-size" placeholder=""
                                               maxlength="15"></td>
                                    <td><input type="text" readonly="readonly" name="first_nm"
                                               value="{{ old('first_nm', $OpTourClient->first_nm ) }}"
                                               id="first_nm" class="form-control half-size" placeholder=""
                                               maxlength="15"></td>
                                    <td>
                                        <input type="text" class="form-control w50px " id="title" name="title"
                                               maxlength="4" value="{{ old('title', $OpTourClient->title ) }}"
                                               readonly="readonly"/>
                                    </td>
                                    <td>
                                        <select class="selectpicker show-tick" data-width="100%" data-container="body"
                                                id="px_tp" name="px_tp" disabled>
                                            <option value="ADL" {{ old('px_tp', $OpTourClient->px_tp) == 'ADL' ? 'selected' : '' }}>A</option>
                                            <option value="CHL" {{ old('px_tp', $OpTourClient->px_tp) == 'CHL' ? 'selected' : '' }}>C</option>
                                            <option value="INF" {{ old('px_tp', $OpTourClient->px_tp) == 'INF' ? 'selected' : '' }}>I</option>
                                            <option value="TC" {{ old('px_tp', $OpTourClient->px_tp) == 'TC' ? 'selected' : '' }}>T</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" readonly="readonly" name="birth"
                                               value="{{ format_date(old('birth', $OpTourClient->birth )) }}"
                                               id="birth" class="form-control w100px" placeholder="MM/DD/YYYY"
                                               data-inputmask="'alias': 'mm/dd/yyyy'">
                                    </td>
                                    <td><input type="text" readonly="readonly" name="age"
                                               value="{{ old('age', $OpTourClient->age ) }}" id="age"
                                               class="form-control w40px text-center half-size" placeholder=""
                                               maxlength="3"></td>

                                    <td><input type="text" readonly="readonly" name="phone_no"
                                               value="{{ old('phone_no', $OpTourClient->phone_no ) }}"
                                               id="phone_no" class="form-control" placeholder="" maxlength="20"></td>
                                    <td><input type="text" readonly="readonly" name="email"
                                               value="{{ old('email', $OpTourClient->email ) }}" id="email"
                                               class="form-control" placeholder="" maxlength="250"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- end /.table-responsive -->

                        <div class="in mb05">
                            <div class="box-header mb05 pb05 pr05">
                                <p class="fs13 text-bold pb05 pull-left">Client Memo</p>                               
                                <p class="pull-right">                            
                                    <span id="text-memo">
                                        {!! !empty(old('client_memo', $OpTourClient->client_remarks))
                                        ? 'Entered' : 'Blank' !!}</span>
                                    <button type="button" id="btn-memo"
                                            class="btn btn-primary btn-sm btn-client-remarks">
                                        {!! !empty(old('client_memo', $OpTourClient->client_remarks))
                                        ? 'CLOSE' : 'OPEN' !!}</button>
                                </p>
                            </div><!-- end /.box-heade -->

                            <div class="box-collapsee"
                            {!! empty(old('client_memo', $OpTourClient->client_remarks)) ?
                            ' style="display: none"' : '' !!}>
                                <textarea class="form-control half-size" rows="3"
                                          name="client_remarks" id="client_remarks"
                                          maxlength="250">{{ old('client_memo',
                                    $OpTourClient->client_remarks ) }}
                                </textarea>

                            </div><!-- end /.box-collapse -->

                        </div><!-- end /.box-accordion -->

                        <table class="table table-form mb10">
                            <thead>
                            <tr>
                                <th class="w10px">Dummy<br>Date</th>
                                <th class="w150px">Pax Arrival Date</th>
                                <th class="w10px">Dummy<br>Date</th>
                                <th class="w150px">Pax Departure Date</th>
                                <th class="w10px">Arrival Number</th>
                                <th class="w10px">Cluster</th>
                                <th class="w10px pr10">Baggage Pull Date</th>
                                <th class="w10px pr10">Baggage Pull Time</th>
                                <th class="w10px">P/U Date</th>
                                <th>P/U Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>                                
                                <td class="text-center">
                                    <input disabled type="checkbox" name="arv_date_dmy_fg"
                                        id="arv_date_dmy_fg"
                                    {{ old('arv_date_dmy_fg', $OpTourClient->arv_date_dmy_fg) ? 'checked':'' }} ></td>
                                <td>
                                    <div class="input-group date datetimepicker w150px">
                                        <input type="text" readonly="readonly" class="form-control"
                                               name="pax_arrival_date"
                                               value="{{ old('pax_arrival_date',
                                               date('m/d/Y', strtotime($TourBaseData->arv_date)) ) }}"
                                               data-inputmask="'alias': 'mm/dd/yyyy'" placeholder="MM/DD/YYYY">
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                    </div>
                                </td>                                
                                <td class="text-center">
                                    <input disabled type="checkbox" name="dep_date_dmy_fg"
                                        id="dep_date_dmy_fg"
                                    {{ old('dep_date_dmy_fg', $OpTourClient->dep_date_dmy_fg ) ? 'checked' : '' }} >
                                </td>
                                <td>
                                    <div class="input-group date datetimepicker w150px">
                                        <input type="text" readonly="readonly" class="form-control"
                                               name="pax_departure_date" value="{{ old('pax_departure_date',
                                               date('m/d/Y', strtotime($TourBaseData->dep_date)) ) }}"
                                               data-inputmask="'alias': 'mm/dd/yyyy'" placeholder="MM/DD/YYYY">
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                                    </div>
                                </td>
                                <td><input type="text" name="" disabled value="{{ $OpTourClient->arv_no }}"
                                           class="form-control w50px half-size" maxlength="4"></td>
                                <td><input type="text" name="" disabled value="{{ $OpTourClient->cluster }}"
                                           class="form-control w50px half-size" maxlength="2"></td>
                                <td><input type="text" name="" disabled value="{{ $OpTourClient->baggage_down_day }}"
                                           class="form-control w100px" data-inputmask="'alias': 'mm/dd/yyyy'"></td>
                                <td><input type="text" name="" disabled value="{{ $OpTourClient->baggage_down_tm }}"
                                           class="form-control w60px" data-mask="99:99"></td>
                                <td><input type="text" name="" disabled value="{{ $OpTourClient->pickup_day }}"
                                           class="form-control w100px" data-inputmask="'alias': 'mm/dd/yyyy'"></td>
                                <td><input type="text" name="" disabled value="{{ $OpTourClient->pickup_tm }}"
                                           class="form-control w60px" data-mask="99:99"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <div class="pull-left">
                                <table class="table table-customize width-auto mb05" id="tblClientInfomation">
                                    <thead>
                                    <tr>
                                        <th class="miw40px w40px text-center">Del</th>
                                        <th class="w50px">Hotel CD <span class="required"></span></th>
                                        <th class="w10px">Hotel Name</th>
                                        <th class="w10px">Hotel City</th>
                                        <th class="w10px">Room #</th>
                                        <th class="w10px">InDate</th>
                                        <th class="miw40px w40px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--*/
                                        $i=0;                                       
                                    /*--}}
                                    @if (!empty ((array)old('client_htl', $ClientsHtl)))
                                        @foreach( old('client_htl', $ClientsHtl) as $hotel)
                                            <tr class="@if($i==0)firstTrElement"@endif>
                                                <input type="hidden" name="client_htl[{{ $i }}][tour_no]"
                                                       value="{{ old('tour_no', $TourNo) }}" >
                                                <input type="hidden" name="client_htl[{{ $i }}][trf_cd_tp]" value="H">
                                                <input type="hidden" name="client_htl[{{ $i }}][id_no]"
                                                       value="{{ $OpTourClient->id_no }}">

                                                <td class="text-center">
                                                    <input type="checkbox"
                                                           name="client_htl[{{ $i }}][dlt_fg]" value="1"></td>

                                                <td><input type="text" name="client_htl[{{ $i }}][htl_trf_cd]"
                                                           value="{{ substr($hotel['htl_trf_cd'], 0, 3) }}" id=""
                                                           class="form-control half-size" placeholder=""
                                                           maxlength="3"></td>

                                                <td>
                                                    <span class="qTip-Hotel-Name">
                                                        {{ hotel_name(substr($hotel['htl_trf_cd'], 0, 3),
                                                        $MstHtlData) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{ $hotel->trf_cd_cty }}
                                                </td>
                                                <td><input type="text" name="client_htl[{{ $i }}][room_no]"
                                                           value="{{ $hotel['room_no'] }}" id=""
                                                           class="form-control w60px half-size" placeholder=""
                                                           maxlength="10"></td>
                                                <td>
                                                    <div class="input-group date datetimepicker w130px">
                                                        <input type="text" class="form-control" id=""
                                                               name="client_htl[{{ $i }}][ckin_day]"
                                                               value="{{ $hotel['ckin_day'] }}" data-inputmask="'alias': 'mm/dd/yyyy'"
                                                               placeholder="MM/DD/YYYY">
                                              <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                              </span>
                                                    </div>
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                            {{--*/
                                                $i++;
                                            /*--}}
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="client_htl[0][htl_trf_cd]" class="form-control half-size htl-cd" maxlength="3"></td>
                                            <td><span class="qTip-Hotel-Name htl-nm"></span></td>
                                            <td><span class="qTip-Hotel-Name htl-cty"></span></td>
                                            <td><input type="text" name="client_htl[0][room_no]" class="form-control w60px" placeholder=""></td>
                                            <td>
                                                <div class="input-group date datetimepicker w130px">
                                                    <input type="text" class="form-control indate" id="" name="client_htl[0][ckin_day]" value="" data-inputmask="'alias': 'mm/dd/yyyy'" placeholder="MM/DD/YYYY">
                                                  <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                  </span>
                                                </div>
                                            </td>
                                            <td class="text-center"></td>
                                        </tr>
                                    @endif
                                    <tr class="groupActionRow">
                                        <td colspan="12">
                                            <button type="button" class="btn btn-primary w200px mb05"
                                                 id="btnAddItemClientInfomation"><i class="fa fa-plus"></i> Add</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right">
                                <table class="table table-customize width-auto mb15" id="tblClientInfomation">
                                    <thead>
                                    <tr>
                                        <th class="w10px">Arrival Flight<br>Carrier</th>
                                        <th class="w10px">Arrival Flight<br>No</th>
                                        <th class="w10px">Arrival<br>Time</th>
                                        <th>Departure Flight<br>Carrier</th>
                                        <th class="w10px">Departure<br>Flight No</th>
                                        <th class="w10px">Departure<br>Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--*/
                                        $clientFlightArrival = $clientFlightCollect->where('flt_tp_cd', 'A')->first();
                                        $clientFlightDeparture = $clientFlightCollect->where('flt_tp_cd', 'D')->first();
                                    /*--}}
                                    <tr>
                                        <td><input type="text" disabled name=""
                                                   value="{{ $clientFlightArrival['flt_carrier'] }}" id=""
                                                   class="form-control w60px" placeholder=""></td>
                                        <td><input type="text" disabled name=""
                                                   value="{{ $clientFlightArrival['flt_num'] }}" id=""
                                                   class="form-control w60px" placeholder=""></td>
                                        <td><input type="text" disabled name=""
                                                   value="{{ $clientFlightArrival['arv_tm_flt'] }}" id=""
                                                   class="form-control w60px" placeholder="HH:MM" data-mask="99:99">
                                        </td>
                                        <td><input type="text" disabled name=""
                                                   value="{{ $clientFlightDeparture['flt_carrier'] }}" id=""
                                                   class="form-control w60px" placeholder=""></td>
                                        <td><input type="text" disabled name=""
                                                   value="{{ $clientFlightDeparture['flt_num'] }}" id=""
                                                   class="form-control w60px" placeholder=""></td>
                                        <td><input type="text" disabled name=""
                                                   value="{{ $clientFlightDeparture['dep_tm_flt'] }}" id=""
                                                   class="form-control w60px" placeholder="HH:MM" data-mask="99:99">
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-form mb05">
                                <thead>
                                <tr>
                                    <th class="w100px">Tour No</th>
                                    <th class="w80px">Tour Type</th>
                                    <th class="w130px">Tour Name</th>
                                    <th class="w10px">Tour Arrival Date</th>
                                    <th class="w100px">Office Code</th>
                                    <th class="w130px">T/C</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" name="tour_no" value="{{ old('tour_no', $TourNo) }}"
                                               class="form-control half-size w120px" readonly="readonly"></td>
                                    <td>
                                        <select class="selectpicker show-tick" data-width="60px" data-container="body"
                                                name="tour_type" readonly="readonly">
                                            <option value="L1"
                                            {{ (old('tour_type', $BkgData->tour_tp )=='L1')?'selected':'' }}>L1</option>
                                            <option value="L2"
                                            {{ (old('tour_type', $BkgData->tour_tp )=='L2')?'selected':'' }}>L2</option>
                                        </select>
                                    </td>
                                    <td class="nowrap"><span class="qTip-Title" data-title="{{ $BkgData->tour_nm }}">
                                            {{ str_limit($BkgData->tour_nm, 50) }}</span></td>
                                    <td>
                                        <div class="input-group date datetimepicker w150px">
                                            <input type="text" class="form-control" id=""
                                                   name="tour_arrival_date"
                                                   value="{{ old('tour_arrival_date',
                                                   Carbon\Carbon::parse($TourBaseData->arv_date)->format('m/d/Y') ) }}"
                                                   data-inputmask="'alias': 'mm/dd/yyyy'" placeholder="MM/DD/YYYY" readonly="readonly">
                                        <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                    </td>
                                    <td class="form-inline nowrap">
                                        <input type="text" name="ofc_cd_1"
                                               value="{{ old('ofc_cd_1', $TourBaseData->ofc_cd_1 ) }}"
                                               class="form-control w50px half-size" maxlength="4" readonly="readonly"> -
                                        <input type="text" name="ofc_cd_2"
                                               value="{{ old('ofc_cd_2', $TourBaseData->ofc_cd_2 ) }}"
                                               class="form-control w40px half-size" maxlength="3" readonly="readonly">
                                    </td>
                                    @if( $TourClients->where('px_tp', 'TC')->count() )
                                        <td>{{ $TourClients->last_nm }}</td>
                                        <td>{{ $TourClients->first_nm }}</td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table><!-- end /.table-form -->
                        </div>
                        <div class="text-center mb15">

                        </div>
                    </div><!-- end /.box-collapse -->

                </div>


                <!-- Arrangement Information【Req Seq No:XXXXXXXXXXX】 -->
                <div class="box-accordion in mb10">
                    <div class="accordion-header box-header mb05">
                        <h2 class="box-title">Arrangement Information【Req Seq No:{{ $BkgData->req_seq_no }}】</h2>
                        <a href="javascript:void(0);" class="btn-opened" title="Down Up"></a>
                    </div><!-- end /.accordion-header -->

                    <div class="box-collapse">

                        <div class="clearfix">
                            <div class="pull-left form-inline">
                                <button type="button" name="" value=""
                                        class="btn btn-danger btn-sm">Que ({{ $BkgDataHistory->count() }})</button>
                                @if( $BkgData->mybus_no_show_fg )
                                    <button type="button" name="" value=""
                                            class="btn btn-primary btn-sm" disabled>NO-SHOW</button>
                                @else
                                    <button type="button" name="" value=""
                                            class="btn btn-primary btn-sm btn-show-panel btnNoShow"
                                            data-url="{{ route('superstar.booking.detail.no-show',
                                            [ $BkgData->tour_no, $BkgData->bkg_seq_no, $BkgData->req_seq_no ]) }}">
                                        NO-SHOW
                                    </button>
                                @endif
                                <?php
                                $disabled = ' disabled';
                                if (($BkgData->bkg_source == 'HIOP' || $BkgData->bkg_source == 'B2B2C')
                                    && $BkgData->pay_status === 'REFUND' && $BkgData->status == 'XC') {
                                    $disabled = '';
                                } elseif ($BkgData->bkg_source == 'MyBus' && $BkgData->pay_status === 'INVOICE'
                                    && ($BkgData->mybus_nocharge_fg == 0 || $BkgData->mybus_nocharge_fg == null)
                                    && $BkgData->status == 'XC') {
                                    $disabled = '';
                                }
                                ?>
                                <button type="button" id="xc_refund"
                                        class="btn btn-primary btn-sm btn-show-panel"{{$disabled}}>XC Refund</button>
                            </div><!-- end /.text-right -->
                            <div class="pull-right">
                                <button data-url="{{ route('superstar.booking.detail.referring',
                                [$BkgData->tour_no]) }}"
                                        type="button" class="btn btn-primary mb05 btn-show-panel"
                                        id="btnShowSelectReferringBookingPanel">Referring Booking</button>
                                @if( $BkgData->bkg_source == 'HIOP' )
                                        <!--  [S056-1]New Hawaii Option. -->
                                <a target="_blank" href="{{ route('superstar.booking.hiop-message.edit') }}"
                                   class="btn btn-primary mb05">Reply Message</a>
                                @elseif( $BkgData->bkg_source == 'MyBus' )
                                        <!--  [S056-2]MyBusWeb. -->
                                <a target="_blank" href="{{ route('superstar.booking.mybus-message.edit') }}"
                                   class="btn btn-primary mb05">Reply Message</a>
                                @elseif( $BkgData->bkg_source == 'B2B' )
                                        <!--  [S056-3]B2B. -->
                                <a target="_blank" href="{{ route('superstar.booking.b2b-message.edit') }}"
                                   class="btn btn-primary mb05">Reply Message</a>
                                @else
                                    <button type="button" class="btn btn-primary mb05" disabled>Reply Message</button>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-form mb0">
                                <thead>
                                <tr>
                                    <th class="w10px pr10">Bkg Status</th>
                                    <th class="w10px pr10">Msg(TOGO)</th>
                                    <th class="w10px pr10">Queue PIC</th>
                                    <th class="w10px">Process Date</th>
                                    <th class="w10px pr10">TOGO INV</th>
                                    <th class="w10px pr10">TOGO PreBook</th>
                                    <th class="w10px pr10">Reassigned</th>
                                    <th class="w10px pr10">Reassigment Complete</th>
                                    <th class="w10px pr10">Restate Date For Que</th>
                                    <th>Final List Sent(Output) Day & Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">{{ $BkgData->queue_bkg_status }}</td>
                                    <td class="text-center">{{ $BkgData->que_msg }}</td>
                                    <td>
                                        <select class="selectpicker" data-width="100%" data-container="body"
                                                id="" name="queue_pic">
                                            <option value="">Not Assigned</option>
                                            @foreach ($accountArr as $data)
                                                <option value="{{ $data->id }}"
                                            {{ ($BkgData->ss_account_id==$data->id)?'selected':'' }}>
                                            {{ $data->user_nm }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="nowrap">
                                        {{ $BkgData->status_ok_tm??$BkgData->status_uc_tm??$BkgData->status_xl_tm }}
                                    </td>
                                    <td>
                                        @if( $BkgData->bkg_source == 'TOGO' )
                                            <select class="selectpicker show-tick" data-width="100%"
                                                    data-container="body" id="" name="inv_fg">
                                                <option value="N" {{ ($BkgData->inv_fg=='N')?'selected':'' }}>
                                                NONE
                                                </option>
                                                <option value="I" {{ ($BkgData->inv_fg=='I')?'selected':'' }}>
                                                INVOICE
                                                </option>
                                                <option value="S" {{ ($BkgData->inv_fg=='S')?'selected':'' }}>
                                                SPOT
                                                </option>
                                            </select>
                                        @else
                                            <select class="selectpicker show-tick" data-width="100%" disabled>
                                                <option value="">NONE</option>
                                            </select>
                                        @endif
                                    </td>

                                    <td class="text-center">{{ ($BkgData->bkg_source == 'TOGO'
                                        ||$BkgData->bkg_source == 'LOOK')?'YES':'NO' }}</td>
                                    <td class="text-center">{{ $BkgData->reassignment_fg?'YES':'NO' }}</td>
                                    <td class="nowrap">{{ Carbon\Carbon::parse($BkgData->reassignment_datetime)
                                        ->format('m/d/Y H:s:i') }}</td>
                                    <td>
                                        <input type="text" name=""
                                               value="{{ Carbon\Carbon::parse($BkgData->bkg_wait_date_to)
                                               ->format('m/d/Y') }}"
                                               class="form-control w100px" data-inputmask="'alias': 'mm/dd/yyyy'">
                                    </td>
                                    @if( $BkgData->dispatch_out_fg )
                                        <td>{{ Carbon\Carbon::parse($BkgData->dispatch_out_time)
                                            ->format('m/d/Y H:s:i') }} (Hidden)</td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- end /.table-responsive -->
                        @if( $BkgData->bkg_source == 'MyBus' )
                            <div class="form-group wp100">
                                <label>MyBus Items</label>
                                <div class="clearfix">
                                    <div class="table-responsive">
                                        <table class="table table-customize">
                                            <thead>
                                            <tr>
                                                <th class="w210px">Member Management Info</th>
                                                <th class="w160px">Member Info</th>
                                                <th>Address</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><input type="text" name="mybus_member_management_info"
                                                           value="{{ old('mybus_member_management_info',
                                                           $TourBaseData->mybus_member_management_info ) }}"
                                                           class="form-control" maxlength="100"></td>
                                                <td><input type="text" name="mybus_member_info"
                                                           value="{{ old('mybus_member_info',
                                                           $TourBaseData->mybus_member_info ) }}"
                                                           class="form-control" maxlength="20"></td>
                                                <td><input type="text" name="mybus_adress"
                                                           value="{{ old('mybus_adress', $ClientHtl->mybus_adress ) }}"
                                                           class="form-control" maxlength="200"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- end /.table-responsive -->

                                    <div class="table-responsive">
                                        <table class="table table-customize">
                                            <thead>
                                            <tr>
                                                <th>Destination Contact</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><input type="text" name="stay_info"
                                                           value="{{ old('stay_info',
                                                           $BkgEmergencyContact->stay_info ) }}"
                                                           class="form-control" maxlength="500"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- end /.table-responsive -->

                                    <div class="table-responsive">
                                        <table class="table table-customize">
                                            <thead>
                                            <tr>
                                                <th>Domestic Contact Name</th>
                                                <th>Domestic Contact Info</th>
                                                <th class="w120px">Arrange CD</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><input type="text" name="booking_emergency_contact_name"
                                                           value="{{ old('booking_emergency_contact_name',
                                                           $BkgEmergencyContact->name ) }}" class="form-control"
                                                           maxlength="50"></td>
                                                <td><input type="text" name="booking_emergency_contact_tel"
                                                           value="{{ old('booking_emergency_contact_tel',
                                                           $BkgEmergencyContact->tel ) }}" class="form-control"
                                                           maxlength="50"></td>
                                                <td><input type="text" name="mybus_arrange_office_cd"
                                                           value="{{ old('mybus_arrange_office_cd',
                                                           $BkgData->mybus_arrange_office_cd ) }}" class="form-control"
                                                           maxlength="10"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- end /.table-responsive -->
                                </div>
                            </div>
                        @endif

                        <div class="box-accordion in mb10">
                            <div class="accordion-header box-header mb05">
                                <h3 class="box-title">CXL PCY (SUP)</h3>
                                <a href="javascript:void(0);" class="btn-opened" title="Down Up"></a>
                            </div><!-- end /.accordion-header -->

                            <div class="box-collapse">

                                <div class="clearfix">
                                    <p>{!! nl2br($TrfData->cxl_pcy_for_sup_text) !!}</p>
                                </div>

                            </div><!-- end /.box-collapse -->

                        </div><!-- end /.box-accordion -->

                        <div class="form-group">
                            <div class="label-group">
                                <label>Current Booking Message</label>
                            </div>
                            <div class="clearfix">
                                @if($Remarks != null)
                                <span class="qTip-Title"
                                    data-title="{{ $Remarks->gpic_message }}">
                                    {!! str_limit(nl2br($Remarks->gpic_message), 2000) !!}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label-group">
                                <label>Booking Message</label>
                            </div>
                            <textarea class="form-control" id="" name="gpic_message" rows="5"
                                      placeholder="">{{ old('gpic_message') }}</textarea>
                        </div>
                    </div><!-- end /.box-collapse -->

                </div><!-- end /.box-accordion -->

                <!-- OP Service Booking -->

                <div class="box-header mb05">
                    <h2 class="box-title">OP Service Booking : Status
                        <button class="btn btn-primary btn-xs" type="button" data-toggle="modal"
                                data-target="#NB1">{{ $BkgData->status }}</button>
                    </h2>
                </div>

                <div class="clearfix mb10">
                    <p class="text-bold pull-left">Booking Seq: {{ $BkgData->bkg_seq_no }} &nbsp;
                        @if( $ivtOneSHOT != null && $ivtOneSHOT->ok_by_nm == null && $ivtOneSHOT->cxl_ok_by_nm == null )
                            <span class="text-red">CONFIRMED by CallVendor</span>
                        <span>{{ Carbon\Carbon::parse($BkgData->status_ok_tm)->format('m/d/Y H:s') }}</span>
                        @else
                            <span class="text-red">CONFIRMED</span>
                        <span>{{ Carbon\Carbon::parse($BkgData->status_ok_tm)->format('m/d/Y H:s') }}</span>
                        @endif
                        &nbsp;
                        @if( $BkgData->status == 'XL' )
                            (<span class="text-red">CANCELLED</span>
                        <span>{{ Carbon\Carbon::parse($BkgData->status_xl_tm)->format('m/d/Y H:s') }}</span>)
                        @endif
                    </p>

                    {{--*/
                        $_strLang = '';
                        // Check
                        if( $BkgData->mst_b2c_lang_cd == 'jp' ) {
                            $_strLang = 'JPN';
                        } elseif( $BkgData->mst_b2c_lang_cd == 'en' ){
                            $_strLang = 'ENG';
                        }
                    /*--}}
                    <p class="text-bold pull-right">Lang: {{ $_strLang }}
                    </p>
                    <p class="text-bold pull-right mr20">
                        LK UKETSUKE No: {{ isset($ClientHtl->pnr_acceptance_no)?$ClientHtl->pnr_acceptance_no:'' }}</p>
                    <p class="text-bold pull-right mr20">LK No: {{ $BkgData->tour_id }}</p>
                </div>

                <div class="form-collapse2">
                    <div class="table-responsive">
                        <table class="table table-form mb05">
                            <thead>
                            <tr>
                                <th class="w60px"><label>Tariff City</label> <span class="required"></span></th>
                                <th class="w10px"><label>Type</label> <span class="required"></span></th>
                                <th class="w100px"><label>Tariff Code</label> <span class="required"></span></th>
                                <th class="w150px"><label>SVC Date</label> <span class="required"></span></th>
                                <th class="w10px"><label>SVC Time</label></th>
                                <th class="w10px pr20"><label>MLC</label></th>
                                <th class="w100px"><label>P/U Loc</label></th>
                                <th class="w10px"><label>P/U Time</label></th>
                                <th class="w10px"><label>Total Pax</label></th>
                                <th class="w10px"><label>Total Price</label></th>
                                <th><label>Pay Status</label></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <select class="selectpicker show-tick" data-width="100%" name="tariff_city"
                                            id="tariff_city" data-container="body" disabled>
                                        <option value="{{ $BkgData->trf_cd_cty }}">{{ $BkgData->trf_cd_cty }}</option>
                                    </select>
                                </td>
                                <td><input type="text" name="tariff_type" id="tariff_type"
                                           value="{{ $BkgData->trf_cd_tp }}" class="form-control w40px" disabled ></td>
                                <td><input type="text" name="tariff_code" id="tariff_code"
                                           value="{{ $BkgData->trf_cd }}" class="form-control" disabled
                                           data-url="{{ route('superstar.booking.detail.search-op-service') }}"></td>
                                <td>
                                    <select class="selectpicker show-tick" id="SVC_date" data-width="100%"
                                            data-container="body" disabled data-live-search="true"
                                            data-url="{{ route('superstar.booking.detail.select-service-date') }}"
                                            data-current="{{ $BkgData->svc_date }}">
                                        <option value="{{ Carbon\Carbon::parse($BkgData->svc_date)->format('m/d/Y') }}">
                                            {{ Carbon\Carbon::parse($BkgData->svc_date)->format('m/d/Y D') }}
                                        </option>
                                    </select>
                                    <input type="hidden" id="svc_date" value="{{ $BkgData->svc_date }}">
                                </td>
                                <td class="form-inline nowrap btn-group-action-style">
                                    <input type="text" name="svc_time"
                                           value="{{ old('svc_time', $BkgData->svc_tm_fm) }}"
                                           class="form-control w80px time-hhmm" placeholder="HH:MM" maxlength="5">
                                    @if (!empty($ivtOneSHOT->ok_by_nm))
                                        <?php
                                        $reconfirm_datetime = '';
                                        if (isset($ivtOneSHOT->reconfirm_datetime)
                                            && $ivtOneSHOT->reconfirm_datetime != '') {
                                            $reconfirm_datetime =
                                                date('m/d/y H:i', strtotime($ivtOneSHOT->reconfirm_datetime));
                                        }
                                        ?>
                                        @if (count($arrOptourPrice['data']) == 0)
                                            <button type="button"
                                                    class="btn btn-style2 btn-edit
                                                    qTip-Call-Service-Booking btn-show-panel btn-Save"
                                                    name="" data-ok_by_nm="{{$ivtOneSHOT->ok_by_nm}}"
                                                    data-reconfirm_by_nm="{{$ivtOneSHOT->reconfirm_by_nm}}"
                                                    data-reconfirm_datetime="{{$reconfirm_datetime}}"
                                                    data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                                    data-tour_no="{{$BkgData->tour_no}}"
                                                    data-req_seq_no="{{$BkgData->req_seq_no}}"
                                                    data-px_tp="{{$TrfData->rt_ety_tp}}" disabled >
                                                <i class="fa fa-phone fa-rotate-270"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-style2
                                            btn-edit qTip-Call-Service-Booking btn-show-panel btn-Save"
                                                    id="btCallVendorBookingChange" name="btCallVendorBookingChange"
                                                    data-ok_by_nm="{{$ivtOneSHOT->ok_by_nm}}"
                                                    data-reconfirm_by_nm="{{$ivtOneSHOT->reconfirm_by_nm}}"
                                                    data-reconfirm_datetime="{{$reconfirm_datetime}}"
                                                    data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                                    data-tour_no="{{$BkgData->tour_no}}"
                                                    data-req_seq_no="{{$BkgData->req_seq_no}}"
                                                    data-px_tp="{{$TrfData->rt_ety_tp}}" >
                                                <i class="fa fa-phone fa-rotate-270"></i>
                                            </button>

                                        @endif
                                    @else
                                        @if ($TrfData->trf_op_option == 'all_req')
                                            <label class="label-phone-default">
                                                <i class="fa fa-phone fa-rotate-270"></i></label>
                                        @endif
                                    @endif
                                </td>

                                {{--@if( old('pu_mlc', $MltPup->count()) )--}}
                                {{--<td><input type="checkbox" name="pu_mlc" value="1" class="mb10"
                                    {{ old('pu_mlc', $MltPup->count())?'checked':'' }}></td>--}}

                                {{--<td>--}}
                                {{--<select class="selectpicker show-tick" data-width="100%"
                                            data-container="body" id="" name="pickup_loc_cd">--}}
                                {{--<option value="AAA" {{ old('pickup_loc_cd', $OpTourClient->pickup_loc_cd) }}>
                                        AAAA
                                        </option>--}}
                                {{--</select>--}}
                                {{--</td>--}}
                                {{--<td>{{ old('pickup_time', $OpTourClient->pickup_time) }}</td>--}}
                                {{--@else--}}
                                <td>
                                    @if( $BkgData->bkg_source == 'MyBus' )
                                        <input type="checkbox" id="pu_mlc" name="pu_mlc" value="1"
                                               class="mb10" disabled>
                                    @else
                                        <input type="checkbox" id="pu_mlc" name="pu_mlc" value="1" class="mb10">
                                    @endif
                                </td>

                                <td>
                                    <select class="selectpicker show-tick pickup_loc_cd" data-width="100%"
                                            data-container="body" data-title=""
                                            id="" name="pickup_loc_cd">
                                        @foreach( $puLocation as $location )
                                        <option value="{{ $location->pickup_loc_cd }}"
                                        {{ (old('pickup_loc_cd',
                                        $OpTourClient->pickup_loc_cd)==$location->pickup_loc_cd)?'selected':'' }}>
                                        {{ $location->pickup_loc_cd }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="pickup_time" value="" id=""
                                           class="form-control w80px" placeholder="" disabled></td>
                                {{--@endif--}}

                                <td class="text-center" id="total_pax"></td>
                                <td class="nowrap pr20 {{$BkgData->pay_status}}" id="total_price">USD {{ $BkgData->grs }}</td>
                                <td>
                                    <select class="selectpicker show-tick" data-width="120px"
                                            data-container="body" id="" name="pay_status">
                                        <option value="COLLECT"
                                        {{ (old('pay_status', $BkgData->pay_status)=='COLLECT')?'selected':'' }}>
                                        COLLECT
                                        </option>
                                        <option value="REFUND"
                                        {{ (old('pay_status', $BkgData->pay_status)=='REFUND')?'selected':'' }}>
                                        REFUND
                                        </option>
                                        <option value="REFUNDED"
                                        {{ (old('pay_status', $BkgData->pay_status)=='REFUNDED')?'selected':'' }}>
                                        REFUNDED
                                        </option>
                                        <option value="AUTH"
                                        {{ (old('pay_status', $BkgData->pay_status)=='AUTH')?'selected':'' }}>AUTH
                                        </option>
                                        <option value="INVOICE"
                                        {{ (old('pay_status', $BkgData->pay_status)=='INVOICE')?'selected':'' }}>INVOICE
                                        </option>
                                        <option value="PAID"
                                        {{ (old('pay_status', $BkgData->pay_status)=='PAID')?'selected':'' }}>PAID
                                        </option>
                                        <option value="VOID"
                                        {{ (old('pay_status', $BkgData->pay_status)=='VOID')?'selected':'' }}>VOID
                                        </option>
                                        <option value="CCDECLINE"
                                        {{ (old('pay_status', $BkgData->pay_status)=='CCDECLINE')?'selected':'' }}>
                                        CCDECLINE
                                        </option>
                                        <option value="NONE"
                                        {{ (old('pay_status', $BkgData->pay_status)=='NONE')?'selected':'' }}>NONE
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- end /table -->

                    <div class="row-gird clearfix mb10 mt10">
                        <label>Tariff Name: {{ $TrfData->trf_cd_nm }} {{ $TrfData->rt_ety_tp }}</label>
                    </div><!-- end /.row-gird -->
                    <div class="row-gird clearfix">
                        <div class="form-group w400px">
                            <div class="table-responsive bg-mybus" id="containerOptourPrice">
                                <table class="table table-no-border mb0" id="tbOptourPrice">
                                    <thead>
                                    <tr>
                                        <th colspan="1" id="Amount">Amount</th>
                                        <th colspan="3" class="text-right" id="spot_refund">
                                            <button type="button" disabled
                                                class="btn btn-primary btn-sm btn-show-panel"
                                                id="btnSpotPriceCreate"
                                                data-url="{{
                                                route('superstar.booking.detail.spot-price-partial-refund-create')
                                                }}">
                                                Spot / Prtl Rfnd
                                            </button>
                                        </th>
                                    </tr>
                                    <tr id="headerAmountTitle"></tr>
                                    </thead>
                                    <tbody id="tableOptourPrice_tbody"></tbody>
                                    <tfoot id="tableOptourPrice_tfoot"></tfoot>
                                </table>
                            </div><!-- end /.table-responsive -->
                        </div>

                        <div class="form-group" style="vertical-align: top;">
                            <div class="form-group w220px" style="vertical-align: top;">
                                <div class="label-group">
                                    <label>Campaign Code</label>
                                </div>
                                <div class="clearfix form-inline">
                                    <input type="hidden" id="campaign_code_old" name="campaign_code_old"
                                           value="{{ $CampBase?$CampBase->cam_title:'' }}">
                                    <input type="text" id="campaign_code" name="campaign_cd"
                                           value="{{ old('campaign_cd', $BkgData->campaign_cd) }}"
                                           class="form-control w140px  half-size" placeholder="" maxlength="15">
                                    <button type="button" id="set_campaign_code"
                                            data-url={{ route('superstar.booking.detail.set-campaign-code') }}
                                                    data-tariff-city={{ $BkgData->trf_cd_cty }}
                                                    data-tariff-type={{ $BkgData->trf_cd_tp }}
                                                    data-tariff-code={{ $BkgData->trf_cd }}
                                                    name="" value="" class="btn btn-primary btn-sm">Set</button>
                                </div>
                                <p class="clearfix">
                                    <label>Campaign Name</label>
                                @if($CampBase)
                                    <p id="campaign_name">
                                        {{ $CampBase->cam_title }}
                                    </p>
                                    @endif
                                    </p>
                            </div><!-- end /.form-group -->

                            @if( $BkgData->bkg_source == 'MyBus' )
                                <div class="form-group w300px" style="display: none">
                                    <div class="table-responsive bg-look">
                                        <table class="table table-no-border mb0">
                                            <thead>
                                            <tr>
                                                <th colspan="3">
                                                    <button type="button" name="" value=""
                                                            class="btn btn-primary btn-sm" id="btnMLCPU"          
                                                            data-trf_cd_cty="{{$BkgData->trf_cd_cty}}"
                                                            data-trf_cd_tp="{{$BkgData->trf_cd_tp}}"
                                                            data-trf_cd="{{$BkgData->trf_cd}}"
                                                            data-tour_no="{{$BkgData->tour_no}}"
                                                            data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                                            data-req_seq_no="{{$BkgData->req_seq_no}}" >
                                                        MLC P/U
                                                    </button>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="w90px">MLC P/U Loc</th>
                                                <th class="w90px">P/U Time</th>
                                                <th class="w90px">Pax</th>
                                                <th>Representative</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (count($infoMLCPU) > 0)
                                                @foreach ($infoMLCPU as $val)
                                                    <tr class="mlcpu_st_load_row">
                                                        <td>{{$val->pickup_loc_cd}}
                                                            <input type ="hidden" name="mlc_pu[pickup_loc_cd][]"
                                                                   value="{{$val->pickup_loc_cd}}">
                                                        </td>
                                                        <td>{{$val->pickup_time}}
                                                            <input type ="hidden" name="mlc_pu[pickup_time][]"
                                                                   value="{{$val->pickup_time}}">
                                                        </td>
                                                        <td>{{$val->pax_cnt}}
                                                            <input type ="hidden" name="mlc_pu[pax_cnt][]"
                                                                   value="{{$val->pax_cnt}}">
                                                        </td>
                                                        <td>{{$val->representative}}</td>
                                                        <td hidden>{{$val->representative_client_id}}
                                                            <input type ="hidden"
                                                                   name="mlc_pu[representative_client_id][]"
                                                                   value="{{$val->representative_client_id}}">
                                                        </td><!--Representative-->

                                                        <td hidden>
                                                            <option value="" selected>Please select value</option>
                                                            @if(count($puLocation) > 0)
                                                            @foreach ($puLocation as $val_pul)
                                                                @if ($val_pul->pickup_loc_cd == $val->pickup_loc_cd)
                                                                    <option value="{{$val_pul->pickup_loc_cd}}"
                                                                            selected>
                                                                        {{$val_pul->pickup_loc_cd}}
                                                                    </option>
                                                                @else
                                                                    <option value="{{$val_pul->pickup_loc_cd}}">
                                                                        {{$val_pul->pickup_loc_cd}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                        <td hidden>
                                                            <option value="" selected>Please select value</option>
                                                            @if(count($listRepresentative) > 0)
                                                            @foreach ($listRepresentative as $val_re)
                                                                @if ($val_re->id == $val->representative_client_id)
                                                                    <option value="{{$val_re->id}}" selected>
                                                                        {{$val_re->representative}}</option>
                                                                @else
                                                                    <option value="{{$val_re->id}}">
                                                                        {{$val_re->representative}}</option>
                                                                @endif
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div><!-- end /.table-responsive -->
                                </div><!-- end /.form-group -->
                            @else
                                <div class="form-group w300px">
                                    <div class="table-responsive bg-look">
                                        <table class="table table-no-border mb0" id="tbMLCPUSettingLoad">
                                            <thead>
                                            <tr>
                                                <th colspan="3">
                                                    <button type="button" name="" value=""
                                                        class="btn btn-primary btn-sm" id="btnMLCPU"                                                       
                                                        data-trf_cd_cty="{{$BkgData->trf_cd_cty}}"
                                                        data-trf_cd_tp="{{$BkgData->trf_cd_tp}}"
                                                        data-trf_cd="{{$BkgData->trf_cd}}"
                                                        data-tour_no="{{$BkgData->tour_no}}"
                                                        data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                                        data-req_seq_no="{{$BkgData->req_seq_no}}"
                                                        disabled="disabled" >MLC P/U</button></th>
                                            </tr>
                                            <tr>
                                                <th class="w90px">MLC P/U Loc</th>
                                                <th class="w90px">P/U Time</th>
                                                <th class="w90px">Pax</th>
                                                <th>Representative</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (count($infoMLCPU) > 0)
                                                @foreach ($infoMLCPU as $val)
                                                    <tr class="mlcpu_st_load_row">
                                                        <td>{{$val->pickup_loc_cd}}
                                                            <input type ="hidden" name="mlc_pu[pickup_loc_cd][]"
                                                                   value="{{$val->pickup_loc_cd}}">
                                                        </td>
                                                        <td>{{$val->pickup_time}}
                                                            <input type ="hidden" name="mlc_pu[pickup_time][]"
                                                                   value="{{$val->pickup_time}}">
                                                        </td>
                                                        <td>{{$val->pax_cnt}}
                                                            <input type ="hidden" name="mlc_pu[pax_cnt][]"
                                                                   value="{{$val->pax_cnt}}">
                                                        </td>
                                                        <td>{{$val->representative}}</td>
                                                        <td hidden>{{$val->representative_client_id}}
                                                            <input type ="hidden"
                                                                   name="mlc_pu[representative_client_id][]"
                                                                   value="{{$val->representative_client_id}}">
                                                        </td><!--Representative-->
                                                        <td hidden>
                                                            <option value="" selected>Please select value</option>
                                                            @if(count($puLocation) > 0)
                                                            @foreach ($puLocation as $val_pul)
                                                                @if ($val_pul->pickup_loc_cd == $val->pickup_loc_cd)
                                                                    <option value="{{$val_pul->pickup_loc_cd}}"
                                                                            selected>
                                                                        {{$val_pul->pickup_loc_cd}}
                                                                    </option>
                                                                @else
                                                                    <option value="{{$val_pul->pickup_loc_cd}}">
                                                                        {{$val_pul->pickup_loc_cd}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                        <td hidden>
                                                            <option value="" selected>Please select value</option>
                                                            @if(count($listRepresentative) > 0)
                                                            @foreach ($listRepresentative as $val_re)
                                                                @if ($val_re->id == $val->representative_client_id)
                                                                    <option value="{{$val_re->id}}" selected>
                                                                        {{$val_re->representative}}
                                                                    </option>
                                                                @else
                                                                    <option value="{{$val_re->id}}">
                                                                        {{$val_re->representative}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div><!-- end /.table-responsive -->
                                </div><!-- end /.form-group -->
                            @endif

                            @if( $TrfData->kumikomi_fg == 1
                                    && $BkgData->upgrade_trf_cd_cty == ''
                                    && $BkgData->upgrade_trf_cd_tp == ''
                                    && $BkgData->upgrade_trf_cd == ''
                                    && $BkgData->upgrade_datetime_hst !='')
                                <p style="vertical-align: bottom;">KUMIKOMI <span class="text-red">Canceled
                                        {{ Carbon\Carbon::parse($BkgData->upgrade_datetime_hst)
                                        ->format('m/d/Y H:i:s') }}</span></p>
                            @elseif( $TrfData->kumikomi_fg == 1
                                    && $BkgData->upgrade_trf_cd_cty != ''
                                    && $BkgData->upgrade_trf_cd_tp != ''
                                    && $BkgData->upgrade_trf_cd != ''
                                    && $BkgData->upgrade_datetime_hst !='')
                                <p style="vertical-align: bottom;">KUMIKOMI <span class="text-red">
                                        Upgrade to {{ $BkgData->upgrade_trf_cd }}(Tariff Code)
                                        {{ Carbon\Carbon::parse($BkgData->upgrade_datetime_hst)
                                        ->format('m/d/Y H:i:s') }}</span></p>
                            @elseif( $TrfData->kumikomi_fg == 1 )
                                <p style="vertical-align: bottom;">KUMIKOMI</p>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive box-style2 p0">
                        <table class="table table-no-border table-padding-xs" id="PaxSection">
                            <thead>
                            <tr>
                                <th class="w10px">Client ID</th>
                                <th class="w10px">P No.</th>
                                <th class="w10px">ID No.</th>
                                <th class="w150px">Last Name</th>
                                <th class="w150px">First Name</th>
                                <th class="w70px">Title</th>
                                <th class="w10px">Age</th>

                                <th class="w10px">P/U Loc</th>
                                <th class="w10px nowrap">Middle Name or Initial<br>If Listed on Passport</th>
                                <th class="w130px">Date of Birth</th>
                                <th class="w10px pr20">Non<br>Representive</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="showTourClient">
                            <?php $i = 0; ?>
                            @foreach( $TourClients as $key => $tourClient )
                                <tr {{ $tourClient->head_of_manifest_fg == 0 ? "style=display:none" : "" }}>
                                    <td>@if($BkgData->bkg_source == 'LocalSales') S @endif {{ $tourClient->id }}</td>
                                    <td><input type="text" readonly="readonly" name="pdsInfo[client][{{ $i }}][p_no]"
                                               value="{{ old('p_no', $tourClient->p_no) }}"
                                               class="form-control w50px half-size" maxlength="4"></td>
                                    <td><input type="text" readonly="readonly" name="pdsInfo[client][{{ $i }}][id_no]"
                                               value="{{ old('id_no', $tourClient->id_no) }}"
                                               class="form-control w70px half-size" maxlength="5"></td>
                                    <td><input type="text" readonly="readonly"
                                               name="pdsInfo[client][{{ $i }}][last_nm]"
                                               value="{{ old('last_nm', $tourClient->last_nm) }}"
                                               class="form-control half-size" maxlength="15"></td>
                                    <td><input type="text" readonly="readonly"
                                               name="pdsInfo[client][{{ $i }}][first_nm]"
                                               value="{{ old('first_nm', $tourClient->first_nm) }}"
                                               class="form-control half-size" maxlength="15"></td>
                                    <td>
                                        <input type="text" readonly="readonly"
                                               name="pdsInfo[client][{{ $i }}][title]"
                                               value="{{ old('title', $tourClient->title) }}"
                                               class="form-control half-size" maxlength="15"></td>
                                    </td>
                                    <td><input type="text" readonly="readonly" name="pdsInfo[client][{{ $i }}][age]"
                                               value="{{ old('age', $tourClient->age) }}" class="form-control w30px"
                                               maxlength="3"></td>

                                    <td>
                                        <select class="selectpicker show-tick pickup_loc_cd"
                                                name="pdsInfo[client][{{ $i }}][pickup_loc_cd]" data-width="100%"
                                                data-container="body" readonly="readonly">
                                            <option value="tba"
                                            @if (isset($location->pickup_loc_cd) && $location->pickup_loc_cd == 'tba')
                                            selected="selected" @endif>TBA</option>
                                            @if ($puLocation)
                                                @foreach ($puLocation as $location)
                                                    <option @if (isset($location->pickup_loc_cd)
                                            && $location->pickup_loc_cd == $tourClient->pickup_loc_cd)
                                            selected="selected" @endif value="{{ $location->pickup_loc_cd }}">
                                            {{ $location->pickup_loc_cd }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td><input type="text" readonly="readonly"
                                               name="pdsInfo[client][{{ $i }}][middle_nm]"
                                               value="{{ old('middle_nm', $tourClient->middle_nm) }}"
                                               class="form-control half-size" maxlength="15"></td></td>
                                    <td><input type="text" readonly="readonly"
                                               value="{{ old('birth',
                                                Carbon\Carbon::parse($tourClient->birth)->format('m/d/Y')) }}"
                                               class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'"
                                               name="pdsInfo[client][{{ $i }}][birth]"></td>
                                    
                                        <td>
                                            <input type="checkbox" class="check-manifest" {{ $tourClient->head_of_manifest_fg == 0 ? "checked" : "" }}>
                                            <input type="hidden" name="pdsInfo[client][{{ $i }}][head_of_manifest_fg]" class="head_of_manifest_fg" value="{{ $tourClient->head_of_manifest_fg }}">
                                        </td>
                                                                     

                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="button" id="btnPaxDetailSetting"
                                class="btn btn-primary btn-sm">PAX Detail Setting</button>
                    </div><!-- end /table -->


                    <div class="form-group wp100">
                        <label>Remark for JHI</label>
                        <div class="clearfix">
                            <textarea name="remarks_for_jhi" id="remarks_for_jhi"
                                      cols="" rows="3" class="form-control"
                                      style="max-width: 100%;"
                                      maxlength="2000">{{ old('remarks_for_jhi',
                                $Remarks->remarks_for_jhi??'') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group wp100">
                        <label>Remark for CS</label>
                        <div class="clearfix">
                            <textarea name="remarks_for_cs" id="" cols="" rows="3" class="form-control"
                                      style="max-width: 100%;" maxlength="2000">{{ old('remarks_for_cs',
                                $Remarks->remarks_for_cs??'') }}</textarea>

                        </div>
                    </div>
                    <div class="form-group wp100">
                        <label>Remark for Supplier</label>
                        <div class="clearfix">
                            <textarea name="remarks_for_supplier" id="" cols="" rows="3" class="form-control"
                                      style="max-width: 100%;" maxlength="300">{{ old('remarks_for_supplier',
                                $Remarks->remarks_for_supplier??'') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group wp100">
                        <input type="hidden" name="travel_with_info_hidden"
                               value="{{ old('travel_with_info', $Remarks->travel_with??'') }}">
                        <p class="text-bold">Travel With Info : <span id="travel_with_info_title">
                                {{ old('travel_with_info', $Remarks->travel_with??'') }}</span></p>
                        <p class="text-bold">Inquiry Info : {{ $Remarks->answer_info_ask??'' }}</p>
                    </div>

                    <div class="form-group wp100">
                        <label>Inquiry Request</label>
                        <div class="clearfix">
                            <textarea name="bkg_inquiry" id="" cols="" rows="3" class="form-control"
                                      style="max-width: 100%;" maxlength="2000">
                                {{ old('bkg_inquiry', $Remarks->bkg_inquiry??'') }}</textarea>
                        </div>
                    </div>

                    @if( $TwData->count() )
                        <input type="hidden" name="travel_with_hidden"
                               value="{{ old('travel_with_hidden', $TwData->first()->travel_with_string) }}">
                    @else
                        <input type="hidden" name="travel_with_hidden" value="{{ old('travel_with_hidden') }}">
                    @endif
                    <div class="clearfix mb05">
                        @if( $TwData->count() )
                            <p class="pull-left">
                                <button type="button" name="" value="" class="btn btn-primary btn-show-panel"
                                        id="btnShowSearchTravelWidthPanel"
                                        data-tariff-city={{ $BkgData->trf_cd_cty }}
                                                data-tariff-type={{ $BkgData->trf_cd_tp }}
                                                data-tariff-code={{ $BkgData->trf_cd }}
                                >Travel With</button>
                            </p>
                        @else
                            <p class="pull-left">
                                <button type="button" name="" value="" class="btn btn-primary"
                                                         disabled>Travel With</button></p>
                        @endif
                        <p class="pull-right">

                            @if (count($CxlCharge) > 0)
                                @if (count($arrOptourPrice['data']) > 0)
                                    @if($TrfData->rt_ety_tp == 'A')
                                        <button type="button" name="" value="" class="btn btn-primary"
                                                data-toggle="modal" data-target="#CancelChargeHistoryAGE"
                                                data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                                data-tour_no="{{$BkgData->tour_no}}"
                                                data-req_seq_no="{{$BkgData->req_seq_no}}"
                                                id="btCXLChargeHis" >CXL Charge His</button>
                                    @elseif($TrfData->rt_ety_tp == 'P')
                                        <button type="button" name="" value="" class="btn btn-primary"
                                                data-toggle="modal" data-target="#CancelChargeHistoryPAX"
                                                data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                                data-tour_no="{{$BkgData->tour_no}}"
                                                data-req_seq_no="{{$BkgData->req_seq_no}}"
                                                id="btCXLChargeHis" >CXL Charge His</button>
                                    @elseif($TrfData->rt_ety_tp == 'F')
                                        <button type="button" name="" value="" class="btn btn-primary"
                                                data-toggle="modal" data-target="#CancelChargeHistoryFLT"
                                                data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                                data-tour_no="{{$BkgData->tour_no}}"
                                                data-req_seq_no="{{$BkgData->req_seq_no}}"
                                                id="btCXLChargeHis" >CXL Charge His</button>
                                    @endif
                                @endif
                            @else
                                <button type="button" name="" value="" class="btn btn-primary"
                                        data-toggle="modal" data-target="#CancelChargeHistory"
                                        data-bkg_seq_no="{{$BkgData->bkg_seq_no}}" data-tour_no="{{$BkgData->tour_no}}"
                                        data-req_seq_no="{{$BkgData->req_seq_no}}"
                                        id="btCXLChargeHis" disabled>CXL Charge His</button>
                            @endif

                            @if( $BkgData->status=='XL' || $BkgData->status=='UC')
                                <button disabled type="button" name="" value="" class="btn btn-primary"
                                        data-toggle="modal" data-target="#Confirmation->SVC CXL</button>
                            @else
                                        <button type="button" name="" value="" class="btn btn-primary"
                            data-toggle="modal" data-target="#Confirmation-Before">SVC CXL</button>
                            @endif

                            @if( $BkgData->bkg_source=='TOGO'
                                && $BkgData->tour_id_tp=='L'
                                && $BkgData->send_inv_fg=='T'
                                && $BkgData->inv_fg=='I'
                                && $BkgData->visible_dispach_fg=='0' || 1)
                                <button type="button" name="" value="" class="btn btn-primary" id="btnShowKenriHouki"
                                        data-url="{{ route('superstar.booking.detail.set-kenri-houki') }}"
                                        data-bkg_seq_no="{{$BkgData->bkg_seq_no}}"
                                        data-tour_no="{{$BkgData->tour_no}}"
                                        data-req_seq_no="{{$BkgData->req_seq_no}}"
                                >Kenri Houki</button>
                            @else
                                <button type="button" name="" value="" class="btn btn-primary"
                                        disabled>Kenri Houki</button>
                            @endif

                            @if( $BkgData->bkg_source == 'TOGO'
                                && $BkgData->tour_id_tp == 'L'
                                && $BkgData->inv_fg == 'I' )
                                <button type="button" name="" value="" class="btn btn-primary btn-show-panel"
                                        id="btnShowKenriHoukiUpgradePanel">Upgrade</button>
                            @else
                                <button type="button" name="" value="" class="btn btn-primary" disabled>Upgrade</button>
                                @endif

                                <!-- <button type="button" name="" value="" class="btn btn-primary btn-show-panel"
                                id="btnShowCancelPanel">Bkg Confirm</button> -->
                                <button type="button" name="" value="" class="btn btn-default">Reset</button>
                        </p>
                    </div>

                    <div class="box-footer text-center mb05">
                        @if( $BkgData->dlt_fg == 1 )
                            <button type="button" disabled name="" value=""
                                    class="btn btn-primary w200px btn-show-panel btn-Save">
                                <i class="fa fa-save"></i> Save</button>
                        @else
                            <button type="submit" name="" value="" id='btnSaveBooking'
                                    class="btn btn-primary w200px btn-show-panel-debug btn-Save">
                                <i class="fa fa-save"></i> Save</button>
                        @endif
                    </div>

                </div><!-- end /.form-customize -->

                <div class="box-accordion in">
                    <div class="accordion-header box-header opened mb05">
                        <h2 class="box-title">Booking History</h2>
                        <a href="javascript:void(0);" class="btn-opened" title="Down Up"></a>
                    </div><!-- end /.accordion-header -->

                    <div class="box-collapse">
                        <div class="table-responsive">
                            <table class="table table-customize width-auto">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Bkg</th>
                                    <th>Req Seq No</th>
                                    <th>Pax</th>
                                    <th>Qty</th>
                                    <th>SVC Date</th>
                                    <th>SVC<br>Time</th>
                                    <th>Pay Status</th>
                                    <th>Total Price</th>
                                    <th>Margin</th>
                                    <th>Process<br>Date</th>
                                    <th>Q Date</th>
                                    <th>Reassignment<br>Complete</th>
                                    <th>Confirm<br>Date</th>
                                    <th>Last Update<br>User ID</th>
                                    <th>Last Update<br>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($BkgDataHistory) > 0)
                                    @foreach ( $BkgDataHistory as $booking )
                                        <tr>
                                            <td>{{ $booking->status }}</td>
                                            <td>{{ $booking->queue_bkg_status }}</td>
                                            <td>{{ $booking->req_seq_no }}</td>
                                            {{--*/
                                                $totalPax = array_sum([
                                                    $booking->adl_pax,
                                                    $booking->chl_pax,
                                                    $booking->inf_pax,
                                                    $booking->tc_pax,
                                                    $booking->gd_pax,
                                                    $booking->age_pax_1,
                                                    $booking->age_pax_2,
                                                    $booking->age_pax_3,
                                                    $booking->age_pax_4,
                                                    $booking->age_pax_5,
                                                    $booking->age_pax_6,
                                                    $booking->age_pax_7,
                                                    $booking->age_pax_8
                                                ]);
                                            /*--}}
                                            <td>{{ $totalPax }}</td>
                                            <td>{{ $booking->qty }}</td>
                                            <td>{{ Carbon\Carbon::parse($booking->svc_date)->format('m/d/Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($booking->svc_date)->format('m/d/Y') }}</td>
                                            <td>{{ $booking->pay_status }}</td>
                                            <td>{{ $booking->grs }}</td>
                                            <td>00.00</td>
                                            <td>MM/DD/YYYY</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($booking->created_at_hst)->format('m/d/Y') }}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($booking->reassignment_datetime)
                                                ->format('m/d/Y') }}
                                            </td>
                                            <td>MM/DD/YYYY</td>
                                            <td>{{ $booking->lt_upd_account_cd }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($booking->updated_at_hst)->format('m/d/Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="16">{{ getmessage('A014') }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end /.box-collapse -->

                </div><!-- end /.box-accordion -->

                <div class="clearfix">
                    <p class="pull-left">
                    	<a class="btn btn-primary" href="{{ $listbk }}">
                            <i class="fa fa-long-arrow-left"></i> Go To Booking List</a>
                        <button type="button" name="" value="" class="btn btn-primary">XC SVC Date Change</button>
                    </p>
                    <p class="pull-right">
                        <button type="button" name="" value="" class="btn btn-primary">Go To Customer Sales</button>
                    </p>
                </div>
                @include('superstar.booking-detail.modal.pax-detail-setting')
            </form><!-- end /.bg-b2b mb05 -->

        </div><!-- end /.box-body -->
    </div><!-- end /.box -->
</section>
<!-- end content-main -->

@if (count($arrOptourPrice['data']) > 0)
@include('superstar.booking-detail.hidden.cancellation-history-hidden')
@if($TrfData->rt_ety_tp == 'A')
@include('superstar.booking-detail.partials.a-cancellation-history')
@elseif($TrfData->rt_ety_tp == 'P')
@include('superstar.booking-detail.partials.p-cancellation-history')
@elseif($TrfData->rt_ety_tp == 'F')
@include('superstar.booking-detail.partials.f-cancellation-history')
@endif

@endif
<input type="hidden" id="route-get-hotel-info" value="{{ route('superstar.booking.detail.get-hotel-info') }}">
<input type="hidden" id="route-get-tour-base-info" value="{{ route('superstar.booking.detail.get-tour-base-info') }}">
<input type="hidden" id="route-check-inventory" value="{{ route('superstar.booking.detail.check-inventory') }}">
<input type="hidden" id="route-get-ofc-info" value="{{ route('superstar.booking.detail.get-ofc-info') }}">
<input type="hidden" id="route-ajax-save-pax-tmp" value="{{ route('superstar.booking.detail.ajax-save-pax-tmp') }}">
<input type="hidden" id="route-render-booking-change-slide-panel"
       value="{{ route('superstar.booking.detail.render-booking-change-slide-panel') }}">
<input type="hidden" id="ivt_flag" value="0">
        <!-- All modal -->
@include('superstar.booking-detail.modal.cancellation')
@include('superstar.booking-detail.modal.mlc-pu')
@include('superstar.booking-detail.modal.confirm-cancellation')
@include('superstar.booking-detail.modal.ho-arrangement-email')

@include('superstar.booking-detail.modal.update-status')
@stop

<?php $MstHtlDataJson = json_encode($MstHtlData, true);?>

@section('javascript_page')
<script type="text/javascript" src="{{ asset_url('themes/ss/js/jquery.mask.js') }}"></script>
<script src="{{ asset_url('themes/ss/js/superstar/jquery.number.min.js') }}"></script>
<script src="{{ asset_url('themes/ss/js/superstar/booking_detail.js') }}"></script>
<script type="text/javascript">
    var MstHtlData = '{{ $MstHtlDataJson }}';
    var urlSaveCreditPayment = "{{route('superstar.booking.detail.save-url-credit-payment')}}";
    var urlArrangementEmail = "{{route('superstar.booking.detail.arrangement-email')}}";
    var urlMlcPu = "{{route('superstar.booking.detail.mlc-pu-setting')}}";
    var urlCallVendorBookingChange = "{{route('superstar.booking.detail.booking-change')}}";
    var urlUpdateChangePerPax = "{{route('superstar.booking.detail.ajax-update-change-per-pax')}}";
    var urlMlcPuUpdate = "{{route('superstar.booking.detail.mlc-pu-setting-update')}}";
    var bkChangeGetFLT = "{{route('superstar.booking.detail.bkchange-get-flt')}}";
    var bkchangeUdFLT = "{{route('superstar.booking.detail.bkchange-update-flt')}}";
    var bkchangeGetPAX = "{{route('superstar.booking.detail.bkchange-get-pax')}}";
    var bkchangeUdPAX = "{{route('superstar.booking.detail.bkchange-update-pax')}}";
    var urlUpdateCxlChargeHisAGE = "{{route('superstar.booking.detail.update-cxl-charge-his-age')}}";
    var urlUpdateCxlChargeHisPAX = "{{route('superstar.booking.detail.update-cxl-charge-his-pax')}}";
    var urlUpdateCxlChargeHisFLT = "{{route('superstar.booking.detail.update-cxl-charge-his-flt')}}";
    var urlUpdateOkByName = "{{route('superstar.booking.detail.update-call-vendor')}}";
    var laodCreatePaxDetail = "{{route('superstar.booking.detail.pax-detail-setting.load-create-pax')}}";

    var A015 = "{{ getmessage('A015') }}";
    var A006 = "{{ getmessage('A006') }}";
    var A001 = "{{ getmessage('A001') }}";
    var A013 = "{{ getmessage('A013') }}";
    var A030 = "{{ getmessage('A030') }}";
    var A002 = "{{ getmessage('A002') }}";
    var B243 = "{{ getmessage('B243') }}";
    // Do you want to overwrite it?
    var C007 = "{{ getmessage('C007') }}";
    var C033 = "{{ getmessage('C033') }}";
    var C034 = "{{ getmessage('C034') }}";

    var pickupLocHTMLAfterSelectSVCDate = "";
    $(function () {
        Common.exportVoucher();

        BookingDetail.initBookingDetail({
            'A001' : A001,
            'A013' : A013,
            'A002' : A002,
            'C007' : C007,
            'urlCal': '{{ route("superstar.booking.detail.checked-calculate") }}'
        });

        function changeMailTpl(obj) {
            var selectedD = $(obj).val();
            var subject = $(obj).find('option:selected').data('subject')
            var message = $(obj).find('option:selected').data('message')

            //set value for subject, message
            $('#subject').val(subject);
            $('#message').val(message);
        }

        function saveArrangementEmail() {
            $('div #arrangement_email_error').hide();

            $.ajax({
                url: urlArrangementEmail,
                method: 'POST',
                cache : false,
                data: $("#frmArrangementEmail").serialize(),
                dataType: 'json',
                success: function(response) {
                    if(response.error == '1') {
                        Common.showMessage(A015, {
                            messageId: 'ul#arrangement_email_error',
                            timeout: 0,
                            tagName : '<li />',
                            className: 'error-list mb10 alert alert-dismissable alert-danger'
                        });
                    } else {
                        //close form
                        $("#frmArrangementEmail .close").click();
                        window.location.reload();
                    }
                },
                error: function(response) {
                    Common.showMessage(A015, {
                        messageId: 'ul#arrangement_email_error',
                        timeout: 0,
                        tagName : '<li />',
                        className: 'error-list mb10 alert alert-dismissable alert-danger'
                    });
                }
            });
        }

        function changePaxPrice(obj) {
            $('div #cancell_charge_error').hide();

            var tour_no = obj.dataset.tour_no;
            var bkg_seq_no = obj.dataset.bkg_seq_no;
            var req_seq_no = obj.dataset.req_seq_no;
            var optour_price_id = obj.dataset.optour_price_id;

            //var pax_qty_old = obj.dataset.pax_qty_old;
            //var pax_qty = obj.dataset.pax_qty;

            var paid_per_type = obj.dataset.paid_per_type;
            var after_refund = obj.dataset.after_refund;

            var trf_cty = obj.dataset.trf_cty;
            var trf_tp = obj.dataset.trf_tp;
            var trf_cd = obj.dataset.trf_cd;

            var change_per_pax_qty = obj.dataset.change_per_pax_qty;
            var px_tp = obj.dataset.px_tp;
            var type_amount_rate = obj.dataset.type_amount_rate;
            var cancel_change_per_pax_qty = obj.dataset.cancel_change_per_pax_qty;
            var refund = obj.dataset.refund_price;
            var remark_for_jhi = obj.dataset.remark_for_jhi;
            var cxl_pax_qty = obj.dataset.cxl_pax_qty;
            var price_tp = obj.dataset.price_tp;

            if (px_tp == 'A') {
                var age_fm = obj.dataset.age_fm;
                var age_to = obj.dataset.age_to;
                var grs = obj.dataset.grs;
                var sl_pric = obj.dataset.sl_pric;

                $('#age_fm').val(age_fm);
                $('#age_to').val(age_to);
                $('#grs').val(grs);
                $('#sl_pric').val(sl_pric);

                $("label[for*='change_per_x']").html("Changes(Per Pax)");
                $("label[for*='cancel_charge_per_x']").html("Cancellation Charge(Per Pax)");
            } else if (px_tp == 'FLT') {
                $("label[for*='change_per_x']").html("Changes(Per Qty)");
                $("label[for*='cancel_charge_per_x']").html("Cancellation Charge(Per Qty)");

            }

            //set value for form dialog
            $('#bkg_seq_no').text(bkg_seq_no);
            $('#trf_cty').text(trf_cty);
            $('#trf_tp').text(trf_tp);
            $('#trf_cd').text(trf_cd);

            $('#paid_per_type').text(paid_per_type);
            $('#after_refund').text(after_refund);
            $('#change_per_pax_qty').text(change_per_pax_qty);

            $('#tour_no').val(tour_no);
            $('#bkg_seq_no').val(bkg_seq_no);
            $('#req_seq_no').val(req_seq_no);

            $('#optour_price_id').val(optour_price_id);
            $('#px_tp').val(px_tp);
            $('#cxl_pax_qty').val(cxl_pax_qty);

            if (type_amount_rate == 'A') {
                $('#type_change_a').prop('checked', true);
            } else {
                $('#type_change_r').prop('checked', true);
            }

            $('#changes_per_pax').val(change_per_pax_qty);
            $('#cancellation_charge').val(cancel_change_per_pax_qty);
            $('#refund').val(refund);
            $('#price_tp').val(price_tp);
            $('#remark_for_jhi_span').text(remark_for_jhi);

        }
    });
</script>
@stop