@extends('backend.layouts.app')

@section('content')
    @php
        $auth_user = Auth::user();
        $checked_google_map = \App\BusinessSetting::where('type', 'google_map')->first();
    @endphp
    <style>
        label {
            font-weight: bold !important;
        }
    </style>
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="h6 mb-0">{{ translate('Shipment Info') }}</h5>
            </div>

            <form class="form-horizontal"
                action="{{ route('admin.shipments.update-shipment', ['shipment' => $shipment->id]) }}" id="kt_form_1"
                method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="form-group row">
                                <label class="col-2 col-form-label">{{ translate('Shipment Type') }}</label>
                                <div class="col-9 col-form-label">
                                    <div class="radio-inline">
                                        <label class="radio radio-success btn btn-default">
                                            <input type="radio" name="Shipment[type]"
                                                @if ($shipment->type == \App\Shipment::getType(\App\Shipment::PICKUP)) checked @endif
                                                value="{{ \App\Shipment::PICKUP }}" />
                                            <span></span>
                                            {{ translate('Pickup (For door to door delivery)') }}
                                        </label>
                                        <label class="radio radio-success btn btn-default">
                                            <input type="radio" name="Shipment[type]"
                                                @if ($shipment->type == \App\Shipment::getType(\App\Shipment::DROPOFF)) checked @endif
                                                value="{{ \App\Shipment::DROPOFF }}" />
                                            <span></span>
                                            {{ translate('Drop off (For delivery package from branch directly)') }}
                                        </label>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Branch') }}:</label>
                                        <select class="form-control kt-select2 select-branch" id="select-how"
                                            name="Shipment[branch_id]">

                                            @foreach ($branchs as $branch)
                                                <option @if ($shipment->branch_id == $branch->id) selected @endif
                                                    value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if (\App\ShipmentSetting::getVal('is_date_required') == '1' || \App\ShipmentSetting::getVal('is_date_required') == null)
                                        <div class="form-group">
                                            <label>{{ translate('Shipping Date') }}:</label>
                                            <div class="input-group date">
                                                <input type="text" name="Shipment[shipping_date]"
                                                    value="{{ $shipment->shipping_date }}" class="form-control"
                                                    id="kt_datepicker_3" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Customer/Sender') }}:</label>
                                        @if ($auth_user->user_type == 'customer')
                                            <input type="text" placeholder="" class="form-control" name=""
                                                value="{{ $auth_user->name }}" disabled>
                                        @else
                                            <input name="Shipment[client_id]" class="form-control" id="client_phone"
                                                value="{{ $shipment->client_id }}" id="">
                                            {{-- <select class="form-control kt-select2 select-client" id="select-how"
                                                name="Shipment[client_id]">

                                                @foreach ($clients as $client)
                                                    <option @if ($shipment->client_id == $client->id) selected @endif
                                                        data-phone="{{ $client->responsible_mobile }}"
                                                        value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select> --}}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Customer Phone') }}:</label>
                                        <input name="Shipment[client_phone]" class="form-control" id="client_phone"
                                            value="{{ $shipment->client_phone }}" id="">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ translate('Customer Address') }}:</label>
                                        <input name="Shipment[client_address]" class="form-control"
                                            value="{{ $shipment->client_address }}" id="client-address-complete">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Client location:</label>
                                        <div class="" style="width: 100%; height:300px; border-radius:10px;"
                                            id="clientLocationMap"></div>

                                        <input placeholder="Client location" name="Shipment[client_street_address_map]"
                                            id="clientLocation" value="{{ $shipment->client_street_address_map }}" readonly
                                            class="form-control d-none" id="" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Receiver Name') }}:</label>
                                        <input type="text" name="Shipment[reciver_name]" class="form-control"
                                            value="{{ $shipment->reciver_name }}" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Receiver Phone') }}:</label>
                                        <input type="text" name="Shipment[reciver_phone]" class="form-control"
                                            value="{{ $shipment->reciver_phone }}" />

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ translate('Receiver Address') }}:</label>
                                        <input id="receiver-address-input" type="text" name="Shipment[reciver_address]"
                                            class="form-control" value="{{ $shipment->reciver_address }}" />

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Client location:</label>
                                        <div class="" style="width: 100%; height:300px; border-radius:10px;"
                                            id="receiverLocationMap"></div>

                                        <input placeholder="Receiver location" name="Shipment[reciver_street_address_map]"
                                            id="receiverLocation" value="{{ $shipment->reciver_street_address_map }}"
                                            readonly class="form-control d-none" id="" />
                                    </div>
                                </div>


                                @if ($checked_google_map->value == 1)
                                    <div class="col-md-12">
                                        <div class="location-receiver">
                                            <label>{{ translate('Receiver Location') }}:</label>
                                            <input type="text" value="{{ $shipment->reciver_street_address_map }}"
                                                class="form-control address-receiver"
                                                placeholder="{{ translate('Receiver Location') }}"
                                                name="Shipment[reciver_street_address_map]" rel="receiver"
                                                value="" />
                                            <input type="hidden" value="{{ $shipment->reciver_lat }}"
                                                class="form-control lat" data-receiver="lat"
                                                name="Shipment[reciver_lat]" />
                                            <input type="hidden" value="{{ $shipment->reciver_lng }}"
                                                class="form-control lng" data-receiver="lng"
                                                name="Shipment[reciver_lng]" />
                                            <input type="hidden" value="{{ $shipment->reciver_url }}"
                                                class="form-control url" data-receiver="url"
                                                name="Shipment[reciver_url]" />

                                            <div class="col-sm-12 map_canvas map-receiver mt-2"
                                                style="width:100%;height:300px;"></div>
                                            <span
                                                class="form-text text-muted">{{ 'Change the pin to select the right location' }}</span>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Payment Type') }}:</label>
                                        <select class="form-control kt-select2" id="select-how"
                                            name="Shipment[payment_type]">


                                            <option @if ($shipment->payment_type == 1) selected @endif value="1">
                                                {{ translate('Postpaid') }}</option>
                                            <option @if ($shipment->payment_type == 2) selected @endif value="2">
                                                {{ translate('Prepaid') }}</option>


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Payment Method') }}:</label>
                                        <select class="form-control kt-select2" id="select-how"
                                            name="Shipment[payment_method_id]">
                                            @forelse (\App\BusinessSetting::where("key","payment_gateway")->where("value","1")->get() as $gateway)
                                                <option @if ($shipment->payment_method_id == $gateway->id) selected @endif
                                                    value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                            @empty
                                                <option value="11">{{ translate('Cash') }}</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translate('Attachments') }}:</label>

                                        <div class="input-group" data-toggle="aizuploader" data-type="image"
                                            data-multiple="true">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                    {{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="Shipment[attachments_before_shipping]"
                                                class="selected-files"
                                                value="{{ $shipment->attachments_before_shipping }}" max="3">
                                        </div>
                                        <div class="file-preview">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Attachments After Shipping')}}:</label>
        
                                    <div class="input-group " data-toggle="aizuploader" data-type="image" data-multiple="true">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="Shipment[attachments_after_shipping]" class="selected-files" value="{{$shipment->attachments_after_shipping}}" max="3">
                                    </div>
                                    <div class="file-preview">
                                    </div>
                                </div>
                            </div> --}}
                            </div>

                            <hr>

                            <div id="kt_repeater_1">
                                <div class="row" id="kt_repeater_1">
                                    <h2 class="text-left">{{ translate('Package Info') }}:</h2>
                                    <div data-repeater-list="Package" class="col-lg-12">
                                        @foreach (\App\PackageShipment::where('shipment_id', $shipment->id)->get() as $pack)
                                            <div data-repeater-item class="row align-items-center"
                                                style="margin-top: 15px;padding-bottom: 15px;padding-top: 15px;border-top:1px solid #ccc;border-bottom:1px solid #ccc;">



                                                <div class="col-md-3">

                                                    <label>{{ translate('Category') }}:</label>
                                                    <select class="form-control kt-select2" id="select-how"
                                                        name="package_id">
                                                        <option></option>
                                                        @foreach (\App\Package::all() as $package)
                                                            <option @if ($pack->package_id == $package->id) selected @endif
                                                                value="{{ $package->id }}">{{ $package->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="d-md-none mb-2"></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>{{ translate('description') }}:</label>
                                                    <input type="text" value="{{ $pack->description }}"
                                                        class="form-control" name="description">
                                                    <div class="d-md-none mb-2"></div>
                                                </div>
                                                <div class="col-md-3">

                                                    <label>{{ translate('Quantity') }}:</label>

                                                    <input id="kt_touchspin_qty" type="text" name="qty"
                                                        class="form-control" value="{{ $pack->qty }}" />
                                                    <div class="d-md-none mb-2"></div>

                                                </div>

                                                <div class="col-md-3">

                                                    <label>{{ translate('Weight') }}:</label>

                                                    <input id="kt_touchspin_weight" type="text" name="weight"
                                                        class="form-control" value="{{ $pack->weight }}" />
                                                    <div class="d-md-none mb-2"></div>

                                                </div>


                                                <div class="col-md-12" style="margin-top: 10px;">
                                                    <label>{{ translate('Dimensions [Length x Width x Height] (cm):') }}:</label>
                                                </div>
                                                <div class="col-md-2">

                                                    <input class="dimensions_r" type="text" class="form-control"
                                                        placeholder="{{ translate('Length') }}"
                                                        value="{{ $pack->length }}" name="length" />

                                                </div>
                                                <div class="col-md-2">

                                                    <input class="dimensions_r" type="text" class="form-control"
                                                        placeholder="{{ translate('Width') }}"
                                                        value="{{ $pack->width }}" name="width" />

                                                </div>
                                                <div class="col-md-2">

                                                    <input class="dimensions_r" type="text" class="form-control"
                                                        placeholder="{{ translate('Height') }}"
                                                        value="{{ $pack->height }}" name="height" />

                                                </div>


                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <div>
                                                            <a href="javascript:;" data-repeater-delete=""
                                                                class="btn btn-sm font-weight-bolder btn-light-danger">
                                                                <i class="la la-trash-o"></i>{{ translate('Delete') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="">
                                        <label class="col-form-label text-right">{{ translate('Add') }}</label>
                                        <div>
                                            <a href="javascript:;" data-repeater-create=""
                                                class="btn btn-sm font-weight-bolder btn-light-primary">
                                                <i class="la la-plus"></i>{{ translate('Add') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ translate('Tax & Duty') }}:</label>

                                            <input id="kt_touchspin_2" type="text" class="form-control"
                                                value="{{ $shipment->tax }}" name="Shipment[tax]" />

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ translate('Insurance') }}:</label>
                                            <input id="kt_touchspin_2_2" type="text" class="form-control"
                                                value="{{ $shipment->insurance }}" name="Shipment[insurance]" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ translate('Shipping Cost') }}:</label>
                                            <input id="kt_touchspin_3" type="text" class="form-control"
                                                value="{{ $shipment->shipping_cost }}" name="Shipment[shipping_cost]" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ translate('Return Cost') }}:</label>
                                            <input id="kt_touchspin_3_3" type="text" class="form-control"
                                                value="{{ $shipment->return_cost }}" name="Shipment[return_cost]" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ translate('Delivery Time') }}:</label>
                                            <select class="form-control kt-select2" id="select-how"
                                                name="Shipment[delivery_time]">
                                                <option @if ($shipment->delivery_time == '1-2 Days') selected @endif
                                                    value="1-2 Days">{{ translate('1-2 Days') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ translate('Total Weight') }}:</label>
                                            <input id="kt_touchspin_4" type="text" class="form-control"
                                                value="{{ $shipment->total_weight }}" value="0"
                                                name="Shipment[total_weight]" />
                                        </div>
                                    </div>

                                </div>




                            </div>

                        </div>

                        {!! hookView('shipment_addon', $currentView) !!}

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        function isCoordinateInsideGeofence(coordinate, geofence) {
            const x = coordinate.lat;
            const y = coordinate.lng;

            let isInside = false;
            for (let i = 0, j = geofence.length - 1; i < geofence.length; j = i++) {
                const xi = geofence[i].lat;
                const yi = geofence[i].lng;
                const xj = geofence[j].lat;
                const yj = geofence[j].lng;

                const intersect = ((yi > y) !== (yj > y)) &&
                    (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
                if (intersect) isInside = !isInside;
            }

            return isInside;
        }

        function setAreaAttribute(cordinates, type) {
            var allAreas = {!! json_encode($areas) !!}
            if (type === 'client') {
                allAreas.forEach(oneArea => {
                    if (isCoordinateInsideGeofence(cordinates, JSON.parse(oneArea.geofence))) {
                        console.log(oneArea.name + isCoordinateInsideGeofence(cordinates, JSON.parse(oneArea
                            .geofence)))
                        $('#client-state-id').val(oneArea.state_id)
                        $('#client-area-id').val(oneArea.id)
                        $('#from-region-id').val(oneArea.state_id)
                        $('#from_area_id').val(oneArea.id)
                    }
                })
            } else {
                allAreas.forEach(oneArea => {
                    if (isCoordinateInsideGeofence(cordinates, JSON.parse(oneArea.geofence))) {
                        console.log(oneArea.name + isCoordinateInsideGeofence(cordinates, JSON.parse(oneArea
                            .geofence)))

                        $('#to-state-id').val(oneArea.state_id)
                        $('#to_area_id').val(oneArea.id)
                    }
                })
            }
        }
    </script>


    <script>
        let receiverMarker;
        let clientMarker;
        let marker;

        function initMap(mapElementId, inputElementId) {
            let selectedLatitude, selectedLongitude;
            const mapOptions = {
                center: {
                    lat: -4.0435,
                    lng: 39.6682,
                },
                zoom: 12,
            };
            const map = new google.maps.Map(document.getElementById(mapElementId), mapOptions);
            map.addListener("click", (event) => {
                if (marker) {
                    marker.setMap(null);
                }

                if (receiverMarker) {
                    receiverMarker.setMap(null)
                }

                if (clientMarker) {
                    clientMarker.setMap(null)
                }

                selectedLatitude = event.latLng.lat();
                selectedLongitude = event.latLng.lng();

                marker = new google.maps.Marker({
                    position: {
                        lat: selectedLatitude,
                        lng: selectedLongitude,
                    },
                    map: map,
                    title: "Selected Location",
                });

                const locationInput = document.getElementById(inputElementId);
                locationInput.value = `${selectedLatitude},${selectedLongitude}`;
            });

            return map;
        }

        function locateReceiverPin(map, coordinates) {
            if (!map || !coordinates) {
                return;
            }

            if (receiverMarker) {
                receiverMarker.setMap(null);
            }

            if (marker) {
                marker.setMap(null);
            }


            if (clientMarker) {
                clientMarker.setMap(null);
            }


            map.setCenter(coordinates);

            receiverMarker = new google.maps.Marker({
                position: coordinates,
                map: map,
                title: "Receiver Location",
            });
        }

        function locateClientPin(map, coordinates) {
            if (!map || !coordinates) {
                return;
            }

            if (clientMarker) {
                clientMarker.setMap(null);
            }

            if (marker) {
                marker.setMap(null);
            }

            if (receiverMarker) {
                receiverMarker.setMap(null);
            }


            map.setCenter(coordinates);

            clientMarker = new google.maps.Marker({
                position: coordinates,
                map: map,
                title: "Client Location",
            });
        }

        $(document).ready(function() {
            const receiverMapInstance = initMap("receiverLocationMap", "receiverLocation");

            const clientMapInstance = initMap("clientLocationMap", "clientLocation");

            const receiverAddressInput = document.getElementById('receiver-address-input');
            const receiverAddressAutocomplete = new google.maps.places.Autocomplete(receiverAddressInput);

            const clientAddressInput = document.getElementById('client-address-complete');
            const clientAddressAutocomplete = new google.maps.places.Autocomplete(clientAddressInput);

            receiverAddressAutocomplete.addListener('place_changed', function() {
                const receiverAddressPlace = receiverAddressAutocomplete.getPlace();
                const receiverPlaceCoordinates = {
                    lat: receiverAddressPlace.geometry.location.lat(),
                    lng: receiverAddressPlace.geometry.location.lng()
                };

                if (marker) {
                    marker.setMap(null);
                }

                $('#receiverLocation').val(
                    `${receiverPlaceCoordinates.lat},${receiverPlaceCoordinates.lng}`);

                // Call the function to locate the receiver pin on the map
                locateReceiverPin(receiverMapInstance, receiverPlaceCoordinates);

                if (!receiverAddressPlace.geometry) {
                    return;
                }
            });

            clientAddressAutocomplete.addListener('place_changed', function() {
                const clientAddressPlace = clientAddressAutocomplete.getPlace();
                const clientPlaceCoordinates = {
                    lat: clientAddressPlace.geometry.location.lat(),
                    lng: clientAddressPlace.geometry.location.lng()
                };



                // Call the function to locate the client pin on the map
                locateClientPin(clientMapInstance, clientPlaceCoordinates);

                $('#clientLocation').val(`${clientPlaceCoordinates.lat},${clientPlaceCoordinates.lng}`);

                setAreaAttribute(clientPlaceCoordinates, 'client');

                if (!clientAddressPlace.geometry) {
                    return;
                }
            });

            $('#my-client-address').on('change', function() {
                let clientAddress;
                allClientAddresses.forEach((item) => {
                    if (item.id == $('#my-client-address').val()) {
                        clientAddress = item.address
                    }
                })

                console.log(clientAddress);
                const geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                    address: clientAddress
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
                        const clientPlaceCoordinates = {
                            lat: results[0].geometry.location.lat(),
                            lng: results[0].geometry.location.lng()
                        };

                        locateClientPin(clientMapInstance, clientPlaceCoordinates);
                        $('#clientLocation').val(
                            `${clientPlaceCoordinates.lat},${clientPlaceCoordinates.lng}`);

                        setAreaAttribute(clientPlaceCoordinates, 'client');
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        let allClientAddresses;

        $('.address-receiver').each(function() {
            var address = $(this);

            var lat = '{{ $shipment->reciver_lat }}';
            lat = parseFloat(lat);
            var lng = '{{ $shipment->reciver_lng }}';
            lng = parseFloat(lng);

            address.geocomplete({
                map: ".map_canvas.map-receiver",
                mapOptions: {
                    zoom: 18,
                    center: {
                        lat: lat,
                        lng: lng
                    },
                },
                markerOptions: {
                    draggable: true
                },
                details: ".location-receiver",
                detailsAttribute: 'data-receiver',
                autoselect: true,
                restoreValueAfterBlur: true,
            });
            address.bind("geocode:dragged", function(event, latLng) {
                $("input[data-receiver=lat]").val(latLng.lat());
                $("input[data-receiver=lng]").val(latLng.lng());
            });
        });


        $('.select-client').select2({
            placeholder: "Select Client",
        });
        $('.select-client').change(function() {
            var client_phone = $(this).find(':selected').data('phone');
            document.getElementById("client_phone").value = client_phone;
        })
        $('.select-branch').select2({
            placeholder: "Select Branch",
        });
        $(document).ready(function() {
            var inputs = document.getElementsByTagName('input');

            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type.toLowerCase() == 'number') {
                    inputs[i].onkeydown = function(e) {
                        if (!((e.keyCode > 95 && e.keyCode < 106) ||
                                (e.keyCode > 47 && e.keyCode < 58) ||
                                e.keyCode == 8)) {
                            return false;
                        }
                    }
                }
            }
            $('#kt_datepicker_3').datepicker({
                orientation: "bottom auto",
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayBtn: true,
                todayHighlight: true,
                startDate: new Date(),
            });
            $('#kt_repeater_1').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                    $('.dimensions_r').TouchSpin({
                        buttondown_class: 'btn btn-secondary',
                        buttonup_class: 'btn btn-secondary',

                        min: -1000000000,
                        max: 1000000000,
                        stepinterval: 50,
                        maxboostedstep: 10000000,
                    });
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#kt_touchspin_2, #kt_touchspin_2_2').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',

                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '%'
            });
            $('#kt_touchspin_3').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',

                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '{{ currency_symbol() }}'
            });
            $('#kt_touchspin_3_3').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',

                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '{{ currency_symbol() }}'
            });
            $('#kt_touchspin_4').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',

                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: 'Kg'
            });
            $('#kt_touchspin_weight').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',

                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: 'Kg'
            });
            $('.dimensions_r').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',

                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
            });

            $('#kt_touchspin_qty').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',

                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
            });
            FormValidation.formValidation(
                document.getElementById('kt_form_1'), {
                    fields: {
                        "Shipment[type]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[shipping_date]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[branch_id]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[client_id]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[client_address]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[client_phone]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[payment_type]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[payment_method_id]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[tax]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[insurance]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[shipping_cost]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[delivery_time]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[delivery_time]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[total_weight]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[reciver_name]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[reciver_phone]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Shipment[reciver_address]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },

                    },


                    plugins: {
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        trigger: new FormValidation.plugins.Trigger(),
                        // Bootstrap Framework Integration
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        // Validate fields when clicking the Submit button
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        // Submit the form when all fields are valid
                        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                        icon: new FormValidation.plugins.Icon({
                            valid: 'fa fa-check',
                            invalid: 'fa fa-times',
                            validating: 'fa fa-refresh',
                        }),
                    }
                }
            );
        });
    </script>
@endsection
