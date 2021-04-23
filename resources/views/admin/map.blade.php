<!DOCTYPE html>
<html>
    <head>

        <style>
            #map {
                height: 100%;
            }

            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            #over_map {
                position: absolute;
                top: 10px;
                left: 89%;
                z-index: 99;
                background-color: #ccffcc;
                padding: 10px;
            }
        </style>
    </head>

    <body>
        <div id="map"></div>

        <!-- jQuery CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Firebase -->
        <script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>

        <script>
            // Replace your Configuration here..
            var config = {
                apiKey: "AIzaSyCPYqV7zkv8TPjElxh1pNCltWBy7trXXo0",
                authDomain: "lab-driver.firebaseapp.com",
                databaseURL: "https://lab-driver.firebaseio.com/",
                projectId: "lab-driver",
                storageBucket: "lab-driver.appspot.com",
                messagingSenderId: "857925332392"
            };
            firebase.initializeApp(config);
        </script>
		
		<script>

			/*var markers = [];
            var map;
            function initMap() { // Google Map Initialization... 
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: new google.maps.LatLng(31.52011, 74.368604),
                    mapTypeId: 'terrain'
                });
            }*/
			
            function AddCar(data) {
                var icon = { // car icon
                    path: 'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
                    scale: 0.7,
                    fillColor: "#20d34a", //<-- Car Color, you can change it 
                    fillOpacity: 1,
                    strokeWeight: 1,
                    anchor: new google.maps.Point(0, 5),
                    rotation: data.child('angle').val() //<-- Car angle
                };

                var latlng = { lat: parseFloat(data.child('lat').val()), lng: parseFloat(data.child('lng').val()) };

				map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: new google.maps.LatLng(parseFloat(data.child('lat').val()), parseFloat(data.child('lng').val())),
                    mapTypeId: 'terrain'
                });

                var marker = new google.maps.Marker({
                    position: latlng,
                    icon: icon,
                    map: map,
                });
				markers[{{$id}}] = marker;
            }

            // get firebase database reference...	
			var count = 0;
            var car_Ref = firebase.database().ref('/drivers/'+{{$id}});
			car_Ref.on('value', function (data) {
				if(data.child('lat').val() && count == 0)	AddCar(data);
				else document.getElementById("map").innerHTML = '<center>User Map Not Exist</center>';
				count++;
            });
            
        </script>

		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7DtKqWoAtgKFmYtUu-PceyA7bV1Y9NTU&callback=initMap">
        </script>		

    </body>
</html>