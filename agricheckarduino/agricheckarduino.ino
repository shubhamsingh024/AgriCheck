#define SOIL_MOISTURE_PIN A1  
#define RAINDROP_SENSOR_PIN A5 

void setup() {
    Serial.begin(115200);
}

void loop() {
    int soilRaw = analogRead(SOIL_MOISTURE_PIN);
    int rainRaw = analogRead(RAINDROP_SENSOR_PIN);

    // **Adjust values based on actual readings!**
    int soilMoisture = map(soilRaw, 900, 400, 0, 100);
    soilMoisture = constrain(soilMoisture, 0, 100);

    int raindrop = map(rainRaw, 900, 300, 0, 100);
    raindrop = constrain(raindrop, 0, 100);

    Serial.print(soilMoisture);
    Serial.print(",");
    Serial.println(raindrop);

    delay(2000);
}

