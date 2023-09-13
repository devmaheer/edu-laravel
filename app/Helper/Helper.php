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
}
