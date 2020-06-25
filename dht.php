<?php
class dht11{
 public $link='';
 function __construct($temperature, $humidity, $pump, $light, $fan){
  $this->conn();
  $this->storeInDB($temperature, $humidity, $pump, $light, $fan);
 }
 
 function conn(){
  $this->link = mysqli_connect('localhost','root','okeidot13123') or die('Cannot connect to the DB');
  mysqli_select_db($this->link,'temphumid') or die('Cannot select the DB');
 }
 
 function storeInDB($temperature, $humidity, $pump, $light, $fan){
  $query = "insert into dht11 set humidity='".$humidity."', temperature='".$temperature."', light='".$light."', pump='".$pump."', fan='".$fan."'";
  $result = mysqli_query($this->link,$query) or die('Errant query:  '.$query);
 }
 
}
if($_GET['temperature'] != '' and  $_GET['humidity'] != '' and $_GET['pump'] != '' and $_GET['fan'] != '' and $_GET['light'] != ''){
 $dht11=new dht11($_GET['temperature'],$_GET['humidity'],$_GET['pump'],$_GET['light'],$_GET['fan']);
}


?>
