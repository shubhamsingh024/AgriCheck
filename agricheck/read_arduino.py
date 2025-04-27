import serial
import mysql.connector

# **Setup serial communication**
ser = serial.Serial('COM3', 115200, timeout=1)  # Change 'COM3' to your port

# **Connect to MySQL Database**
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="agricheck"
)
cursor = conn.cursor()

while True:
    try:
        data = ser.readline().decode().strip()
        if data:
            soil_moisture, raindrop = map(int, data.split(','))

            # **Determine moisture status**
            if soil_moisture < 30:
                moisture_status = "Dry"
            elif 30 <= soil_moisture <= 70:
                moisture_status = "Moist"
            else:
                moisture_status = "Wet"

            # **Determine rainfall status**
            if raindrop < 30:
                rain_status = "No Rain"
            elif raindrop < 70:
                rain_status = "Light Rain"
            else:
                rain_status = "Heavy Rain"

            # **Insert into MySQL**
            sql = "INSERT INTO sensor_readings (soil_moisture, raindrop, moisture_status, rain_status) VALUES (%s, %s, %s, %s)"
            cursor.execute(sql, (soil_moisture, raindrop, moisture_status, rain_status))
            conn.commit()

            print(f"Data Inserted: Soil Moisture: {soil_moisture} ({moisture_status}), Raindrop: {raindrop} ({rain_status})")

    except Exception as e:
        print("Error:", e)
        break

# Close MySQL connection
cursor.close()
conn.close()
ser.close()
