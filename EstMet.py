#---LIBRERIAS
import RPi.GPIO as GPIO			#Para manipular pines del Pi
import time						#Para utilizar el paso del tiempo, delays, etc.
from threading import Timer
from picamera import PiCamera	#Librería para utilizar la cámara de RPi
import http.client, json			#para la conexion con la base de datos y servidor	


#---DEFINICION I/O
GPIO.setmode(GPIO.BOARD)	#Pines físicos del Pi
GPIO.setwarnings(False)		#Elimina warnings
Switch = 8					#Nombre significativo para el pin 8	
GPIO.setup(Switch, GPIO.IN)	#Para apagar la captura de datos
#Temp
GPIO.setup(40, GPIO.IN)		#Pin definido como entrada
GPIO.setup(38, GPIO.IN)		#31-40, valor de adc paralelo de temp
GPIO.setup(37, GPIO.IN)
GPIO.setup(36, GPIO.IN)
GPIO.setup(35, GPIO.IN)
GPIO.setup(33, GPIO.IN)
GPIO.setup(32, GPIO.IN)
GPIO.setup(31, GPIO.IN)
#Lluvia
CLK_lluvia = 3				#Nombres significativos para pines de adc serie - lluvia
DOUT_lluvia = 5
CS_lluvia = 7
GPIO.setup(CLK_lluvia, GPIO.OUT)								#Pin definido como salida, clock del adc serie
GPIO.setup(DOUT_lluvia, GPIO.IN, pull_up_down = GPIO.PUD_UP)	#Entrada de adc serie de intensidad de lluvia
GPIO.setup(CS_lluvia, GPIO.OUT)								#Chip Select de adc serie de intensidad de lluvia
#Viento
GPIO.setup(11, GPIO.IN) 
#Conexión con DB
headers = {"charset" : "utf-8", "Content-Type": "application/json"}
var = 11  


#---FUNCIONES
#Deja un solo decimal en el numero original
def NoDec (iin):
	out = 0
	out = iin*10
	out = out//1
	out = out/10
	return out
#Guarda los valores de una lista de 8 elementos como un entero de 8 digitos
def int_list (lista, ent):
	a = 0
	ent = 0
	while(a < 8):
		ent = ent + (lista[7-a]*(10**a))
		a = a+1
	return ent
#Pasa de binario a decimal (8 digitos)
def BintoDec (bina, dec):
	a = 0
	dec = 0
	while (a < 8):
		dec = dec + (bina%10*2**a)
		bina = bina//10
		a = a+1
	return dec
#Pasa el valor (en decimal) de un adc paralelo a un valor de temperatura (en celsius)
def temperatura (adc, temp):
	temp = 0
	temp = 2*adc - 49.5
	return temp
#Pasa el valor (en decimal) de un adc serie a un valor de intensidad de lluvia/humedad (en celsius)
def Lluvia(adc, lluv):
	lluv= 0
	lluv = 100 - (0.39*adc)
	return lluv
#Calcula la velocidad de viento
def cal_vel (tiempoo):
	velocidad = ((3.420)/tiempoo)
	return velocidad
#Funcion call back que ayuda a interpretar los pulsos del sensor de hall del anemometro
def my_callback(channel):  	
	global tiempo_ini	
	global viento	
	
	if GPIO.input(11) and tiempo_ini == 0:     # if port 25 == 1 
		tiempo_ini = time.time()
	
	elif GPIO.input(11) and tiempo_ini != 0:     # if port 25 == 1 
		tiempo_final = time.time()
		tiempo_total = tiempo_final-tiempo_ini
		viento = cal_vel(tiempo_total)
		viento = NoDec(viento)

		#print('Velocidad de Viento:',viento,'km/h')
		
		tiempo_final = 0	
		tiempo_ini = 0
#Se comunica con la base de datos para mostrar datos reales de los sensores en la página web y aplicacion android
def conex_serv(temp, lluvia, viento):
	global var
	conn =  http.client.HTTPConnection("www.estmet.tk")
	# Envia el archivo Json
	sample = {"Indice":var,"Temperatura":temp,"Lluvia":lluvia,"Viento":viento}
	sampleJson = json.dumps(sample, ensure_ascii = 'False')
	conn.request("POST", "/php_connection.php", sampleJson, headers)
	var = var + 1
	time.sleep(60)


