<?php

	/**
	 * @package Region Halland Array Pagination
	 */
	/*
	Plugin Name: Region Halland Array Pagination
	Description: Specialfunktion för att skapa pagination i en array 
	Version: 1.0.0
	Author: Roland Hydén
	License: MIT
	Text Domain: regionhalland
	*/

	// Returnera array med pagination värden
	function get_region_halland_array_pagination($antal, $size = 5, $getThis = 'sida') {

		// Hur många poster finns det total
		$myAntal = $antal;
		
		// Hur många poster på respektive sida
		$mySize = $size;

		// Hur många sidor det finns totalt
		$myTotalPages = intval(ceil($myAntal/$mySize));

		// Nuvarande sida
		if(isset($_GET[$getThis])){
        	$myCurrentPage = intval($_GET[$getThis]);
	    } else {
	        $myCurrentPage = 1;
	    }

	    // Vilken item som ska börja visas
		$myStartItem = ($mySize * $myCurrentPage) - $mySize;
		
		// Sista item i visningen
		$myEndItem = $myStartItem + $mySize;

		// Föregående sidas
		$myPageMinusEtt = $myCurrentPage - 1;
	    if ($myPageMinusEtt > 1) {
		    $myPrevPage = $myPageMinusEtt;
	    } else {
		    $myPrevPage = 1;
	    }

	    // Nästa sida
	    $myPagePlusEtt = $myCurrentPage + 1;
	    if ($myPagePlusEtt < $myTotalPages) {
		    $myNextPage = $myPagePlusEtt;
	    } else {
		    $myNextPage = $myTotalPages;
	    }
	    
	    // Vilken siffra som ska vara först
	    $myPageStartNumber = $myCurrentPage - 3;
	    if ($myPageStartNumber > 1) {
		    $myStartNumber = $myPageStartNumber;
	    } else {
		    $myStartNumber = 1;
	    }

	    // Vilken siffra som ska vara i slutet
	    $myPageEndNumber = $myStartNumber + 6;
	    if ($myPageEndNumber < $myTotalPages) {
		    $myEndNumber = $myPageEndNumber;
	    } else {
		    $myEndNumber = $myTotalPages;
	    }
	    
	    // Preparera array
		$myData = array();
		$myData['size'] = $mySize;
       	$myData['current_page'] = $myCurrentPage;
		$myData['antal_items'] = $myAntal;
		$myData['total_pages'] = $myTotalPages;
		$myData['start_item'] = $myStartItem;
		$myData['end_item'] = $myEndItem;
		$myData['first_page'] = 1;
		$myData['prev_page'] = $myPrevPage;
		$myData['next_page'] = $myNextPage;
		$myData['last_page'] = $myTotalPages;
		$myData['start_number'] = $myStartNumber;
		$myData['end_number'] = $myEndNumber;
		$myData['start_end'] = get_region_halland_array_pagination_numbers($myStartNumber, $myEndNumber);
		
		// Returnera array
		return $myData;
	
	}

	function get_region_halland_array_pagination_numbers($myStartNumber, $myEndNumber) {

		// Preparera array
		$myData = array();
		for ($i = $myStartNumber-1; $i < $myEndNumber; $i++) {
			array_push($myData, array(
	           'number' => $i+1
	        ));
		}

		// returnera array
		return $myData;
	}

	// Metod som anropas när pluginen aktiveras
	function region_halland_array_pagination_activate() {
		// Ingenting just nu...
	}

	// Metod som anropas när pluginen avaktiveras
	function region_halland_array_pagination_deactivate() {
		// Ingenting just nu...
	}
	
	// Vilken metod som ska anropas när pluginen aktiveras
	register_activation_hook( __FILE__, 'region_halland_array_pagination_activate');

	// Vilken metod som ska anropas när pluginen avaktiveras
	register_deactivation_hook( __FILE__, 'region_halland_array_pagination_deactivate');

?>