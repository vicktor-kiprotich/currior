@php
    $user_type = Auth::user()->user_type;
    $staff_permission = json_decode(Auth::user()->staff->role->permissions ?? '[]');
@endphp

@if (
    $user_type == 'admin' ||
        in_array('1100', $staff_permission) ||
        in_array('1008', $staff_permission) ||
        in_array('1009', $staff_permission))
    @php
        $all_shipments = App\Shipment::count();
        $pending_shipments = App\Shipment::whereIn('status_id', [App\Shipment::REQUESTED_STATUS, App\Shipment::CAPTAIN_ASSIGNED_STATUS, App\Shipment::RECIVED_STATUS, App\Shipment::RETURNED_STOCK])->count();
        $delivered_shipments = App\Shipment::whereIn('status_id', [App\Shipment::DELIVERED_STATUS, App\Shipment::SUPPLIED_STATUS, App\Shipment::RETURNED_CLIENT_GIVEN])->count();
        
        $all_missions = App\Mission::count();
        $pending_missions = App\Mission::whereIn('status_id', [App\Mission::REQUESTED_STATUS, App\Mission::APPROVED_STATUS, App\Mission::RECIVED_STATUS])->count();
        $pickup_missions = App\Mission::where('type', App\Mission::PICKUP_TYPE)->count();
        $delivery_missions = App\Mission::where('type', App\Mission::DELIVERY_TYPE)->count();
        $transfer_missions = App\Mission::where('type', App\Mission::TRANSFER_TYPE)->count();
        $supply_missions = App\Mission::where('type', App\Mission::SUPPLY_TYPE)->count();
    @endphp

    {{-- Admin With All Permission And Admin With Shipment Index Permission  --}}
    @if ($user_type == 'admin' || in_array('1100', $staff_permission) || in_array('1009', $staff_permission))
        <div class="row">
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Total Shipments Count') }}</a>
                                <span
                                    class="text-muted font-weight-bold mt-2">{{ translate('Count all shipments in the system') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span class="symbol-label font-weight-bolder font-size-h6">{{ $all_shipments }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-primary card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-dark-75 font-weight-bolder font-size-h5">{{ translate('Pending Shipments Count') }}</a>
                                <span
                                    class="text-dark-75 font-weight-bold mt-2">{{ translate('All shipments that need an action to be closed') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span
                                    class="symbol-label font-weight-bolder font-size-h6">{{ $pending_shipments }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-success card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-dark-75 font-weight-bolder font-size-h5">{{ translate('Delivered Shipments Count') }}</a>
                                <span
                                    class="text-dark-75 font-weight-bold mt-2">{{ translate('All shipments which is totally closed') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span
                                    class="symbol-label font-weight-bolder font-size-h6">{{ $delivered_shipments }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
        </div>
    @endif

    {{-- Admin With All Permission And Admin With Missions Index Permission  --}}
    @if ($user_type == 'admin' || in_array('1100', $staff_permission) || in_array('1008', $staff_permission))
        <div class="row">
            <div class="col-xl-6">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Total Missions Count') }}</a>
                                <span
                                    class="text-muted font-weight-bold mt-2">{{ translate('Count all missions in the system') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span class="symbol-label font-weight-bolder font-size-h6">{{ $all_missions }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-6">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-primary card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-dark-75 font-weight-bolder font-size-h5">{{ translate('Pending Missions Count') }}</a>
                                <span
                                    class="text-dark-75 font-weight-bold mt-2">{{ translate('All missions that need an action to be done') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span
                                    class="symbol-label font-weight-bolder font-size-h6">{{ $pending_missions }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Pickup Missions Count') }}</a>
                                <span
                                    class="text-muted font-weight-bold mt-2">{{ translate('Count of pickup missions') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span
                                    class="symbol-label font-weight-bolder font-size-h6">{{ $pickup_missions }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Delivery Missions Count') }}</a>
                                <span
                                    class="text-muted font-weight-bold mt-2">{{ translate('Count of delivery missions') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span
                                    class="symbol-label font-weight-bolder font-size-h6">{{ $delivery_missions }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Transfer Missions Count') }}</a>
                                <span
                                    class="text-muted font-weight-bold mt-2">{{ translate('Count of transfer missions') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span
                                    class="symbol-label font-weight-bolder font-size-h6">{{ $transfer_missions }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>

            <div class="col-xl-3">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-dark card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer">
                            <div class="d-flex flex-column mr-2">
                                <a href="#"
                                    class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Supply Missions Count') }}</a>
                                <span
                                    class="text-muted font-weight-bold mt-2">{{ translate('Count of supply missions') }}</span>
                            </div>
                            <span class="symbol symbol-light-primary symbol-45">
                                <span
                                    class="symbol-label font-weight-bolder font-size-h6">{{ $supply_missions }}</span>
                            </span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
        </div>
    @endif
@elseif($user_type == 'branch')
    @php
        $all_shipments = App\Shipment::where('branch_id', Auth::user()->userBranch->branch_id)->count();
        $pending_shipments = App\Shipment::where('branch_id', Auth::user()->userBranch->branch_id)
            ->whereIn('status_id', [App\Shipment::REQUESTED_STATUS, App\Shipment::CAPTAIN_ASSIGNED_STATUS, App\Shipment::RECIVED_STATUS, App\Shipment::RETURNED_STOCK])
            ->count();
        $delivered_shipments = App\Shipment::where('branch_id', Auth::user()->userBranch->branch_id)
            ->whereIn('status_id', [App\Shipment::DELIVERED_STATUS, App\Shipment::SUPPLIED_STATUS, App\Shipment::RETURNED_CLIENT_GIVEN])
            ->count();
    @endphp

    <div class="row">
        <div class="col-xl-4">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#"
                                class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Total Shipments Count') }}</a>
                            <span
                                class="text-muted font-weight-bold mt-2">{{ translate('Count all shipments in the system') }}</span>
                        </div>
                        <span class="symbol symbol-light-primary symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h6">{{ $all_shipments }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-primary card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder font-size-h5">{{ translate('Pending Shipments Count') }}</a>
                            <span
                                class="text-dark-75 font-weight-bold mt-2">{{ translate('All shipments that need an action to be closed') }}</span>
                        </div>
                        <span class="symbol symbol-light-primary symbol-45">
                            <span class="symbol-label font-weight-bolder font-size-h6">{{ $pending_shipments }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-success card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder font-size-h5">{{ translate('Delivered Shipments Count') }}</a>
                            <span
                                class="text-dark-75 font-weight-bold mt-2">{{ translate('All shipments which is totally closed') }}</span>
                        </div>
                        <span class="symbol symbol-light-primary symbol-45">
                            <span
                                class="symbol-label font-weight-bolder font-size-h6">{{ $delivered_shipments }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
    </div>
@elseif($user_type == 'customer')
    @php
        $all_client_shipments = App\Shipment::where('client_id', Auth::user()->userClient->client_id)->count();
        $saved_client_shipments = App\Shipment::where('client_id', Auth::user()->userClient->client_id)
            ->where('status_id', App\Shipment::SAVED_STATUS)
            ->count();
        $in_progress_client_shipments = App\Shipment::where('client_id', Auth::user()->userClient->client_id)
            ->where('client_status', App\Shipment::CLIENT_STATUS_IN_PROCESSING)
            ->count();
        $delivered_client_shipments = App\Shipment::where('client_id', Auth::user()->userClient->client_id)
            ->where('client_status', App\Shipment::CLIENT_STATUS_DELIVERED)
            ->count();
        
        $transactions = App\Transaction::where('client_id', Auth::user()->userClient->client_id)
            ->orderBy('created_at', 'desc')
            ->sum('value');
    @endphp

    <div class="row">
        <div class="col-xl-12">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bgi-no-repeat card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="#"
                        class="card-title font-weight-bold text-muted text-hover-primary font-size-h5">{{ translate('Your Wallet') }}</a>
                    <div class="font-weight-bold text-success mb-5 mt-9">{{ format_price($transactions) }}</div>
                    <p class="text-dark-75 font-weight-bolder font-size-h5 m-0">
                        {{ translate('The amount you have on your wallet, Which you can request anytime') }}.</p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#"
                                class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Total Shipments Count') }}</a>
                            <span
                                class="text-muted font-weight-bold mt-2">{{ translate('Count all shipments you have') }}</span>
                        </div>
                        <span class="symbol symbol-light-primary symbol-45">
                            <span
                                class="symbol-label font-weight-bolder font-size-h6">{{ $all_client_shipments }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-3">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#"
                                class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Saved Shipments Count') }}</a>
                            <span
                                class="text-muted font-weight-bold mt-2">{{ translate('Count of your saved shipments') }}</span>
                        </div>
                        <span class="symbol symbol-light-primary symbol-45">
                            <span
                                class="symbol-label font-weight-bolder font-size-h6">{{ $saved_client_shipments }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-3">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#"
                                class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('In Progress Shipments Count') }}</a>
                            <span
                                class="text-muted font-weight-bold mt-2">{{ translate('Count of your shipments which is in the shipping process') }}</span>
                        </div>
                        <span class="symbol symbol-light-primary symbol-45">
                            <span
                                class="symbol-label font-weight-bolder font-size-h6">{{ $in_progress_client_shipments }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-3">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer">
                        <div class="d-flex flex-column mr-2">
                            <a href="#"
                                class="text-light-75 text-hover-primary font-weight-bolder font-size-h5">{{ translate('Delivered Shipments Count') }}</a>
                            <span
                                class="text-muted font-weight-bold mt-2">{{ translate('Count of your delivered shipments') }}</span>
                        </div>
                        <span class="symbol symbol-light-primary symbol-45">
                            <span
                                class="symbol-label font-weight-bolder font-size-h6">{{ $delivered_client_shipments }}</span>
                        </span>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
    </div>
@elseif($user_type == 'captain')
    @php
        $transactions = App\Transaction::where('captain_id', Auth::user()->userCaptain->captain_id)
            ->orderBy('created_at', 'desc')
            ->sum('value');
        $transactions = abs($transactions); // Converting the transactions from negative to positive
    @endphp

    <div class="row">
        <div class="col-xl-12">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-dark card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <a href="#"
                        class="card-title font-weight-bold text-light-75 text-hover-primary font-size-h5 mb-0">{{ translate('Welcome ') . Auth::user()->name . '.' }}</a>
                    <div class="font-weight-bold font-size-h4 text-success mb-5 mt-0 mt-9">
                        {{-- {{ format_price($transactions) }} --}}
                    </div>
                    {{-- <p class="text-muted font-weight-bolder font-size-h5 m-0">
                        {{ translate('The amount you have on your wallet, Which you should deliver to the company') }}.
                    </p> --}}
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
    </div>
@endif
