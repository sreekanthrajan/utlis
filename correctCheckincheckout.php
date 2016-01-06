<?php
$handle = fopen ( "ORB-en_US.xml.bkp", "r" );
$handle2 = fopen ( "HAA-en_GB.xml", "w" );
$handle3 = fopen ( "ORB-en_US.xml", "w" );
$handle4 = fopen ( "HotelExtract.xml", "w" );
fwrite ( $handle2, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL );
fwrite ( $handle3, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL );
fwrite ( $handle4, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL );
fwrite ( $handle2, '<hotels>' . PHP_EOL );
fwrite ( $handle3, '<hotels>' . PHP_EOL );
fwrite ( $handle4, '<hotels>' . PHP_EOL );
$newHotel = true;
$newHotelData = '';
if ($handle) {
	while ( ($line = fgets ( $handle )) !== false ) {
		if (trim ( $line ) == '<hotel>') {
			$newHotelData = $line;
			$newHotel = true;
			$skipHotel = false;
		}
		if (trim ( $line ) == '<merchant>false</merchant>') {
			$skipHotel = true;
		}
		if ($newHotel == true and trim ( $line ) !== "<hotel>") {
			$hasCheckin = strstr ( $line, '<checkInTime>' );
			if ($hasCheckin) {
				$times = explode ( ":", $line );
				if (count ( $times ) == 3) {
					$line = $times [0] . $times [1] . "</checkInTime>" . "\n";
				}
			}
			$checkOutTime = strstr ( $line, '<checkOutTime>' );
			if ($checkOutTime) {
				$times = explode ( ":", $line );
				if (count ( $times ) == 3) {
					$line = $times [0] . $times [1] . "</checkOutTime>" . "\n";
				}
			}
			$newHotelData = $newHotelData . $line;
		}
		if (trim ( $line ) == '</hotel>') {
			$newHotel = false;
			$line = $newHotelData;
		}
		if ($newHotel == false) {
			fwrite ( $handle3, $line );
			fwrite ( $handle4, $line );
			if ($skipHotel == false) {
				fwrite ( $handle2, $line );
			}
		}
	}
	
	fclose ( $handle2 );
	fclose ( $handle3 );
	fclose ( $handle4 );
}
echo "I am done";
exit ();
?>
