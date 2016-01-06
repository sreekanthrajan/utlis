<?php
$handle = fopen ( "ORB-en_US.xml", "r" );
$handle2 = fopen ( "subset.xml", "w" );
$hotels = file ( 'hotelList', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
fwrite ( $handle2, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL );
fwrite ( $handle2, '<hotels>' . PHP_EOL );
$newHotel = true;
$newHotelData = '';

if ($handle) {
	while ( ($line = fgets ( $handle )) !== false ) {
		$idXML = '';
		$hasId='';
		if (trim ( $line ) == '<hotel>') {
			$newHotelData = '';
			$newHotel = true;
			$skipHotel = true;
		}
		$hasId = strstr ( $line, '<id>' );
		if ($hasId) {
			$idXML = new SimpleXMLElement ( $line );
		}
		if (in_array ( $idXML, $hotels ) && $hasId) {
			$skipHotel = false;
		}
		$newHotelData = $newHotelData . $line;
		if (trim ( $line ) == '</hotel>') {
			$newHotel = false;
			$line = $newHotelData . $line;
		}
		
		
		if ($newHotel == false && $skipHotel == false) {
			fwrite ( $handle2, $line );
			$skipHotel = true;
		}
	}
	fclose ( $handle2 );
}
echo "I am done";
exit ();
?>
