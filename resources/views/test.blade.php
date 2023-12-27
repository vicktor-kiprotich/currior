<!DOCTYPE html>
<html>

<head>
    <title>Address Autocomplete</title>
    <script
        src="{{ 'https://maps.googleapis.com/maps/api/js?key=' . env('GOOGLE_MAPS_API_TOKEN') . '&libraries=places,drawing' }}">
    </script>
    <style>
        #addressInput {
            width: 300px;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h1>Address Autocomplete Example</h1>
    <input type="text" id="addressInput" placeholder="Enter address here" />

    <script>
        function initAutocomplete() {
            const addressInput = document.getElementById("addressInput");
            const autocomplete = new google.maps.places.Autocomplete(addressInput);
            autocomplete.setFields(["formatted_address", "geometry"]);

            autocomplete.addListener("place_changed", function() {
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.formatted_address) {
                    addressInput.value = "";
                    return;
                }

                const fullAddress = place.formatted_address;
                const latitude = place.geometry.location.lat();
                const longitude = place.geometry.location.lng();

                addressInput.value = fullAddress;
                addressInput.setAttribute("data-latitude", latitude);
                addressInput.setAttribute("data-longitude", longitude);

                console.log("Coordinates (latitude, longitude):", latitude, longitude);
            });
        }

        google.maps.event.addDomListener(window, "load", initAutocomplete);



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

        // Example usage:
        const geofence = [{
                lat: 1,
                lng: 1
            }, // Top left corner
            {
                lat: 1,
                lng: 3
            }, // Top right corner
            {
                lat: 3,
                lng: 3
            }, // Bottom right corner
            {
                lat: 3,
                lng: 1
            }, // Bottom left corner
        ];

        const coordinateToCheck = {
            lat: 2,
            lng: 2
        };
        const isInsideGeofence = isCoordinateInsideGeofence(coordinateToCheck, geofence);
        console.log("Is the coordinate inside the geofence?", isInsideGeofence);
    </script>
</body>

</html>
