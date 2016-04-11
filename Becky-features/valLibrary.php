<?php
//This validation library was created collaboratively among Team Polar Bear
class valLibrary
{

    const ZIPCODE = "/^[ABCEGHJKLMNPRSTVXY][0-9][ABCEGHJKLMNPRSTVWXYZ][0-9][ABCEGHJKLMNPRSTVWXYZ][0-9]$/";
    const PHONEMATCH = "/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/";

    /*function __construct()
    {
        foreach($_POST as $key => $value){
            if("phone" == substr($key,-5)){
                checkPhone($value);
            }
        }
    }*/

    public function checkPostalCode($posCode)
    {
        //strtoupper() use to convert all letters in zipcode to uppercase
        if(preg_match(self::ZIPCODE, strtoupper($posCode))){
            return true;
        }
        return false;
    }

    public function checkPhone($phoneIn){
        if(preg_match(self::PHONEMATCH,$phoneIn)){
            return true;
        }
        return false;
    }

    public function checkLanguage($textIn){
        $unAcceptable = array("BadWord","Badword2");
        //Please excuse the language used here, implemented to make a point regarding finding
        //undesirable substrings in a larger text string
        $textUpper = strtoupper($textIn);
        for($i=0;$i<count($unAcceptable);$i++){
            if(strpos($textUpper,$unAcceptable[$i]) != 0){
                return false;
            }
        }
        return true;
    }

    // tests that a drop-down list is not left on a default with value = ""
    public function checkSelectList($value){
        if ($value === ""){
            return false;
        }
        return true;
    }

    public function checkRadioList($value)
    {
        if ($value === null) {
            return false;
        }
        return true;
    }

    public function checkCheckboxList($values,$max = 0,$min = 0){
        $numChecked = count($values);
        if ($max === 0){
            if ($min <= $numChecked){
                return true;
            }
        }else{
            if ($min <= $numChecked && $numChecked <= $max){
                return true;
            }
        }
        return false;
    }

    public function checkLength($text, $length = 35)
    {
        if(empty($text))
        {
            return false;
        }else{
            if(strlen($text) > $length)
            {
                echo "Characters must be less than $length.";
                return false;
            }else{
                echo "Thank you $text!";
                return true;
            }
        }
    }

    private $email;
    public function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else{
            return false;
        }
    }

    public function checkLogin($email, $password){
    }



}