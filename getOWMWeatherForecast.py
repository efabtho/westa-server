#!/usr/bin/python3.4
# -*- coding: utf-8 -*-

# TFN 180331 fixed wrong sunrise/sunset time during summer time
# TFN 171030 corrected sunset/sunrise time according to DST status
# TFN 170924 getting further weather parameters using OWM service

import pyowm
import json
import datetime
import configparser
import time


DEBUG = False

def getOWMForecast(API_Key, Location):
    
    owm           = pyowm.OWM(API_Key)
    #Documentation is at https://pyowm.readthedocs.org/en/latest/pyowm.html
     
    #establish time constant
    in3hours = pyowm.timeutils.next_three_hours()
     
    #Retreive daily forecast
    forecast = owm.daily_forecast(Location)
     
    #Retrieve forecast at location in 3 hours
    latertoday = forecast.get_weather_at(in3hours)
    decoded_later = json.loads(latertoday.to_JSON()) #its easier to load it into JSON and decode it!
    detailed_status_later = decoded_later['detailed_status'] #detailed status in 3 hours
     
    # Search for current weather
    observation     = owm.weather_at_place(Location)
    w               = observation.get_weather()
    decoded_w       = json.loads(w.to_JSON())
    detailed_status = decoded_w['detailed_status']

    now = time.localtime()  
    if DEBUG:
        print("Sommerzeit: ", now.tm_isdst) # DayLightSavingTime: 1 / winter time: 0
        
    # write sunrise time to txt file
    if now.tm_isdst == 0: # winter time
        sunrise = (datetime.datetime.strptime(w.get_sunrise_time('iso'),"%Y-%m-%d %H:%M:%S+00") + \
                   datetime.timedelta(hours=1)).strftime("%H:%M")
    else:
        sunrise = (datetime.datetime.strptime(w.get_sunrise_time('iso'),"%Y-%m-%d %H:%M:%S+00") + \
                   datetime.timedelta(hours=2)).strftime("%H:%M")
        
    fh = open("UserRQ_curSunriseTime.txt","w")
    print(sunrise,"h", file=fh)
    fh.close()

    # write sunset time to txt file
    if now.tm_isdst == 0: # winter time
        sunset = (datetime.datetime.strptime(w.get_sunset_time('iso'),"%Y-%m-%d %H:%M:%S+00") + \
                  datetime.timedelta(hours=1)).strftime("%H:%M")
    else:
        sunset = (datetime.datetime.strptime(w.get_sunset_time('iso'),"%Y-%m-%d %H:%M:%S+00") + \
                  datetime.timedelta(hours=2)).strftime("%H:%M")
        
    fh = open("UserRQ_curSunsetTime.txt","w")
    print(sunset,"h", file=fh)
    fh.close()

    # write cloud amount to txt file
    clouds = str(decoded_w['clouds'])
    fh = open("UserRQ_curCloudAmount.txt","w")
    print(clouds, "%", file=fh)
    fh.close()

    return

# RPi3 weather station parameters
config = configparser.ConfigParser()
config.read("/home/pi/westa-config.txt")
API_Key  = config.get("OWM","API_Key")
Location = config.get("OWM","Location")

getOWMForecast(API_Key, Location)




