import mysql.connector

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="agricheck"
)
cursor = db.cursor()

sql = "INSERT INTO sensor_readings (soil_moisture, rain_status, suggested_crop) VALUES (%s, %s, %s)"
values = ("Moist", "Light Rain", "Corn")

cursor.execute(sql, values)
db.commit()
print("✅ Test data inserted successfully")

cursor.close()
db.close()
