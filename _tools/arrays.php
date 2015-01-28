<?php

/**
 * Converts a 2D array to table with first row as header
 * 
 * @param array $array Array that will be parsed into the table
 * @param string $id [OPTIONAL] Id that will be assigned to the table
 * 
 * @retval string Returns a string containing the table
 */
function array2table($array, $id = FALSE) {
	$i = 0;
	$tb = "";
	foreach ( $array as $entry ) {
		if ($i == 0) {
			$th = "<tr>";
			foreach ( $entry as $key => $info ) {
				$th .= "<th>$key</th>";
			}
			$th .= "</tr>";
		}
		$tb .= "<tr>";
		foreach ( $entry as $info ) {
			$tb .= "<td>$info</td>";
		}
		$tb .= "</tr>";
	}
	$table = "<table";
	if ($id !== FALSE)
		$table .= " id=\"$id\"";
	$table .= ">" . $th . $tb . "</table>";
	return $table;
}

?>
