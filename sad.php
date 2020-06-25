<?php
$conn = mysqli_connect("localhost", "root", "okeidot13123", "temphumid");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);  
}
?>
<?php
	$temperature = '';
	$humidity = '';
	$date = '';
	//query to get data from the table
	$sql = "SELECT temperature, humidity, DATE_FORMAT(date,'%b. %e, %Y - %h:%i %p') AS date FROM dht11";
   $result = $conn->query($sql);

	//loop through the returned data
	while ($row = mysqli_fetch_array($result)) {

		$temperature = $temperature . '"'. $row['temperature'].'",';
		$humidity = $humidity . '"'. $row['humidity'] .'",';
		$date = $date . '"'. $row['date'] .'",';
	}

	$temperature = trim($temperature,",");
	$humidity = trim($humidity,",");
	$date = trim($date,",");
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="js/Chart.bundle.min.js"></script>
		<script type="text/javascript" src="js/jssor.slider.min.js"></script>
		<link rel="icon" href="img/logo.png" type="image/png">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="js/w3.css">
		<title>Oyster Mushroom Monitoring System
</title>

		<style type="text/css">		
    a:link, a:visited {
  color: black;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover{
  background-color: #9f9f9f;
}	

			p {
 				 text-indent: 50px;
 				 text-align: justify;
				}

			.container {
				color: #ffffff;
				background: #4caf50;
				border: #ffff solid;
				padding: 8px;
			}
div.a {
  text-align: justify;
  text-justify: inter-word;
  line-height: normal;
 text-align: center;
 color:#9f9f9f;
 font-size: 0.875em}  
		</style>


	</head>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }

?>
	<body>
	<!-- Navbar (sit on top) -->
  <div class="w3-border-bottom w3-round w3-border-green w3-bar w3-hover-white w3-padding w3-card">
    <a href="" class="w3-bar-item w3-button " > <img src="img/logo.png" alt="Mushroom" style="width:20%;max-width:40px"><b>Oyster Mushroom Monitoring System</b></a>
    <?php  if (isset($_SESSION['username'])) : ?>
     <a href="login.php?logout='1'" class="w3-green w3-round-large w3-right">Logout</a>

     <?php endif ?>
  </div>
