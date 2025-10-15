// #include <WiFi.h>
// #include <HTTPClient.h>
// #include <HX711.h>
// #include <Wire.h>
// #include <Adafruit_GFX.h>
// #include <Adafruit_SSD1306.h>

// const int DT_PIN = 23;
// const int SCK_PIN = 12;

// const int TDS_PIN = A0;

// const int s0 = 19;
// const int s1 = 18;
// const int out = 13;
// const int s2 = 2;
// const int s3 = 4;

// const int RELAY_PIN = 5;
// const int RELAY_PIN_2 = 27;
// const int BUZZER_PIN = 14;
// const int LED_PIN = 15;

// //KONEKSI KE WIFI
// const char* ssid = "CICI_BIZNET";
// const char* password = "cici2024";
// const char* server = "192.168.18.10";

// // Pin komunikasi serial dengan Arduino Uno
// #define RXp2 16
// #define TXp2 17

// // Inisialisasi display OLED
// #define SCREEN_WIDTH 128
// #define SCREEN_HEIGHT 64
// #define OLED_RESET    -1
// Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);

// // Inisialisasi tds sensor
// #define TDS_MIN 0   // Nilai analog minimum yang mungkin dibaca oleh sensor TDS
// #define TDS_MAX 1023  // Nilai analog maksimum yang mungkin dibaca oleh sensor TDS
// #define TDS_MIN_PPM 0 // Nilai TDS minimum yang sesuai dengan nilai analog minimum
// #define TDS_MAX_PPM 1000 // Nilai TDS maksimum yang sesuai dengan nilai analog maksimum

// // sensor berat
// HX711 scale;

// // sensor warna
// boolean DEBUG = true;
// int red, grn, blu;
// String color ="";
// long startTiming = 0;
// long elapsedTime = 0;

// // keypad
// String keypadInput = "";  // Variable to store keypad input

// // sensor berat
// unsigned long relayOnTime = 0;
// bool relayState = false;
// float storedWeight = 0;
// // median filtering algorithm
// int getMedianNum(int bArray[], int iFilterLen){
//   int bTab[iFilterLen];
//   for (byte i = 0; i<iFilterLen; i++)
//   bTab[i] = bArray[i];
//   int i, j, bTemp;
//   for (j = 0; j < iFilterLen - 1; j++) {
//     for (i = 0; i < iFilterLen - j - 1; i++) {
//       if (bTab[i] > bTab[i + 1]) {
//         bTemp = bTab[i];
//         bTab[i] = bTab[i + 1];
//         bTab[i + 1] = bTemp;
//       }
//     }
//   }
//   if ((iFilterLen & 1) > 0){
//     bTemp = bTab[(iFilterLen - 1) / 2];
//   }
//   else {
//     bTemp = (bTab[iFilterLen / 2] + bTab[iFilterLen / 2 - 1]) / 2;
//   }
//   return bTemp;
// }


// void setup() {
//   Serial.begin(115200);
//   Serial2.begin(9600, SERIAL_8N1, RXp2, TXp2);

//   scale.begin(DT_PIN, SCK_PIN);
//   scale.set_scale();  // Atur skala ke 1 (skala default)
//   scale.tare();  // Melakukan taring saat kondisi awal

//   pinMode(s0, OUTPUT);
//   pinMode(s1, OUTPUT);
//   pinMode(s2, OUTPUT);
//   pinMode(s3, OUTPUT);
//   pinMode(out, INPUT);
//   pinMode(TDS_PIN,INPUT);
//   digitalWrite(s0, HIGH);
//   digitalWrite(s1, HIGH);

//   pinMode(RELAY_PIN, OUTPUT);
//   pinMode(RELAY_PIN_2, OUTPUT);
//   pinMode(BUZZER_PIN, OUTPUT);
//   pinMode(LED_PIN, OUTPUT);

//     if (!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
//     Serial.println(F("SSD1306 allocation failed"));
//     for (;;);
//   }

//   // Connect to WiFi
//   WiFi.begin(ssid, password);
//   Serial.print("Connecting to WiFi");
//   while (WiFi.status() != WL_CONNECTED) {
//     delay(500);
//     Serial.println("WiFi Not Connected");
//   }

//   Serial.println("WiFi Connected");
//   Serial.println("IP address: ");
//   Serial.println(WiFi.localIP());

//   display.display();
//   delay(2000);
//   display.clearDisplay();
// }

