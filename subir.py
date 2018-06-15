import http.client, json
import time

var = 1
potencia =13
red = "8888"

headers = {"charset" : "utf-8", "Content-Type": "application/json"}

while var>=0:
	conn =  http.client.HTTPConnection("wifipower.000webhostapp.com")
	sample = {"var":var,"red":red,"potencia":potencia}
	sampleJson = json.dumps(sample, ensure_ascii = 'False')
	conn.request("POST", "/php_connection.php", sampleJson, headers)
	var = var + 1
	time.sleep(5)

