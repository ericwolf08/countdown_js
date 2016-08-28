<html>
  <head>
    <meta charset="utf-8"> 
    <title>Japanurlaub</title>
    <link text="text/css" rel="stylesheet" href="style.css" />
    <script type="text/javascript">
        
	function imageLine()
	{
                
		var	checkInterval = null,
			imageLineInterval = null,
			currentImage = -1;
		images = new Array();
		<?php
                    $allebilder = scandir('bilder'); 
                    $j=0;
                    foreach ($allebilder as $bild) {
                        if($bild != "." && $bild != ".."){
                            echo "images[$j] = \"bilder/" . $bild . "\"; ";
                            $j++;
                        }
                    }
                ?>
		loadingImages = new Array();
		this.run = function()
		{
			checkInterval = window.setInterval('this.checkIfLoaded();', 100);
			for(i = 0;i < images.length;i++)
			{
				image = images[i];
				loadingImages.push(new Image);
				loadingImages[i].src = image;
			}
		}
		
		this.checkIfLoaded = function()
		{
			allLoaded = true;
			for(i = 0;i < loadingImages.length;i++)
			{
				loadingImage = loadingImages[i];
				if(!loadingImage.complete && i<3)
					allLoaded = false;
			}
			if(allLoaded)
			{
				window.clearInterval(checkInterval);
				this.startImageLine();
				window.setInterval('this.startImageLine();', 10000);
			}
		}
		
		this.startImageLine = function()
		{
			this.showImage();
                        
			if(currentImage == (loadingImages.length - 1))
				currentImage = 0;
			else
				currentImage += 1;
                        element = document.getElementById('imageline');
			element.style.height = "100%";
			element.style.width = "100%";
			element.style.backgroundImage = 'url(' + loadingImages[currentImage].src + ')';
                        element.style.backgroundSize = '100% 100%';
			// Dem Element das aktuelle Bild als Hintergrundbild setzen
			
			window.setTimeout('this.hideImage();', 9500);
			// Das Bild in 9,5 Sekunden ausblenden
		}
		
		this.hideImage = function()
		{
			element = document.getElementById('imageline');
			for(i = 0;i <= 100;i++)
				window.setTimeout('element.style.filter = "Alpha(opacity=' + (100 - i) + ')"; element.style.MozOpacity = ' + (1 - i / 100) + '; element.style.opacity = ' + (1 - i / 100) + ';', i * 5);
			// Von 0 bis 100 (Prozent)
			// Das i * 5 dient dazu, dass das Ausblenden nicht zu schnell geht
		}
		
		this.showImage = function()
		{
			element = document.getElementById('imageline');
			for(i = 0;i <= 100;i++)
				window.setTimeout('element.style.filter = "Alpha(opacity=' + i + ')"; element.style.MozOpacity = ' + i / 100 + '; element.style.opacity = ' +  i / 100 + ';', i * 5);
			// Hier das selbe wie bei hideImage
		}
		
		this.run();
	}
        var songs = new Array();
        var songnames= new Array();
        var songcounter = 1;
        <?php
            $allelieder = scandir('musik'); 
            $j=0;
            foreach ($allelieder as $lied) {
                if($lied != "." && $lied != ".."){
                    echo "songs[$j] = \"musik/" . $lied . "\"; ";
                    $length = strlen($lied);
                    $temp = substr($lied, 0, $length-4);
                    echo "songnames[$j] =\"". $temp . "\"; ";
                    $j++;
                }
            }
        ?>
        
        function nextsong(){
            if(songcounter == (songs.length-1))
                    songcounter = 0;
            else
                    songcounter += 1;
            
            document.getElementById("song").innerHTML= songnames[songcounter];
            document.getElementById("audio_with_controls").src = songs[songcounter];
        }
            
        
	function countdown() {
            window.setTimeout("countdown()", 1000);
            /* Bitte das Datum anpassen (Jahr, Monat - 1, Tag, Stunde, Minute, Sekunde) */
            var bis = new Date(2016, (11 - 1), 6, 14, 00, 00);
            var jetzt = new Date(); 
            var rest = Math.floor((bis-jetzt.getTime())/1000);
            var wochen = 0;
            var tage = 0;
            var stunden = 0;
            var minuten = 0;

            if (rest >= 604800) { wochen = Math.floor(rest/604800);
              rest -= wochen*604800;
            }

            if (rest >= 86400) { tage = Math.floor(rest/86400);
              rest -= tage*86400;
            }

            if (rest >= 3600) { stunden = Math.floor(rest/3600);
              rest -= stunden*3600;
            }

            if (rest >= 60) { minuten = Math.floor(rest/60);
              rest -= minuten*60;
            }

            /* Bitte DIV-ID anpassen */
            document.getElementById('cd').innerHTML = wochen+' Wochen, '+tage+' Tage, '+stunden+' Stunden, '+minuten+' Minuten und '+rest+' Sekunden';
        }
	window.onload = function()
	{
		imageLine();
                countdown();
	}
    </script>
    <audio id="audio_with_controls" autoplay="true" loop="true" src="musik/Shakuhachi Rain.mp3"
            type="audio/mp3">
    </audio>
    </head>
    <body>
        <div id="imageline" onclick="nextsong()"></div>
        <p id="cd" style="display: table-cell; padding: 10px; position: absolute; top: 40%; vertical-align: middle; text-align: center; color: white; font-size: 200%; margin-left: auto;margin-right: auto;left: 0;right: 0;" align=\"center\"" >    
        </p>
        <p id="song" style="display: table-cell; padding: 10px; position: absolute; top: 85%; vertical-align: top; text-align: right; color: white; font-size: 150%; margin-left: auto;margin-right: auto;left: 0;right: 0;" align=\"right\"">
        Shakuhachi Rain
        </p>
    </body>
</html>

