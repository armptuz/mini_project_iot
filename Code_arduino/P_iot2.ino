#include "DHT.h"
#define DHTPIN D2
#define DHTTYPE DHT11

 

DHT dht(DHTPIN, DHTTYPE);

#define ECHO D4  // Espresso lite pin 04
#define TRIG D5  // Espresso lite pin 05

#include <ESP8266WiFi.h>
#include <PubSubClient.h>
int sensor_Pin = A0;
const char* ssid     = "iPhoneA";
const char* password = "11111111";

const char* host = "172.20.10.3";  //ใส่ IP หรือ Host ของเครื่อง Database ก็ได้
const char* variable   = "25";  //ตัวแปรที่ต้องการจะส่ง

 const char * topic = "/sever"; // topic ชื่อ /server
#define mqtt_server "soldier.cloudmqtt.com" // server
#define mqtt_port 16476 // เลข port
#define mqtt_user "bytnqugk" // user
#define mqtt_password "1YPwZO6SlRvH" // password

WiFiClient espClient;
PubSubClient client(espClient);

int SystemStatus= 2;


long duration, distance;
void setup() {
  Serial.begin (115200);
  dht.begin();
  pinMode(TRIG, OUTPUT);
  pinMode(ECHO, INPUT);

  delay(10);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(100);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

 client.setServer(mqtt_server, mqtt_port); // เชื่อมต่อ mqtt server
client.setCallback(callback); // สร้างฟังก์ชันเมื่อมีการติดต่อจาก mqtt มา
}

void loop() {
   MqttCon();
  
  sensorU();
   float h = dht.readHumidity();
   float t = dht.readTemperature();
  /* Serial.print("Temp = ");
   Serial.println(t);
   Serial.print("Humidity = ");
   Serial.println(h);
*/
 if ( SystemStatus == 1){
      sendDatabase(distance,t,h );
 }else if(SystemStatus == 0){
      sendDatabase(0,0,0 );
      SystemStatus =2;
  }
}

void sensorU(){
  
  
  digitalWrite(TRIG, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG, LOW);

  duration = pulseIn(ECHO, HIGH);
  distance = (duration / 2) / 29.1;
 distance =  map(distance,6,20,100,0);
 if(distance < 0){
  distance = 0;
  }else if(distance >100){
    distance = 100;
    }
  Serial.print("Distance = ");
  Serial.print(distance);
  Serial.println(" cm");
  
  }

 void MqttCon(){
  if (!client.connected()) {
Serial.print("MQTT connecting...");
if (client.connect("ESP8266Client", mqtt_user, mqtt_password)) { // ถ้าเชื่อมต่อ mqtt สำเร็จ
client.subscribe(topic); // ชื่อ topic ที่ต้องการติดตาม
Serial.println("connected");
}
// ในกรณีเชื่อมต่อ mqtt ไม่สำเร็จ
else {
Serial.print("failed, rc=");
Serial.print(client.state());
Serial.println(" try again in 5 seconds");
delay(5000); // หน่วงเวลา 5 วินาที แล้วลองใหม่
return;
}
}
client.loop();
  
  
  }

  void callback(char* topic, byte* payload, unsigned int length) {
Serial.print("Message from ");
Serial.println(topic);
String msg = "";
int i = 0;
while (i < length) {
msg += (char)payload[i++]; // อ่านข้อความจาก topic ที่ส่งมา
}
Serial.print("receive ");
Serial.println(msg); // แสดงข้อความที่ได้รับจาก topic

if (msg == "on") { // ถ้า topic ส่งคำว่า on
  SystemStatus =1; 
//digitalWrite(LED_PIN, 1);
//led_status = "NodeMCU : LED ON";
//client.publish("/NodeMCU", led_status); // ส่งข้อความกลับไปที่ topic คือ ชื่ออุปกรณ์ที่ส่ง , ข้อความ
} else if (msg == "off") {

   SystemStatus =0; 
//digitalWrite(LED_PIN, 0);
//led_status = "NodeMCU : LED OFF";
//client.publish("/NodeMCU", led_status);
}else if(msg=="status"){
//client.publish("/NodeMCU", led_status);
}
// แสดงข้อความตอบกลับที่ส่งไปที่ topic
/*
if (led_status != "") {
Serial.print("Answer ");
Serial.println(led_status);*/
}
void sendDatabase(int distance1,int t1,int h1 ){
     delay(50);
  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  const int httpPort = 81;

  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  sensorU();
  String url = "/P_iot/update.php?water=";      //ชุด Directory ที่เก็บไฟล์ และตัวแปรที่ต้องการจะฝาก
  url += distance1;                          //ส่งค่าตัวแปร
  url+="&&temp=";
  url += t1; 
  url+="&&humidity=";
  url += h1;
  Serial.print("Requesting URL: ");
  Serial.println(url);

  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }

  // Read all the lines of the reply from server and print them to Serial
  while(client.available()){
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  Serial.println();
  Serial.println("closing connection");
   
  
  
  }
