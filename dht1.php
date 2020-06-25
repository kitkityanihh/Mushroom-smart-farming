<?php
class dht22{
 public $link='';
 function __construct($temperature1, $humidity1, $pump1, $light1, $fan1){
  $this->conn();
  $this->storeInDB($temperature1, $humidity1, $pump1, $light1, $fan1);
 }
 
 function conn(){
  $this->link = mysqli_connect('localhost','root','okeidot13123') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'temphumid') or die('Cannot select the DB');
 }
 
 function storeInDB($temperature1, $humidity1, $pump1, $light1, $fan1){
  $query = "insert into dht22 set humidity1='".$humidity1."', temperature1='".$temperature1."', light1='".$light1."', pump1='".$pump1."', fan1='".$fan1."'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }
 
}
if($_GET['temperature1'] != '' and  $_GET['humidity1'] != '' and $_GET['pump1'] != '' and $_GET['fan1'] != '' and $_GET['light1'] != ''){
 $dht22=new dht22($_GET['temperature1'],$_GET['humidity1'],$_GET['pump1'],$_GET['light1'],$_GET['fan1']);
}


?>
