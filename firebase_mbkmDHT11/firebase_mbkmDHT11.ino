// Library 
#include <FirebaseESP8266.h>
#include <ESP8266WiFi.h>
#include <DHT.h>

// Komponen
#define relay D2
#define DHTPIN D6
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

// Connect ke Firebase
#define FIREBASE_HOST "https://mbkmdht11-default-rtdb.asia-southeast1.firebasedatabase.app/"
#define FIREBASE_AUTH "qLlNQAFqz4Ngj4tZ6s7UMFPVyZIkz7lZUmoq7ofc"
#define WIFI_SSID "RUM"
#define WIFI_PASSWORD "ciumdulu"  

// Deklarasi
FirebaseData firebaseData;

void setup() {
  
  Serial.begin(115200);
  
  dht.begin();
  
  // Koneksi ke Wifi
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println();
  Serial.print("Connected with IP: ");
  Serial.println(WiFi.localIP());
  Serial.println();

  pinMode(relay, OUTPUT);
  //digitalWrite(relay, LOW);

  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH);
}

void loop(){

  //relay
if (Firebase.getString(firebaseData, "/Relay/Status")) {
    if  (firebaseData.dataType() == "string") 
    {
      String FBStatus = firebaseData.stringData();
      if (FBStatus == "ON") {                                                         
      Serial.println("Relay ON");                         
      digitalWrite(relay, HIGH); }
        else if (FBStatus == "OFF") {                                                  
        Serial.println("Relay OFF");
        digitalWrite(relay, LOW);                                                
          }
      else {Serial.println("");}
    }
}
  
  // Sensor DHT11 membaca suhu dan kelembaban
  float t = dht.readTemperature();
  float h = dht.readHumidity();

  // Memeriksa apakah sensor berhasil mambaca suhu dan kelembaban
  if (isnan(t) || isnan(h)) {
    Serial.println("Gagal membaca sensor DHT11");
    return;
  }

  // Menampilkan suhu dan kelembaban pada serial monitor
  Serial.print("Suhu: ");
  Serial.print(t);
  Serial.println(" *C");
  Serial.print("Kelembaban: ");
  Serial.print(h);
  Serial.println(" %");
  Serial.println();

  // Memberikan status suhu dan kelembaban kepada firebase
  if (Firebase.setFloat(firebaseData, "/Temperature", t)){
      Serial.println("Suhu terkirim");
    } else{
      Serial.println("Suhu tidak terkirim");
      Serial.println("Karena: " + firebaseData.errorReason());
    } 
    
  if (Firebase.setFloat(firebaseData, "/Humidity", h)){
      Serial.println("Kelembaban terkirim");
      Serial.println();
    } else{
      Serial.println("Kelembaban tidak terkirim");
      Serial.println("Karena: " + firebaseData.errorReason());
    }
    
  delay(1000);
}
