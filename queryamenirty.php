<?php
$amenityList = array ('AP','BB','BP','BRKFST','CB','CNTBRK','CP','DINNER',
		'EP','FAP','MAP','MP','BRKBUF','ORBBRK','HALF_BOARD','FULL_BOARD',
		'BREAKFAST_BOARD','BREAK_FAST','CONTINENTAL_BREAKFAST',
		'BUFFET_BREAK','HAC138','HAC141','HAC142','HAC156');
print_r($amenityList);
$handle = fopen ( "HAA-en_GB.xml", "r" );
$handle2 = fopen ( "reportime2.txt", "w" );
$newHotelData='';
if ($handle) {
	while ( ($line = fgets ( $handle )) !== false ) {
		if (strstr($line, '<id>')) {
			$newHotelData = $line;			
		}		
		   $hasCode = strstr ( $line, '<code>' );
			if ($hasCode) {
				$amenity = strip_tags ($hasCode);
				//echo $amenity;
				if(in_array(trim($amenity),$amenityList,false)) {
					fwrite($handle2,strip_tags($newHotelData));
				
				} 
			}
	}
}

	fclose ( $handle2 );

echo "I am done";
exit ();
?>