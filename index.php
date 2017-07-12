<!doctype html>
<html>
    <head>
        <style>
            body {
                background-color: #e0e0e0;
		background-image: url(./html/images/westa-logo.jpg);
		background-size: auto 1800px;
		background-repeat: no-repeat;
                font-family: Arial;
            }
	    span.highlight {
		background-color: navajowhite;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                <!-- width: 60%;-->
                height: 30px;
            }
            #tabelle        {background-color: antiquewhite}
            #ueberschrift   {background-color: #d0d0d2; color: black}
            #zeilengruppe   {background-color: navajowhite; color: black}
            .kursiv         {font-style: italic;}
            th, td          {padding: 2px;}
            th              {text-align: left;}
            td              {text-align: left;}
        </style>
        
        <meta charset="utf-8">
        <title>Wetterstation SOHLDFELD</title>
    </head>
    
    <body>
	<!-- Autorefresh 24/7 Anzeigedisplay <META HTTP-EQUIV="refresh" content="60; URL=http://192.168.178.38"> -->
        <h1>Willkommen auf der Webseite der Wetterstation Sohldfeld</h1>
        <h5>
	    <?php
                echo file_get_contents('/var/www/html/westa_version.txt');
            ?>
	</h5>
    </body>

    <!-- Aktuelle Werte aus der rrd-DB und sql-DB holen und in txt-Dateien für die Anzeige schreiben -->
    <body>
        <?php
            shell_exec("/var/www/html/CallGetDataFromRRD.sh");
            shell_exec("/var/www/html/CallGenerateStatisticTable.sh min-max-values_generated.html WebModeActiv");
        ?>
    </body>

    <table id="tabelle">
        <caption>
            Alle Messdaten vom 
                    <?php
                        echo file_get_contents('/var/www/html/reports/UserRQ_timeStampOfValues.txt');
                    ?>
        </caption>
        <tbody id="zeilengruppe">
            <tr>
                <td>Außentemperatur:</td>
                <td>
                <?php
                    echo file_get_contents('/var/www/html/reports/UserRQ_curTempOutside.txt');
                    ?>
                </td>
            </tr>
            <tr>
                <td>Luftfeuchtigkeit (Aussen):</td>
                <td>
                <?php
                    echo file_get_contents('/var/www/html/reports/UserRQ_curHumOutside.txt');
                    ?>
                </td>
            </tr>
        </tbody>
        <tr>
            <td>Luftdruck:</td>
            <td>
                <?php
        	    echo file_get_contents('/var/www/html/reports/UserRQ_curPressureSealevel.txt');
            	?>
            </td>
        </tr>
        <tr>
            <td>Windgeschwindigkeit:</td>
            <td>
                <?php
        	    echo file_get_contents('/var/www/html/reports/UserRQ_curWindSpeedWM.txt');
            	?>         
            </td>
        </tr>
        <tbody id="zeilengruppe">
            <tr>
                <td>Niederschlagsmenge der letzten 24h:</td>
                <td>    
                    <?php
                    echo file_get_contents('/var/www/html/reports/UserRQ_RainLast24h.txt');
                    ?>         
                </td>
            </tr>
            <tr>
                <td>Regnet es aktuell?</td>
                <td>
                    <?php
                    echo file_get_contents('/var/www/html/reports/UserRQ_isRainingWM.txt');
                    ?>         
                </td>
            </tr>
            </tbody>
        <tr>
            <td>Tageshöchsttemperatur (6h-18h):</td>
            <td>
                <?php
        	    echo file_get_contents('/var/www/html/reports/maxTempDay.txt');
            	?>         
            </td>
        </tr>
        <tr>
            <td>Nächtliche Tiefsttemperatur (18h-6h):</td>
            <td> 
                <?php
        	    echo file_get_contents('/var/www/html/reports/minTempNight.txt');
            	?>         
            </td>
        </tr>
        <tbody id="zeilengruppe">
	        <tr>
	            <td>Temperatur Dachgeschoss:</td>
	            <td>   
	                <?php
	                echo file_get_contents('/var/www/html/reports/UserRQ_curTempTopFloor.txt');
	                ?>         
	            </td>
	        </tr>
	        <tr>
	            <td>Luftfeuchtigkeit Dachgeschoss:</td>
	            <td>   
	              	<?php
	        	    echo file_get_contents('/var/www/html/reports/UserRQ_curHumTopFloor.txt');
	            	?>         
	            </td>
	        </tr>
        </tbody>
	<tr>
		<td>Temperatur Eltern-Schlafzimmer:</td>
	        <td>    
	        	<?php
	            	echo file_get_contents('/var/www/html/reports/UserRQ_curTempParBedroom.txt');
	            	?>         
		</td>
	</tr>
        <tbody id="zeilengruppe">       
	        <tr>
	            <td>Temperatur Wohnzimmer:</td>
	            <td>   
	                <?php
	                echo file_get_contents('/var/www/html/reports/UserRQ_curTempLivingRoom.txt');
	                ?>         
	            </td>
	        </tr>
	        <tr>
	            <td>Luftfeuchtigkeit Wohnzimmer:</td>
	            <td>   
	              	<?php
	        	    echo file_get_contents('/var/www/html/reports/UserRQ_curHumLivingRoom.txt');
	            	?>         
	            </td>
	        </tr>
        </tbody>
        <tr>
            <td>Temperatur Keller:</td>
            <td>
            <?php
                echo file_get_contents('/var/www/html/reports/UserRQ_curTempCellar.txt');
                ?>     
            </td>
        </tr>
        <tr>
            <td>Luftfeuchtigkeit Keller:</td>
            <td>
                <?php
                echo file_get_contents('/var/www/html/reports/UserRQ_curHumCellar.txt');
                ?>     
            </td>
        </tr>
    </table>

    <ul>
        <li><a href="html/last_24h.html"><span class="highlight">Die Daten der letzten 24h</span></a></li>
        <li><a href="html/last_7days.html"><span class="highlight">Die Daten der letzten 7 Tage</span></a></li>
        <li><a href="html/last_30days.html"><span class="highlight">Die Daten der letzten 30 Tage</span></a></li>
        <li><a href="html/last_90days.html"><span class="highlight">Die Daten der letzten 90 Tage</span></a></li>
        <li><a href="html/since_start.html"><span class="highlight">Die Daten seit Aufzeichnungsbeginn</span></a></li>
        <li><a href="html/min-max-values_generated.html"><span class="highlight">Historiendaten: Statistische Werte</span></a></li>
    </ul>
    </p>
        <h4></h4>
    <p>
        
    <ul>
        <li><a href="html/debug.html"><span class="highlight">Debug Informationen</span></a></li>
        <li><a href="html/changeLog.html"><span class="highlight">Change Log</span></a></li>
    </ul>

    <body>
        <h6 class="kursiv">Letzter Seitenaufruf am 
	        <?php
        		echo file_get_contents('/var/www/html/reports/UserRQ_curTime.txt');
        	?>
	    </h6>
    </body>

</html>
