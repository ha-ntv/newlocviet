<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
header('Content-Type: application/json');
if(isset($_REQUEST['callback'])) {
	$string = array();
	$domain = isset($_REQUEST['domain']) ? $_REQUEST['domain'] : '';
	$ext    = isset($_REQUEST['ext']) ? $_REQUEST['ext'] : '';

	$domain = explode(',', $domain);
	$ext    = explode(',', $ext);
	if(count($domain)>0) {
		for($i=0; $i<count($domain); $i++) {
			$pos = strpos($domain[$i], '.');
			if($pos === false) {
				if(count($ext)>0) {
					for($j=0; $j<count($ext); $j++) {
						array_push($string, $domain[$i] . $ext[$j]);
					}
				}
			} else {
				array_push($string, $domain[$i]);
			}
		}
	}
	$string = array_keys(array_flip($string));

	$callback = (string)$_REQUEST['callback'];
	if(!$callback) $callback = 'callback';

	echo "$callback(" . json_encode($string) .")";

} else echo 'Error--';