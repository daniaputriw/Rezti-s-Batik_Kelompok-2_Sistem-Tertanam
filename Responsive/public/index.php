<!DOCTYPE html>
<html>
<head>
	<title>Rezty Batik</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-database.js"></script>

    <script>
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyCzdvmRiG3gakwg0JIiwMzpE_WcrtAGVD4",
        authDomain: "mbkmdht11.firebaseapp.com",
        databaseURL: "https://mbkmdht11-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "mbkmdht11",
        storageBucket: "mbkmdht11.appspot.com",
        messagingSenderId: "639439581040",
        appId: "1:639439581040:web:1e52b7a09eb2ebfa32e9b5",
        measurementId: "G-QJNKQDQ6C8"
    };

    firebase.initializeApp(firebaseConfig);

	// fungsi Relay
    function ledOn(){
        firebase.database().ref("Relay/").set({
        Status:"ON"
    })
    }
        function ledOff(){
        firebase.database().ref("Relay/").set({
        Status:"OFF"
    })
	}

		// Humidity
	var postElement = document.getElementById("postElementHumid");

	var updateHumid = function(element, value) {
		element.textContent = value;
	};

	var humidRef = firebase.database().ref('Humidity/');
		humidRef.on('value', function(snapshot) {
   		updateHumid(postElementHumid, snapshot.val());
	}); 

		// Temperature
		var postElement = document.getElementById("postElementTemp");

		
		var updateTemp = function(element, value) {
			element.textContent = value;
		};

		var tempRef = firebase.database().ref('Temperature/');
			tempRef.on('value', function(snapshot) {
	 		updateHumid(postElementTemp, snapshot.val());
		});
		
		//status relay
		var statusRef = firebase.database().ref('Relay/'+ 'Status/');
        	statusRef.on('value', function(userSnapshot) {
        	//this.interlocutor = userSnapshot.key;
       		document.getElementById("Key").innerHTML= userSnapshot.val()
    	});
	

    </script>

<img class="wave" src="img/17545.jpg">
	<div class="container">
		<div class="img">
			<img src="img/thermometer-snow.svg">
		</div>
        
		<div class="monitoring-container">
            <form action="">
                <div class="mb-3 row">             
                    <div class="mb-3 row">
                        <h3 class="col-sm-2 col-form-label">Monitoring Suhu</h3>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Kelembapan</label>
                        <div class="col-sm-10">
                            <label class="col-sm-2 col-form-label" id="postElementHumid"></label>
                            <label class="">%</label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Temperatur</label>
                        <div class="col-sm-10">
                            <label class="col-sm-2 col-form-label" id="postElementTemp"></label>
                            <label>C</label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <h3 class="col-sm-4 col-form-label">Status Mesin</h3>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <label>:</label>
                            <label class="col-sm-2 col-form-label" id="Key"></label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <button onclick="ledOn()" class="btn btn-primary" style="border-radius: 50px;width: 55%;height: 55px;">Hidupkan Pengering</button>
                        <button onclick="ledOff()" class="btn btn-primary" style="border-radius: 50px;width: 55%;height: 55px;">Matikan Pengering</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
