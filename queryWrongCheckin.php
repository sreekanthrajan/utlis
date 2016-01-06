<?php
$handle = fopen ( "ORB-en_US.xml", "r" );
$handle2 = fopen ( "reportime2.txt", "w" );
$newHotelData='';
if ($handle) {
	while ( ($line = fgets ( $handle )) !== false ) {
		if (strstr($line, '<id>')) {
			$newHotelData = $line;			
		}		
		   $hasCheckin = strstr ( $line, '<checkInTime>' );
			if ($hasCheckin) {
				$times = explode ( ":", $line );
				if (count ( $times ) == 3) {
					echo $newHotelData;
					fwrite($handle2,$newHotelData);
				}
			}
			$checkOutTime = strstr ( $line, '<checkOutTime>' );
			if ($checkOutTime) {
				$times = explode ( ":", $line );
				if (count ( $times ) == 3) {
					fwrite($handle2,$newHotelData);
				}
			}
	}
}
	fclose ( $handle2 );

echo "I am done";
exit ();
?>