<!-- Page content -->
<div class="w3-content" style="max-width:1100px">


  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">

  	  <script>
        jssor_slider1_init = function () {
            var options = {
                $AutoPlay: 1,                                    
                $DragOrientation: 3                              
            };
            var jssor_slider1 = new $JssorSlider$('slider1_container', options);
            function ScaleSlider() {
                var paddingWidth = 20;
                var minReserveWidth = 150;
                var parentElement = jssor_slider1.$Elmt.parentNode;
                var parentWidth = parentElement.clientWidth;
                if (parentWidth) {
                    var availableWidth = parentWidth - paddingWidth;
                    var sliderWidth = availableWidth * 0.7;
                    sliderWidth = Math.min(sliderWidth, 600);
                    sliderWidth = Math.max(sliderWidth, 200);
                    if (availableWidth - sliderWidth < minReserveWidth) {
                        sliderWidth = availableWidth;
                        sliderWidth = Math.max(sliderWidth, 200);
                    }

                    jssor_slider1.$ScaleWidth(sliderWidth);
                }
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        };
    </script>


 <div class="w3-col m6  float-right">

	<div id="slider1_container" style="position: relative; float: left; width: 600px;
            height: 600px;" >
            <!-- Slides Container -->
            <div class="w3-round-large w3-border w3-padding-large" data-u="slides" style="position: absolute; width: 889px; height: 600px;
                ">
                <div><img data-u="image" src="img/1.jpg" width="600" height="auto" class="w3-image">
                </div>
                <div><img data-u="image" src="img/2.jpg" width="600" height="auto" class="w3-image">
                </div>
                <div><img data-u="image" src="img/3.jpg" width="600" height="auto" class="w3-image">
                </div>
                <div><img  data-u="image" src="img/4.jpg" width="600" height="auto" class="w3-image">
                </div>
            </div>
            <!-- Trigger -->
            <script>
                jssor_slider1_init();
            </script>
        </div>
    </div>




    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center"><b>Oyster Mushroom</b></h1>
      <p class="w3-medium"><i class="w3-text-green">Pleurotus</i> is scientific name of <i>Oyster Mushroom</i>, is a genus of gilled mushrooms which is one of the most widely eaten mushrooms.</p> <p class="w3-medium">
In cultivation of <i>Oyster Mushrooms</i> need special treatment because it is susceptible to disease. Mushroom growth will be inhibited if the temperature and humidity are not well controlled because temperature and inertia can affect mold growth. <i>Oyster Mushroom</i> growth usually will be optimal at temperatures around <b>20-30°C</b> and humidity around <b>85%-100%</b>. This problem often encountered in the cultivation of<i> Oyster Mushrooms</i>.</p>
    </div>
   
  </div>	

<script>

$(document).ready(function()
{
	setInterval(function(){
	$("#autodiv").text();
	},1000);
});
</script>


		<?php
$sql = "SELECT id, temperature1, humidity1, pump1, fan1, light1, DATE_FORMAT(date,'%b. %e, %Y - %h:%i %p') AS date1 FROM dht22 ORDER BY `dht22`.`id` DESC Limit 1 ";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
?>

  <!-- Menu Section -->
  <div id="autodiv">
    <div class="w3-panel w3-padding-4 w3-green w3-round">
      <h1><b>Data as of: <?php echo $row["date1"] ?></b></h1>
      
      </div>

  <div class="w3-row w3-padding-14" id="menu">
    <div class="w3-col l6 w3-padding-large">

      <h2 class="w3-text-red w3-hover-green"><img class="imgq" src="img/temp.png" alt="Paris" style="width:40px" ><b>Temperature: <b><?php echo $row["temperature1"] ?>°C</b></b></h2>
      <h2 class="w3-text-teal w3-hover-green"><img class="imgq" src="img/moiss.png" alt="Paris" style="width:40px"><b>Humidity: <b><?php echo $row["humidity1"] ?>%</b></b></h2>
      <h2 class="w3-text-blue w3-hover-green"><img class="imgq" src="img/pumpp.png" alt="Paris" style="width:40px"><b>Water Pump: <b><?php echo $row["pump1"] ?></b></b></h2>
          

    </div>
    
    <div class="w3-col l6 w3-padding-large">
    
      <h2 class="w3-text-yellow w3-hover-green"> <img class="imgq" src="img/lighttt.png" alt="Paris" style="width:40px"><b>Heat Lamp: <b><?php echo $row["light1"] ?></b></b></h2>
      <h2 class="w3-text-green w3-hover-green"> <img class="imgq" src="img/wind.png" alt="Paris" style="width:40px"><b>Fan:  <b><?php echo $row["fan1"] ?></b></b></h2>  
      </b>

    </div>
  </div>
</div>
  <?php }
  ?>

	    <div class="container w3-round-large w3-card-4">	
	    <h1><b>Temperature Chart</b></h1>       
			<canvas class="w3-round" id="chart" style="width: 100%; height: 65vh; background: #fff; border: 1px solid #fff; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'line',
		        data: {
		            labels: [<?php echo $date; ?>],
		            datasets: 
		            [{
		                label: 'Temperature',
		                data: [<?php echo $temperature; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(255, 51, 54)',
		                borderWidth: 4
		            },

		            {
		            	label: 'Humidity',
		                data: [<?php echo $humidity; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(51, 170, 255)',
		                borderWidth: 4	
		            }]
		        },
		     
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
		        }
		    });
			</script>
	    </div>
<br>
<br>

<div class="w3-container w3-responsive">

      <h1><button onclick="myFunction1()" class="w3-button w3-block w3-green w3-border w3-xlarge w3-round-xlarge "><b>Show Logs</b></button></h1>

      <div id="Demo" class="w3-container w3-responsive w3-hide ">

      	  <input class=" w3-input w3-border w3-padding" type="text" placeholder="search by date..." id="myInput" onkeyup="myFunction()">
<br>
<div style="width:1035px; height:400px; overflow:auto;">
      <table class="w3-table w3-hoverable w3-bordered " id="myTable" cellspacing="0" cellpadding="1" border="0">
      <b>
        <tr class="w3-green ">
          <th>ID</th>
          <th>Temp</th>
          <th>Humidity</th>
          <th>Water Pump</th>
          <th>Fan</th>
          <th>Heat Lamp</th>
          <th>Date&Time</th>
        </tr> 
        </b>
        </div>


<?php

$sql = "SELECT id, temperature, humidity, pump, fan, light, DATE_FORMAT(date,'%b. %e, %Y - %h:%i %p') AS date FROM dht11 ORDER BY `dht11`.`id` DESC Limit 480";  
 $result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["id"]. "</td><td>" . $row["temperature"] . "</td><td>"
.$row["humidity"]. "</td><td>". $row["pump"]. "</td><td>" .$row["fan"]. "</td><td>" .$row["light"]. "</td><td>" . $row["date"]. "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
?>
</div>
<br>

  <a href="Export.php" class="w3-button w3-blue w3-round-large">Export</a>
</div>


<!-- End page content -->
</div>
</b>
<hr>

<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<script>
function myFunction1() {
  var x = document.getElementById("Demo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>


<footer class="w3-padding-24 w3-container w3-text-gray w3-center w3-opacity w3-small">A Capstone Project<br>
  Isabela State University, Cauayan City, Campus<br>
  College of Computing Studies, Information & Communications Technology<br>
  BSIT 4</footer>
	    
	</body>
</html>