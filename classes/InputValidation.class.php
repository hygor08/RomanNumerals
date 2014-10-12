<?php

/**
 * InputValidation - This class acts as a stepping stone between the web interface
 * and the Roman Numeral Generator/Converter - It checks that the input qualifies
 * and also finds the type of input it is.
 *
 * @author Adam Bush
 */
class InputValidation {
    
    public $inputType = '';
    public $result = '';
    
    /**
     * decipherStringType - This function is used to validate the input - first 
     * working ot if it is an number or a roman numeral being provided.
     * It also checks both the maximum allowed value for both numbers and roman numerals
     *
     * @param string $inputString The input (from a form or wherever is using the translation) 
     * @return doesnt return anything but sets object properties.
     */
    public function decipherStringType($inputString){
        $romanNumerals = new RomanNumeralConverter();
        //$inputString = trim($inputString);
        if(is_numeric($inputString)){
             $this->inputType = 'integer';
            if($inputString < 4000 && $inputString > 0){
                 $this->result = $romanNumerals->generate($inputString);
            } else {
                 $this->result = "Number must be between 1 and 3999";
            }
        } else {
            $this->inputType = 'roman';
            if(preg_match("/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/",$inputString)){
                 $this->result = $romanNumerals->parse($inputString);
            } else {
                 $this->result = "The items provided are not Roman Numerals or exceed the equivalent of 3999";
            }
        }
    }
    
}
