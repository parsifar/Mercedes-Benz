<?php

// a function to parse search term into different parts and return an associative array
function search_parser($search_term){
    //first sanitize the input
    $sanitized_string = filter_var($search_term , FILTER_SANITIZE_STRING);
    $lower_cased = strtolower($sanitized_string);
    $parts = explode(' ', $lower_cased);

    //lists of different features
    $years_list = array(2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020);
    $colors_list = array('black', 'white', 'red' , 'silver' , 'blue', 'grey' , 'green' , 'violet' , 'orange' , 'yellow' , 'gold' ,'brown');
    $models_list = array('c300','glc 300', 'c450');

    //initialize the parsed array
    $parsed = array();
    //search for each part in lists
    foreach($parts as $part){
        if(in_array($part , $years_list)){
            $parsed['year'] =$part;
        }
        if(in_array($part , $colors_list)){
            $parsed['exterior'] =$part;
        }
        if(in_array($part , $models_list)){
            $parsed['model'] =  $part;
        }
    }
    return $parsed;

}


