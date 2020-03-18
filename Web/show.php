<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<title>Show</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
	 .container {
      width: 300px;
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
	  

      #g2, #g3 {
        width:400px; height:320px;
        display: inline-block;
        margin: 1em;
      }


    </style>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Welcome again</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mobile.css">
	<script type='text/javascript' src='js/mobile.js'></script>
</head>
<body>
	<div id="header">
		<h1><a href="index.html">Welcome <span>Our Mini-Project IOT</span></a></h1>
		<ul id="navigation">
			<li class="current">
				<a href="index.html">Home</a>
			</li>
			<li>
				<a href="show.html">Show</a>
			</li>
		</ul>
	</div>
	<div id="body">
		<center>
 
    <div id="g1"></div>
    <div id="g2"></div>
    <div id="g3"></div>
    <div id="g4"></div>
    

    <script src="js/raphael-2.1.4.min.js"></script>
    <script src="js/justgage.js"></script>
    <script>
      var g1, g2, g3;
	  
	 
		

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
		  
        }, 50);
      };
	  
	  

    </script>
		</center>
	</div>
	
	<div id="footer">
	<p>
			<center>...</center>
			</p>
	</div>
</body>
</html>