// void loop() {
//   getColor();
//   delay(500);
//   Serial.println();
//   display.println();
//   Serial.println("Pressed Keypad: ");

//     // Cek apakah ada data yang tersedia di Serial2
//   while (Serial2.available()) {
//     char received = Serial2.read();
//     if (received != '\n') {
//       keypadInput += received;  // Tambahkan karakter yang diterima ke keypadInput
//     } else {
//       // Baris baru diterima, sehingga kita memiliki input lengkap
//       displayKeypadInput("PROSES...");
//       Serial.println(keypadInput);  // Tampilkan pesan yang diterima di Serial Monitor
//       if (keypadInput.length() > 0) {
//         // Jika ada input keypad
//         char keypadChar = keypadInput.charAt(0); // Ambil karakter pertama dari input keypad
//         if (keypadChar == '#') {
//           // Jika input keypad adalah '#'
//           activateDevices();
//           display.clearDisplay();
//           display.setTextSize(1);
//           display.setTextColor(SSD1306_WHITE);
//           display.setCursor(0, 0);
//           display.println("TERIMA");
//           display.println();
//           display.println("KASIH!");
//           display.display();
//           delay(10000);

//         } else {
//           // Jika input keypad tidak sesuai
//           deactivateDevices(); // Matikan perangkat
//           display.clearDisplay();
//           display.setTextSize(2);
//           display.setTextColor(SSD1306_WHITE);
//           display.setCursor(0, 0);
//           display.println("MAAF KODE");
//           display.println();
//           display.println("ANDA SALAH");
//           display.display();
//         }
//         // Bunyi buzzer setiap kali ada input keypad
//         tone(BUZZER_PIN, 2000); // Bunyi dengan frekuensi 1000 Hz
//         delay(50); // Durasi 100ms
//         noTone(BUZZER_PIN); // Matikan buzzer
//       }
//       keypadInput = "";  // Bersihkan string untuk input berikutnya
//     }
//   }

//   // Jika relay dan buzzer mati, nyalakan LED selama 0,1 detik dan matikan selama 0,5 detik
//   if (!relayState) {
//     digitalWrite(LED_PIN, HIGH);
//     delay(100);
//     digitalWrite(LED_PIN, LOW);
//     delay(500);
//   }

//   // Baca nilai TDS
//   float tdsValue = readTDS();

//   if (DEBUG) printData();

//   elapsedTime = millis() - startTiming;
//   if (elapsedTime > 1000) {
//     //showDataLCD();
//     startTiming = millis();
//   }

//   delay(1000); // Update every 1 seconds
// }

// void displayKeypadInput(String input) {
//   display.clearDisplay();
//   display.setTextSize(2);  // Set text size to 2 for larger text
//   display.setTextColor(SSD1306_WHITE);
  
//   // Calculate the width and height of the text to center it
//   int16_t x1, y1;
//   uint16_t w, h;
//   display.getTextBounds(input, 0, 0, &x1, &y1, &w, &h);
  
//   // Calculate positions to center the text
//   int x = (SCREEN_WIDTH - w) / 2;
//   int y = (SCREEN_HEIGHT - h) / 2;

//   display.setCursor(x, y);
//   display.println(input);
//   display.display();
// }

// void readRGB() {

//   red = 0, grn = 0, blu = 0;

//   int n = 10;
//   for (int i = 0; i < n; ++i) {
//     //read red component
//     digitalWrite(s2, LOW);
//     digitalWrite(s3, LOW);
//     red = red + pulseIn(out, digitalRead(out) == HIGH ? LOW : HIGH);

//     //read green component
//     digitalWrite(s2, HIGH);
//     digitalWrite(s3, HIGH);
//     grn = grn + pulseIn(out, digitalRead(out) == HIGH ? LOW : HIGH);

//     //let's read blue component
//     digitalWrite(s2, LOW);
//     digitalWrite(s3, HIGH);
//     blu = blu + pulseIn(out, digitalRead(out) == HIGH ? LOW : HIGH);
//   }
//   red = red / n;
//   grn = grn / n;
//   blu = blu / n;
// }

// float readTDS() {
//   // Lakukan pembacaan analog dari sensor TDS
//   int rawValue = analogRead(TDS_PIN);
  
//   // Konversi nilai analog ke nilai TDS menggunakan kalkulasi yang sesuai dengan sensor Anda
//   // Misalnya, Anda mungkin perlu melakukan koreksi dan kalibrasi tergantung pada karakteristik sensor Anda
//   float tdsValue = map(rawValue, TDS_MIN, TDS_MAX, TDS_MIN_PPM, TDS_MAX_PPM);
  
