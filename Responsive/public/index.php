<!DOCTYPE html>
<html>
<head>
	<title>Rezty Batik</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
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
		<div class="login-content">
			<form>
			<h3 class="title">Monitoring Suhu</h3>
           		<div class="input-div one">
				<h5>Kelembapan <div id="postElementHumid"></div> %</h5> 
				<h5>Temperatur <div id="postElementTemp"></div> C</h5>
			</div>
				
			</form>
			<div>
            	<h3>Status Mesin : <div id="Key"></div></h3>
				<button onclick="ledOn()" class="btn">Hidupkan Pengering</button>
				<button onclick="ledOff()" class="btn">Matikan Pengering</button>
            </div>
            	</div>
				
        </div>
    </div>
</body>
</html>
