<?php

namespace App\Helper;

class Helper {
    /**
     * Helper function to generate unique id
     * 
     */
    public static function getUniqueID()
    {
        return md5(date('Y-m-d') . microtime() . rand());
    }

    /**
     * Helper function to generate unique case id
     * 
     */
    public static function getUniqueFormatedId($prefix = null)
    {
        return $prefix.strtoupper(substr(uniqid(), 7, 5));
    }

    /**
     * Helper function to generate random phone number
     * 
     */
    public static function generateRandomPhoneNumber()
    {
        $min = 10000000000; // The minimum 11-digit number (inclusive)
        $max = 99999999999; // The maximum 11-digit number (inclusive)

        return rand($min, $max);
    }
    public static function getTestType($type){
        if($type == '1'){
        return 'Mock';
        }else if($type == '2'){
            return 'Paid';
        }

        return 'Unknown';
    }

    public static function questionGroup($value = null,$type=1){
        if($type == 1){
            $data = [
                1=>'Three Options (A,B,C)',
                2=>'Four Options (A,B,C,D)',
                3=>'Five Options (A,B,C,D,E)',
                4=>'Three Options (True,False,Not given)',
                5=>'Three Options (Yes No Not given)',];
        }else{
        $data = [
         6=>'Fillin Blank at the end of the sentence',
         7=>'2 or maybe 3 blanks in between the sentence',
         8=>'Picture and 1,2...questions with 1 or 2 blanks',
         9=>'Picture and and 1,2.... questions with only one blank',
        ];
    }
      if($value){
        // Check if the provided $value exists in the $data array
        if (array_key_exists($value, $data)) {
            return $data[$value]; // Return the corresponding option
        } else {
            return "Invalid value"; // Handle the case when $value is not found
        }
     }else{

        return $data;
     }
    }
     
}