//   return tdsValue;
// }

// /*****************
//  * Showing captured data at Serial Monitor
//  ******************/
// void printData(void) {
//   Serial.print("Merah= ");
//   Serial.print(red);
//   Serial.print("   Hijau = ");
//   Serial.print(grn);
//   Serial.print("   Biru = ");
//   Serial.print(blu);
//   Serial.print(" - ");
//   Serial.print(color);
//   Serial.println(" Terdeteksi");
//   delay(1000);
// }

// void getColor() {
//   readRGB();
//   // MERAH, HIJAU, BIRU MERUPAKAN WARNA UTAMA

//   display.clearDisplay();
//   display.setTextSize(1);
//   display.setTextColor(SSD1306_WHITE);
//   display.setCursor(0, 0);
//   display.println("EcolutionaryOilSaver!");
//   display.println();
//   if (red >= 4  && red <= 7  && grn >= 17 && grn <= 25 && blu >= 13 && blu <= 20) color = "MERAH";
//   else if (red >= 8 && red <= 21  && grn >= 6 && grn <= 16 && blu >= 11 && blu <= 21) color = "HIJAU";
//   else if (red >= 15 && red <= 27  && grn >= 5 && grn <= 25 && blu >= 5  && blu <= 20) color = "BIRU";
//   else if (red >= 3  && red <= 7   && grn >= 5  && grn <= 11 && blu >= 8  && blu <= 16) color = "KUNING";
//   else if (red >= 6 && red <= 12  && grn >= 5 && grn <= 10 && blu >= 4  && blu <= 10) color = "BIRU MUDA";
//   else if   (red >= 4  && red <=   16   && grn >= 11  && grn <= 17 && blu >= 11  && blu <= 16) color = "OREN";
//   else if (red >= 6 && red <= 13 && grn >= 14 && grn <= 24 && blu >= 7 && blu <= 15) color = "MERAH";
//   else if (red >= 8 && red <= 12  && grn >= 17 && grn <= 22 && blu >= 17 && blu <= 22) color = "COKLAT";
//   else if (red >= 3  && red <= 5  && grn >= 3  && grn <= 5 && blu >= 2  && blu <= 6)  
//   { color = "";
//           display.clearDisplay();
//           display.setTextSize(2);
//           display.setTextColor(SSD1306_WHITE);
//           display.setCursor(0, 0);
//           display.println("BUKAN");
//           display.println();
//           display.println("MINYAK!");
//           display.display();
//           tone(BUZZER_PIN, 50); // Bunyi dengan frekuensi 1000 Hz
//           delay(5000);
//           noTone(BUZZER_PIN); // Matikan buzzer
//           delay(5000);
//           activateDevices2();

//   }
//   else if (red >= 30 && red <= 50 && grn >= 30 && grn <= 65 && blu >= 30 && blu <= 53) color = "MINYAK";
//   else { color = "TERDETEKSI MINYAK!";
//           display.clearDisplay();
//           display.setTextSize(2);
//           display.setTextColor(SSD1306_WHITE);
//           display.setCursor(0, 0);
//           display.println(color);
//           display.display();
//           tone(BUZZER_PIN, 500); // Bunyi dengan frekuensi 1000 Hz
//           delay(50);
//           noTone(BUZZER_PIN); // Matikan buzzer
//           delay(3000);
//           display.clearDisplay();
//           display.setTextSize(1);
//           display.setTextColor(SSD1306_WHITE);
//           display.setCursor(0, 0);
//           display.println("MASUKKAN KODE ANDA!");
//           display.println();
//           display.println("...................");
//           display.display();
//           tone(BUZZER_PIN, 500); // Bunyi dengan frekuensi 1000 Hz
//           delay(50);
//           noTone(BUZZER_PIN); // Matikan buzzer
//           delay(3000);
//   } 

//   Serial.println("color: " + color);
//   display.println("WARNA :" + color);
//   delay(500);
  
//   float weight = scale.get_units(10); // Get the average of 10 readings
//   if (isnan(weight)) { // Memperbaiki kondisi if
//     Serial.println("Failed to read from HX711 sensor!");
//     return;
//   }
//   Serial.println("Weight: " + String(weight) + " g"); // Menambahkan tanda kurung penutup
//   display.println();
//   display.print("BERAT: ");
//   display.print(weight);
//   display.println(" g");
  
