<?php
// Range.php
if(isset($_POST["From"], $_POST["to"]))
{
	$conn = mysqli_connect("localhost", "root", "okeidot13123", "temphumid");
	$result = '';
	$query = "SELECT * FROM dht11 WHERE date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
	$sql = mysqli_query($conn, $query);
	$result .='
	<table class="table table-bordered">
	<tr class="w3-center">
							    <th align="center" rowspan="2">Date&Time</th>
							    <th rowspan="2">Temp</th>
							    <th rowspan="2">Humidity</th>
							    <th align="center" colspan="3" scope="colgroup">Action Taken</th>
						</tr>
							  <tr>
							    <th>Water Pump</th>
							    <th>Fan</th>
							    <th>Heat Lamp</th>
							  </tr>';
	if(mysqli_num_rows($sql) > 0)
	{
		while($row = mysqli_fetch_array($sql))
		{
			$result .='
			<tr>
			<td>'.$row["date"].'</td>
			<td>'.$row["temperature"].'</td>
			<td>'.$row["humidity"].'</td>
			<td>'.$row["pump"].'</td>
			<td>'.$row["fan"].'</td>
			<td>'.$row["light"].'</td>
			</tr>';
		}
	}
	else
	{
		$result .='
		<tr>
		<td colspan="6">No Data Have Been Found</td>
		</tr>';
	}
	$result .='</table>';
	echo $result;
}
?>