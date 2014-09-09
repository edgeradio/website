<?php
	
	function utf8_to_utf16($str) 
	{

    $out = '';
	$out .= chr(0xFF) . chr(0xFE);
	
    $len = strlen($str);
    $i = 0;
    while($i < $len) 
	{
		$c = ord($str[$i++]);
		switch($c >> 4)
		{ 
		  case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
			// 0xxxxxxx
			$out .= $str[$i-1];
			break;
		  case 12: case 13:
			// 110x xxxx   10xx xxxx
			$char2 = ord($str[$i++]);
			$out .= chr((($c & 0x1F) << 6) | ($char2 & 0x3F));
			break;
		  case 14:
			// 1110 xxxx  10xx xxxx  10xx xxxx
			$char2 = ord($str[$i++]);
			$char3 = ord($str[$i++]);
			$out .= chr((($c & 0x0F) << 12) | (($char2 & 0x3F) << 6) | (($char3 & 0x3F) << 0));
			break;
		}
		$out .= chr(0); //terrible terrible coding
    }
	
    return $out;
	}


	function utf16_to_utf8($str) {
    

	$c0 = ord($str[0]);
    $c1 = ord($str[1]);

    if ($c0 == 0xFE && $c1 == 0xFF) {
        $be = true;
		
    } else if ($c0 == 0xFF && $c1 == 0xFE) {
        
		$be = false;
    } else {
        return $str;
    }

    $str = substr($str, 2);
    $len = strlen($str);
    $dec = '';
    for ($i = 0; $i < $len; $i += 2) {
        $c = ($be) ? ord($str[$i]) << 8 | ord($str[$i + 1]) : 
                ord($str[$i + 1]) << 8 | ord($str[$i]);
        if ($c >= 0x0001 && $c <= 0x007F) {
            $dec .= chr($c);
        } else if ($c > 0x07FF) {
            $dec .= chr(0xE0 | (($c >> 12) & 0x0F));
            $dec .= chr(0x80 | (($c >>  6) & 0x3F));
            $dec .= chr(0x80 | (($c >>  0) & 0x3F));
        } else {
            $dec .= chr(0xC0 | (($c >>  6) & 0x1F));
            $dec .= chr(0x80 | (($c >>  0) & 0x3F));
        }
    }
    return $dec;
}

?>