//   // Baca nilai TDS
//   float tdsValue = readTDS();

//   if (isnan(tdsValue)) { // Memeriksa jika nilai TDS valid
//     Serial.println("Failed to read from TDS sensor!");
//     return;
//   }

//   Serial.println("TDS Value: " + String(tdsValue)); // Menampilkan nilai TDS
//   display.println();
//   display.print("NILAI TDS: ");
//   display.print(tdsValue, 0); // Menampilkan nilai tdsValue tanpa desimal
//   display.println(" ppm"); // Menampilkan unit ppm setelah nilai
//   display.display();

//   if (WiFi.status() == WL_CONNECTED) {
//     WiFiClient wClient;

//     // Manual connection to check if the server is reachable
//     Serial.println("Connecting to server...");
//     if (!wClient.connect(server, 80)) {
//       Serial.println("Manual connection failed: connection refused");
//       return;
//     } else {
//       Serial.println("Manual connection success");
//       wClient.stop();
//     }

//     HTTPClient http;
//     String url = "http://" + String(server) + "/prokon/public/simpan/" + String(weight) + "/" + color + "/" + String(tdsValue); // Menambahkan nilai TDS ke URL

//     Serial.println("Mengirim data ke: " + url);

//     http.begin(wClient, url);
//     http.setTimeout(3000); // Set timeout to 3 seconds
//     int httpResponseCode = http.GET();

//     if (httpResponseCode > 0) {
//       Serial.print("HTTP Response code: ");
//       Serial.println(httpResponseCode);
//       String payload = http.getString();
//       // Serial.println("Response payload: " + payload);
//     } else {
//       Serial.print("Error on sending GET request: ");
//       Serial.println(httpResponseCode);
//       Serial.println(http.errorToString(httpResponseCode));
//     }

//     http.end();
//   } else {
//     Serial.println("WiFi not connected");
//   }
// }

// void activateDevices() {
//   relayOnTime = millis();
//   relayState = true;
//   digitalWrite(RELAY_PIN, HIGH);
//   digitalWrite(LED_PIN, HIGH);

//   // Settingan nada buzzer
//   tone(BUZZER_PIN, 15000); // Menghasilkan nada 1000 Hz pada pin buzzer

//   // Set relay on time for 5 seconds
//   unsigned long relayOnDuration = 5000; // 20 seconds
//   while (millis() - relayOnTime < relayOnDuration) {
//     // Wait for 5 seconds
//   }

//   // Turn off the relay after 5 seconds
//   digitalWrite(RELAY_PIN, LOW);
//   digitalWrite(RELAY_PIN_2, LOW);
//   digitalWrite(LED_PIN, LOW);
//   noTone(BUZZER_PIN); // Matikan nada buzzer setelah 5 detik
//   relayState = false;
// }

// void activateDevices2() {
//   relayOnTime = millis();
//   relayState = true;
//   digitalWrite(RELAY_PIN_2, HIGH);
//   digitalWrite(LED_PIN, HIGH);

//   // Settingan nada buzzer
//   tone(BUZZER_PIN, 15000); // Menghasilkan nada 1000 Hz pada pin buzzer

//   // Set relay on time for 5 seconds
//   unsigned long relayOnDuration = 5000; // 20 seconds
//   while (millis() - relayOnTime < relayOnDuration) {
//     // Wait for 5 seconds
//   }

//   // Turn off the relay after 5 seconds
//   digitalWrite(RELAY_PIN, LOW);
//   digitalWrite(RELAY_PIN_2, LOW);
//   digitalWrite(LED_PIN, LOW);
//   noTone(BUZZER_PIN); // Matikan nada buzzer setelah 5 detik
//   relayState = false;
// }

// void deactivateDevices() {
//   if (relayState && millis() - relayOnTime >= 1000) { // Menyalakan perangkat selama 1 detik
//     relayState = false;
//     digitalWrite(RELAY_PIN, LOW);
//     digitalWrite(RELAY_PIN_2, LOW);
//     digitalWrite(BUZZER_PIN, LOW);
//     digitalWrite(LED_PIN, LOW);
//     digitalWrite(LED_PIN, HIGH);
//     delay(100);
//     digitalWrite(LED_PIN, LOW);
//     delay(500);
//   }
//   if (!relayState) {
//     digitalWrite(LED_PIN, HIGH);
//     delay(100);
//     digitalWrite(LED_PIN, LOW);
//     delay(500);
//   }
// }