<?php

echo "<a target = '_blank' href = 'https://github.com/mclapsaddle/api.git'> Go to Github </a> <br><br>";

main();


function main() {
	
	$apiCall = 'https://api.covid19api.com/summary';
	
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);

    $arrCountry = Array();
    $arrDeaths = Array();
    foreach($obj -> Countries as $i) {
        array_push($arrCountry, $i->Country);
        array_push ($arrDeaths, $i -> TotalDeaths);
    }
    array_multisort($arrDeaths, SORT_DESC, $arrCountry);
    echo "<table border = '1'>";
	echo "<th> Country </th>";
	echo "<th> Total Deaths </th>";
	echo "<tbody>";
        for ($x = 0; $x < 10; $x++) {
            echo "<tr>";
		 
            echo "<td>".$arrCountry[$x]."</td>";
            echo "<td>".$arrDeaths[$x]."</td>";
            echo "</tr>";
        }
	echo "</tbody>";
    echo "</table>";
		
	

}
function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}