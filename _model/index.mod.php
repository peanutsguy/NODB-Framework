<?php
require '_tools/extras.php';
function get_csv($filepath) {
	$handle = fopen ( $filepath, "r" );
	
	$result = array ();
	while ( ($row = fgetcsv ( $handle, 0, ',', '"' )) !== FALSE ) {
		$result [] = $row;
	}
	
	return $result;
}
function format($id, $data) {
	$result = "";
	if ($id == "reviews") {
		$result = "<div id=t_$id>\"$data[2]\"</div><div id=a_$id>$data[1]</div><div id=d_$id>$data[0]</div>";
	} elseif ($id == "activities") {
		$result = "<div id=d_$id>$data[0]</div><div id=n_$id>$data[1]</div><div id=t_$id>$data[2]</div>";
	}
	return $result;
}
function form_div($id, $texto) {
	$body = "";
	$j = 1;
	$body .= "<div id=$id>";
	foreach ( $texto as $entry ) {
		$sid = $id . "" . $j;
		$body .= "<div id=" . $sid . " class=$id>";
		$body .= format ( $id, $entry );
		$body .= "</div>";
		$j ++;
	}
	$body .= "</div>\n";
	return $body;
}
function loader($path) {
	$dh = opendir ( $path );
	$result = array ();
	while ( false !== ($filename = readdir ( $dh )) ) {
		if (($filename != ".") && ($filename != "..")) {
			$result [] = $filename;
		}
	}
	// print_p ( $result );
	return $result;
}

$src = basename ( $_SERVER ['PHP_SELF'], ".php" );

$tpath = "_sources/text/" . $src;
$ipath = "_sources/img/" . $src;
$spath = "_sources/css/" . $src;

$tfiles = loader ( $tpath );
$ifiles = loader ( $ipath );
$sfiles = loader ( $spath );

foreach ( $tfiles as $textf ) {
	$fpath = $tpath . "/" . $textf;
	$aname = basename ( $fpath, ".csv" );
	$text [$aname] = get_csv ( $fpath );
}

$styles = "";
foreach ( $sfiles as $instyler ) {
	$fpath = $spath . "/" . $instyler;
	$styles .= "\n<link rel=\"stylesheet\" type=\"text/css\" href=\"$fpath\">";
}

// print_p($text);

$act = form_div ( "activities", $text ["activities"] );
$rev = form_div ( "reviews", $text ["reviews"] );

?>