#include <Keypad.h>
#include <SoftwareSerial.h>

// Definisi pin keypad
const byte ROWS = 4; // empat baris
const byte COLS = 4; // empat kolom
char keys[ROWS][COLS] = {
  {'1','2','3','A'},
  {'4','5','6','B'},
  {'7','8','9','C'},
  {'*','0','#','D'}
};

byte rowPins[ROWS] = {2, 3, 4, 5}; // Pin baris keypad
byte colPins[COLS] = {6, 7, 8, 9}; // Pin kolom keypad

Keypad keypad = Keypad(makeKeymap(keys), rowPins, colPins, ROWS, COLS);

// Definisi pin untuk komunikasi serial dengan ESP32
#define RXp2 10  // Pin RX untuk komunikasi serial dengan ESP32
#define TXp2 11  // Pin TX untuk komunikasi serial dengan ESP32
SoftwareSerial mySerial(RXp2, TXp2);

void setup() {
  Serial.begin(9600);  // Sesuaikan baud rate dengan ESP32
  mySerial.begin(9600);
}

void loop() {
  char key = keypad.getKey();
  if (key) {
    Serial.print("");
    Serial.println(key); // Tampilkan input keypad di Serial Monitor
    mySerial.print(key); // Kirim input keypad ke ESP32
  }
}
