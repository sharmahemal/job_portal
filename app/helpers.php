<?php

// For get ip-address wise all country information 
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}


function curPageURL() {
 $pageURL = 'http';
 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}



//@print_r data
function pr($arr, $end = 0) {
    echo "<pre>";
    print_r($arr);
    echo "</pre><hr>";
    if ($end)
        exit;
}


//For Set Message
function setMsg($name, $msg) {
    return Session::flash($name, $msg);
}

//For Get Message
function getMsg($name) {
    return Session::get($name);
}

//For Get Session data
function getSession($name) {
    return Session::get($name);
}

/*
  @return class or method name of current route
*/
function getClassMethodName($act = "") {
    $action = app('request')->route()->getAction();
    $controller = class_basename($action['controller']);
    list($controller, $action) = explode('@', $controller);
    if (!empty($act)) {
        return $action;
    } else {
        return $controller;
    }
}

//For check admin or user
function get_current_user_from_url(){
    $curr_url = $_SERVER["REQUEST_URI"];
    $exp_curr_url = explode('/',$curr_url);
   // pr($exp_curr_url,1);
    $get_current_user = $exp_curr_url[1];
    return $get_current_user;
}



function total_month_diif($date1,$date2){
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);
    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);
    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);
    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    return $diff; 
}

function total_day_diff($date1,$date2){
    $now = strtotime($date1);
    $your_date = strtotime($date2);
    $datediff = $your_date - $now;
    return floor($datediff/(60*60*24));
}

function current_date(){
    $date = date('Y-m-d', time());
    return $date;
}

function next_thiry_days_date(){
    $date = date('Y-m-d', strtotime("+30 days"));
    return $date;
}

// Check get current language field name   ---- Hemal Sharma   ---- 30-06-2016
function lang($field_name=""){
    $lang = Session()->get("sa_admin_lang");
    $lang = !empty($lang) ? $lang : 'en';
    $str  = file_get_contents("http://".$_SERVER['HTTP_HOST']."/lang/".$lang.".json");
    $json = json_decode($str, true); 
    return $json[''.$field_name.''];
}



function getDatesFromRange($start, $end, $format = 'Y-m-d',$days) {
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $final_date = $date->format($format);
        $date_no = date('N', strtotime($final_date));
        if(in_array($date_no, $days)){
            $array[] = $date->format($format); 
        }    
    }

    return $array;
}

    
// Create id for insert in monbodb --- Hemal Sharna ---11-07-2016.
function MongoId($yourTimestamp) {
    static $inc = 0;

    $ts = pack('N', $yourTimestamp);
    $m = substr(md5(gethostname()), 0, 3);
    $pid = pack('n', getmypid());
    $trail = substr(pack('N', $inc++), 1, 3);

    $bin = sprintf("%s%s%s%s", $ts, $m, $pid, $trail);

    $id = '';
    for ($i = 0; $i < 12; $i++) {
        $id .= sprintf("%02X", ord($bin[$i]));
    }
    return new MongoID($id);
}

function selectTimesOfDay($open_time,$close_time) {
    $array_of_time = array ();
    $start_time    = strtotime ($open_time);
    $end_time      = strtotime ($close_time);

    $fifteen_mins  = 15 * 60;
    $i=0;
    while ($start_time <= $end_time)
    {
       $array_of_time[$i]['TH'] = date ("h:i A", $start_time);
       $array_of_time[$i]['FH'] = date ("H:i", $start_time);
       $start_time += $fifteen_mins;
       $i++;
    }
    return $array_of_time;
}

/*Time Ago For Date*/
function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return ' ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}



//GET RANDOM STRING
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



?>