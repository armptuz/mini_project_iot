


<!doctype html>

<html><head>
    <title>Status</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
	 .container {
      width: 450px;
      margin: 0 auto;
      text-align: center;
    }
      body {
        text-align: center;
      }

      #g1 {
        width:400px; height:320px;
        display: inline-block;
        margin: 1em;
      }
	  

      #g2, #g3, #g4 {
        width:400px; height:320px;
        display: inline-block;
        margin: 1em;
      }

      p {
        display: block;
        width: 450px;
        margin: 2em auto;
        text-align: left;
      }
    </style>


  </head>
  <body >
  <a href="index.html"><font size="20"><h6>Main page</h6></font> </a>
 
    <div id="g1"></div>
    <div id="g2"></div>
    <div id="g3"></div>
    <div id="g4"></div>
    

    <script src="raphael-2.1.4.min.js"></script>
    <script src="justgage.js"></script>
    <script>
      var g1, g2, g3, g4;
	  
	 
		

      window.onload = function(){
        var g1 = new JustGage({
          id: "g1",
          value: 0,
          min: 0,
          max: 100,
          title: "Water",
          label: "%"
        });

        var g2 = new JustGage({
          id: "g2",
          value: 0,
          min: 0,
          max: 100,
          title: "Temp",
          label: "C"
        });

        var g3 = new JustGage({
          id: "g3",
          value: 0,
          min: 0,
          max: 100,
          title: "Humidity",
          label: "%"
        });

       
		

           setInterval(function() {
			
          xmlhttpWater = new XMLHttpRequest();
		  xmlhttpWater.open("GET","dataWater.php",false);
		  xmlhttpWater.send(null);
		  var data1=parseInt(xmlhttpWater.responseText);
		  
		  xmlhttpWater = new XMLHttpRequest();
		  xmlhttpWater.open("GET","dataTemp.php",false);
		  xmlhttpWater.send(null);
		  var data2=parseInt(xmlhttpWater.responseText);
		  
		  xmlhttpWater = new XMLHttpRequest();
		  xmlhttpWater.open("GET","dataHumidity.php",false);
		  xmlhttpWater.send(null);
		  var data3=parseInt(xmlhttpWater.responseText);

          g1.refresh(data1);
          g2.refresh(data2);
          g3.refresh(data3);
          //g4.refresh(getRandomInt(0, 50));
		  
        }, 50);
      };
	  
	  

    </script>
    
 

  </body>
</html>
