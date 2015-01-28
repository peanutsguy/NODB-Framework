<?php

/**
 * Prints preformatted variable
 * 
 * @param any $var The variable to be printed
 */
function print_p($var) {
	echo "<pre>";
	print_r ( $var );
	echo "</pre>";
}

?>
