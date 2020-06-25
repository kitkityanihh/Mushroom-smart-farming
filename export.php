<?php
$conn = mysqli_connect("localhost","root","okeidot13123", "temphumid");

$query = "SELECT temperature, humidity, pump, fan, light, DATE_FORMAT(date,'%c/%d/%y - %h:%i %p') AS date FROM dht11 ORDER BY `dht11`.`id` DESC Limit 480";
$result = mysqli_query($conn, $query);

$num_column = mysqli_num_fields($result);		

$csv_header = '';
for($i=0;$i<$num_column;$i++) {
    $csv_header .= '"' . mysqli_fetch_field_direct($result,$i)->name . '",';
}	
$csv_header .= "\n";

$csv_row ='';
while($row = mysqli_fetch_row($result)) {
	for($i=0;$i<$num_column;$i++) {
		$csv_row .= '"' . $row[$i] . '",';
	}
	$csv_row .= "\n";
}	

/* Download as CSV File */
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=record.csv');
echo $csv_header . $csv_row;
exit;
?>