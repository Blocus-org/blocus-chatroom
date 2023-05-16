<?php
include_once 'php/config.php';
if (isset($donation_links) && !empty($donation_links)) {
	if (count($donation_links) === 1) {
		header("location: https://paypal.me/orgBlocus");
	}
}
