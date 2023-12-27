@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar mb-3 mt-2 text-left">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('Areas') }}</h1>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="h6 mb-0">{{ translate('Areas') }}</h5>
        </div>
        <div class="card-body">

            <form class="form-horizontal" action="{{ route('admin.areas.store') }}" id="kt_form_1" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row gx-10">
                    <div class="col-md-4">

                        <div class="form-group d-none">
                            <label>{{ translate('From Country') }}:</label>
                            <select readonly id="change-country" class="form-control select-country" name="country">

                                @foreach (\App\Country::where('covered', 1)->get() as $country)
                                    <option {{ $country->name === 'Kenya' ? 'selected' : '' }} value="{{ $country->id }}">
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label>{{ translate('From Region') }}:</label>
                            <select name="Area[state_id]" class="form-control select-state">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Area') }}:</label>
                            <input type="text" class="form-control" name="Area[name]">
                        </div>

                        <div class="form-group d-none">
                            <label>{{ translate('Geofence') }}:</label>
                            <input type="text" id="geofence" class="form-control" name="Area[geofence]">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="rounded" style="height:250px;
                        width: 100%;" id="map">
                        </div>
                        {{-- <div id="address"></div> --}}
                    </div>
                </div>

                <div class="row pt-12">
                    <div class="form-group col-md-4 mb-0 text-left">
                        <div>
                            <button type="submit" class="btn btn-md btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {!! hookView('shipment_addon', $currentView) !!}
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script> --}}
    <script>
        let mapInstance;
        let drawingManagerInstance;
        let geofencePolygon;
        let savedGeofenceCoordinates = []; // Array to store saved geofence coordinates

        function initMap() {
            mapInstance = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -4.0435,
                    lng: 39.6682
                },
                zoom: 12,
            });

            drawingManagerInstance = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON],
                },
            });
            drawingManagerInstance.setMap(mapInstance);

            google.maps.event.addListener(drawingManagerInstance, 'overlaycomplete', function(event) {
                if (event.type === google.maps.drawing.OverlayType.POLYGON) {
                    if (geofencePolygon) {
                        geofencePolygon.setMap(null);
                    }
                    geofencePolygon = event.overlay;
                    geofencePolygon.setOptions({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: 'green',
                        fillOpacity: 0.35,
                    });

                    const coordinates = event.overlay.getPath().getArray();
                    savedGeofenceCoordinates = coordinates.map(function(coord) {
                        return {
                            lat: coord.lat(),
                            lng: coord.lng()
                        };
                    });
                    $('#geofence').val(JSON.stringify(savedGeofenceCoordinates));

                }
            });
        }


        $(document).ready(() => {
            initMap()
        })
    </script>

    <script>
        $('.select-country').select2({
            placeholder: "Select a country"
        });
        $('.select-state').select2({
            placeholder: "Select a state"
        });
        $(document).ready(function() {
            let id
            let allCountries = {!! json_encode($countries) !!}

            allCountries.forEach((country) => {
                if (country.name == 'Kenya') {
                    id = country.id;
                }
            })

            $('.select-country-to').select2({
                placeholder: $(this).find(":selected").text(),
            });


            $.get("{{ route('admin.shipments.get-states-ajax') }}?country_id=" + id, function(data) {

                $('select[name ="Area[state_id]"]').empty();

                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                    $('select[name ="Area[state_id]"]').append('<option value="' + element['id'] + '">' +
                        element['name'] + '</option>');

                }


            });
        });
        $(document).ready(function() {
            FormValidation.formValidation(
                document.getElementById('kt_form_1'), {
                    fields: {
                        "Area[state_id]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "Area[name]": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        },
                        "country": {
                            validators: {
                                notEmpty: {
                                    message: '{{ translate('This is required!') }}'
                                }
                            }
                        }
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
