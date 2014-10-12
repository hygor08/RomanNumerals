<?php

/**
 * RomanNumeralConverter allows the conversion of numbers to roman numerals and 
 * from roman numerals to numbers
 *
 * @author Adam Bush
 */
class RomanNumeralConverter implements RomanNumeralGenerator {
    
    private static  $romLimits;    
    private static  $roms;
    
    function __construct() {
        self::$romLimits = array(
            0 => array('low' => array('rom' => 'I', 'val' => 1), 'mid' => array('rom' => 'V', 'val' => 5), 'high' => array('rom' => 'X', 'val' => 10)),
            1 => array('low' => array('rom' => 'X', 'val' => 10), 'mid' => array('rom' => 'L', 'val' => 50), 'high' => array('rom' => 'C', 'val' => 100)),
            2 => array('low' => array('rom' => 'C', 'val' => 100), 'mid' => array('rom' => 'D', 'val' => 500), 'high' => array('rom' => 'M', 'val' => 1000)),
            3 => array('low' => array('rom' => 'M', 'val' => 1000), 'mid' => array('rom' => '', 'val' => ''), 'high' => array('rom' => '', 'val' => '')),
        );
        
        self::$roms = array('I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000);
    }
    
    /**
     * generate - This function is used to take a numeric input and convert it
     * to a series of corresponding roman numerals 
     
     * @param int $integer The integer to be translated 
     * @return string (generated roman numerals)
     */
    public function generate($integer){
        //split each char from the integer into an array entry
	$arr = str_split($integer);
        //reverse the array - this makes working with roman numeral conversion easier
	$arrr = array_reverse($arr, false);
	$output = '';
	foreach($arrr as $key => $value){
            $myVal = '';
            $tmpval = $value;
            //we can re-use the process for 1 - 3 for 6 - 8 if we subtract in a temp value
            if($value > 5 && $value < 9){
                $tmpval = $value - 5;
            }
            if($tmpval > 0 && $tmpval < 4){
                for($i=0;$i< $tmpval;$i++){
                    $myVal .= self::$romLimits[$key]['low']['rom'];
                }
            }
            if($value == 4){
                $myVal .= self::$romLimits[$key]['low']['rom'].self::$romLimits[$key]['mid']['rom'];
            } elseif ($value > 4 && $value < 9){
                $myVal = self::$romLimits[$key]['mid']['rom'] . $myVal;
            } elseif($value == 9){
                $myVal = self::$romLimits[$key]['low']['rom'].self::$romLimits[$key]['high']['rom'];
            }
            $output = $myVal.$output;	
	}
        return $output;
    }
    
    /**
     * parse - This function is used to take a string of roman numerals and convert
     * to the corresponding arabic numbers 
     
     * @param string $string The string to be translated 
     * @return int (generated number)
     */
    public function parse($string){
        //split each char from the roman numeral string into an array entry
        $arr = str_split($string);
        //reverse the array - this makes working with roman numeral conversion easier
	$arrr = array_reverse($arr, false);
	$runningTotal = 0;
	$lastNumeral = '';
	foreach($arrr as $value){
            /*working through in reverse means that in the case of 4 or 9 (or others)
              that you can get the next level character (a 'V' for example) this is then
              followed by a lower character again (an 'I'). In this case the lower character
              needs to be subtracted not added.
             */
            if(array_key_exists($value, self::$roms)){ 			
                if($value == 'I' && ($lastNumeral == 'V' || $lastNumeral == 'X')){
                    $runningTotal = $runningTotal - self::$roms['I'];
                } elseif($value == 'X' && ($lastNumeral == 'L' || $lastNumeral == 'C')){
                    $runningTotal = $runningTotal - self::$roms['X'];
                } elseif($value == 'C' && ($lastNumeral == 'D' || $lastNumeral == 'M')){
                    $runningTotal = $runningTotal - self::$roms['C'];
                } else {
                    $runningTotal = $runningTotal + self::$roms[$value];
                }			
                $lastNumeral = $value;
            }
	} 
        return $runningTotal;
    }
}
