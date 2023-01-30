<?php
include_once('./simple_html_dom.php');

function scraping($url) {
	// create HTML DOM
	$html = file_get_html($url);

	$ret = $html 
	-> find('table[id="main_table_countries_today"]', 0) 
	->innertext;
	
	// clean up memory
	$html->clear();
	unset($html);

	return $ret;
}


// -----------------------------------------------------------------------------
// test it!
$ret = scraping('https://www.worldometers.info/coronavirus/');

print_r($ret);
?>
