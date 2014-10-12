<?php

/**
 * RomanNumeralGenerator Interface sets required functions
 * 
 * @author Adam Bush
 */
interface RomanNumeralGenerator {
    public function generate($integer); // convert from int -> roman
    public function parse($string); // convert from roman -> int
}