#---INICIALIZACIONES
ON = 1							#Switch que enciende la captura de datos
#Temp
temp_lista_bin = [0, 0, 0, 0, 0, 0, 0, 0]	#Entrada de temperatura, en lista
temp_int_bin = 0					#En binario
temp_int_dec = 0					#En decimal
temp = 0						#Valor real de temp en celsius
#Lluvia
lluv_lista = [0, 0, 0, 0, 0, 0, 0, 0]		#Analogo a la temperatura
lluv_bin = 0
lluv_dec = 0
lluv = 0
#Viento
tiempo_ini = 0
viento = 0.0
GPIO.add_event_detect(11, GPIO.RISING, callback=my_callback)  
#Camara
camera = PiCamera()
camera.resolution = (1024, 768)
camera.vflip = True
#camera.framerate = 15
#camera.sharpness = 0
#camera.contrast = 0
#camera.brightness = 50
#camera.saturation = 0
#camera.hflip = False


#---PROGRAMA PRINCIPAL
while (ON == True):
	#**Camara**	
	camera.capture('estacion.png')

	print('\n************************************\n')
	#**Temperatura**				#Se usa adc paralelo adc0804
	temp_lista_bin[0] = GPIO.input(40)	#Ingresa el valor digital de temp en paralelo
	temp_lista_bin[1] = GPIO.input(38)	
	temp_lista_bin[2] = GPIO.input(37)
	temp_lista_bin[3] = GPIO.input(36)
	temp_lista_bin[4] = GPIO.input(35)
	temp_lista_bin[5] = GPIO.input(33)
	temp_lista_bin[6] = GPIO.input(32)
	temp_lista_bin[7] = GPIO.input(31)

	temp_int_bin = int_list(temp_lista_bin, temp_int_bin)	#Se pasa temp de lista a entero bin	
	temp_int_dec = BintoDec(temp_int_bin, temp_int_dec)	#Se pasa temp a decimal
	temp = temperatura(temp_int_dec, temp)			#Se pasa a valor real en celsius de temperatura
	print('Temperatura:', temp, '°C')								
	
	#**Lluvia**						#Se usa adc serie adc0831
	GPIO.output(CS_lluvia, False) 		#Se inicia CS en bajo (activo)
	GPIO.output(CLK_lluvia, False) 		#Se inicia CLK en bajo
	time.sleep(0.00001)				#Se espera 10microsegundos, hay que esperar minimo 350ns despues de CS en bajo para iniciar clock
	
	semiciclo = 0	#Lleva la cuenta de los semiperiodos
	pos_lluv = 0		#Pos en la lista del valor de lluvia en binario (0 = MSB)

	while (semiciclo < 19):		#Periodo y medio de inicializacion y 8 periodos para que salga el dato (19 semiperiodos)
		if (GPIO.input(CLK_lluvia) == True):	#Con este if se hace oscilar el clock
			GPIO.output(CLK_lluvia, False)
			if (semiciclo > 2):				#Si ya paso el ciclo y medio de inicializacion entonces se empieza a guardar el dato en los altos del clock
				lluv_lista[pos_lluv] = GPIO.input(DOUT_lluvia)
				pos_lluv = pos_lluv+1
			time.sleep(0.000025)	
		else:							#En los bajos del clock no se captura nada
			GPIO.output(CLK_lluvia, True)
			time.sleep(0.000025)	
		semiciclo = semiciclo+1			#Se aumentan los semiperiodos

	GPIO.output(CS_lluvia, True) 			#Tanto chipselect como el clock, se pasan a bajo durante aprox 1 segundo (delay mas adelante), no se captura
	GPIO.output(CLK_lluvia, False) 

	lluv_bin = int_list(lluv_lista, lluv_bin)		#Pasa la lista entero binario
	lluv_dec = BintoDec(lluv_bin, lluv_dec)	#Pasa el entero binario a decimal
	lluv = Lluvia(lluv_dec, lluv)				#Se pasa este valor del adc serie a un valor real de intensidad de lluvia (%)
	lluv = NoDec(lluv)						#Se eliminan los decimales, solo se deja 1 decimal
	print('Intensidad de Lluvia:',lluv,'%')

	#**Viento**
	viento = NoDec(viento)
	if (viento == 0.0):
		print('Velocidad de Viento:',viento,'km/h')
		conex_serv(temp, lluv, viento)
	else:
		print('Velocidad de Viento:',viento,'km/h')
		conex_serv(temp, lluv, viento)
		viento = 0.0
		
	
	#**Base de Datos**
	#conex_serv(temp, lluv, viento)

	#Mas logica del ciclo
	ON = GPIO.input(Switch)	#Se actualiza lo que maneja el ciclo (fisicamente un switch)
							#La informacion se muestra una vez por segundo


#---FIN
#limpia la info de pines
GPIO.cleanup()
