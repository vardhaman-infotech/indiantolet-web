<?php
function getCurrentTimestamp(){
	$timestamp = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	return $timestamp;
}

function getTodayDate(){
	$date_take 			= date("m-d-Y");
	$dateObj 			= new Date_Time_Calc($date_take, "m-d-Y");
	$currentDateStamp	= $dateObj->date_time_stamp;
	return $currentDateStamp;
}

function getTimeStamp($date){
	$dateArr = explode("-",$date);
	return $timestamp = mktime(0,0,0,$dateArr[0],$dateArr[1],$dateArr[2]);
}
function getTimeStamp2($date){
	$dateArr = explode("/",$date);
	return $timestamp = mktime(0,0,0,$dateArr[0],$dateArr[1],$dateArr[2]);
}
// It will return stamp of date with time 12 noon
function getRequiredTimestamp($datechange){
	//Format MM-DD-YYYY
	$dateObj 	= new Date_Time_Calc($datechange, "m-d-Y");
	$timestamp	= $dateObj->date_time_stamp;
	return $timestamp;
}
// It will return stamp of date with time 12 noon
function getBckSlashTimestamp($datechange){
	//Format MM-DD-YYYY
	$dateObj 	= new Date_Time_Calc($datechange, "m/d/Y");
	$timestamp	= $dateObj->date_time_stamp;
	return $timestamp;
}
//For Searching From field in which date and time both included
function getStampSearchFrom($datechange){
	// Format MM-DD-YYYY
	$datechange.=" 00:00:00";
	$dateObj 	= new Date_Time_Calc($datechange, "m-d-Y H:i:s");
	$timestamp	= $dateObj->date_time_stamp;
	return $timestamp;
}
//For Searching To field in which date and time both included
function getStampSearchTo($datechange){
	// Format MM-DD-YYYY
	$datechange.=" 24:00:00";
	$dateObj 	= new Date_Time_Calc($datechange, "m-d-Y H:i:s");
	$timestamp	= $dateObj->date_time_stamp;
	return $timestamp;
}

function getRequiredTimestamp2($datechange)
{
	// Format MM-DD-YYYY
	$dateChangeArr = explode("/",$datechange);
	$timestamp = mktime(0,0,0,$dateChangeArr[1],$dateChangeArr[0],$dateChangeArr[2]);
//	$dateObj 	= new Date_Time_Calc($datechange, "Y-m-d");
//	$timestamp	= $dateObj->date_time_stamp;
	//print_r($dateObj);
	//echo"--->".$timestamp;
	return $timestamp;
}

function getRequiredDateFormat($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("m-d-Y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat12($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("d-m-Y h:m",$dateTimestamp);
	else
		$requiredFormat = "";

	return $requiredFormat;
}

function getRequiredDateTimeFormat($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("H:i m-d-Y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat_new($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("m-d-Y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat2($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("M'y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat3($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("m/d/Y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
function getRequiredDateFormat11($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("d/m/Y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat4($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("M d,Y H:m",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat5($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("dS",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat6($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("M d, Y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat7($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("D m/y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat8($date)
{
	if($date != "" && $date != 0)
		$requiredFormat = date("D m/y",strtotime($date));
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat9($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("m-d-Y h:i:s A",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredDateFormat10($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("h:i A m-d-Y ",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}





function getRequiredTime($h,$min,$period)
{
	if($h == "" && $min == ""){
		$timestamp = mktime(0,0,0,0,0,0);
	}else{
		if($period == "PM" || $period == "pm"){
			$h =  $h + 12;
		}
		//echo $h." ".$min." ==> ";
		$timestamp = mktime($h,$min,0,0,0,0);
		return $timestamp;
	}
	
}

function getRequiredTimeFormat($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("H-i A",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
function getTimeNonZero($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("G-i",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
/* ADD BY : Vinod Kumar Suthar
   function return only hours from a time stamp*/
function getTimeHour($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("H",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
/* ADD BY : Vinod Kumar Suthar
   function return only Mint from a time stamp*/
function getTimeMint($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("i",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
/* ADD BY : Vinod Kumar Suthar
   function return only non leading ZERO hours from a time stamp*/
function getNonZeroTimeHour($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("G",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

function getRequiredTimeStmp($h,$min){
	if($h == "" && $min == ""){
		$timestamp = mktime(0,0,0,0,0,0);
	}else{
		$timestamp = @mktime($h,$min,0,0,0,0);
		return $timestamp;
	}	
}

//function to f=get next day datetamp
function getNextdayDate()
{
	$timestamp = mktime(0 , 0 , 0 , date("m"), date("d")+1, date("Y"));
	return $timestamp;
}
//function to get time in 12 hour format
function getNonMilitaryTimeFormat($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("h:i",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
//function to get time in 24 hour format
function getMilitaryTimeFormat($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("H:i",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
function getNonZeroDateFormat($dateTimestamp)
{
	if($dateTimestamp != "" && $dateTimestamp != 0)
		$requiredFormat = date("n-j-Y",$dateTimestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
//function to get time in 12 hour format with am pm
function getAmPmTimeFormat($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("h:i A",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}
function getAmPmTimeFormat1($Timestamp)
{
	if($Timestamp != "" && $Timestamp != 0)
		$requiredFormat = date("H:i A",$Timestamp);
	else	
		$requiredFormat = "";
	
	return $requiredFormat;	
}

//function to get hours option
function hourOption($hr)
{
	$optionResult = "";
	for($i=1;$i<=12;$i++){
		$selected = ($i==$hr)?"selected":"";
		$optionResult .="<option value='".$i."' $selected>".$i."</option>";
	}	
	return $optionResult;
}
//function to get hours option
function minutOption($min)
{
	$optionResult = "";
	for($i=0;$i<=45;$i= $i+15){
		$selected = ($i==$min)?"selected":"";
		$optionResult .="<option value='".$i."' $selected>".$i."</option>";
	}	
	return $optionResult;
}
//function to get AM/PM option
function ampmOption($option)
{
	$optionResult = "";
	$selected = ($option=='AM')?"selected":"";
	$optionResult .="<option value='AM' $selected >AM</option>";
	$selected = ($option=='PM')?"selected":"";
	$optionResult .="<option value='PM' $selected >PM</option>";
	
	return $optionResult;
}
//function to get Months option
function monthsOption($mon)
{
	$month = array(0=>"select",1=>"Jan",2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
	$optionResult = "";
	for($i=1;$i<=12;$i++){
		$selected = ($i==$mon)?"selected":"";
		$optionResult .="<option value='".$i."' $selected>".$month[$i]."</option>";
	}	
	return $optionResult;
}

//function to get Months option
function yearOption($year)
{
	$year = array(1=>"2010",2=>'2011',3=>'2012',4=>'2013',5=>'2014',6=>'2015');
	$optionResult = "";
	for($i=2010;$i<=2015;$i++){
		$selected = ($i==$year)?"selected":"";
		$optionResult .="<option value='".$i."' $selected>".$i."</option>";
	}	
	return $optionResult;
}
function countHours($sTime, $eTime)
{	$tmStamp =mktime(12, 0, 0, 0, 0, 0);
	if($sTime!="")
			$amTime = $tmStamp - $sTime;
	if($eTime!="")
			$totalTime = $amTime + $eTime;
	return date("h", $totalTime);
}
//function to get age on date stamp and mask
function getAge( $dateStamp ) {
	$p_strDate	= getRequiredDateFormat($dateStamp);
    list($m,$d,$Y)    = explode("-",$p_strDate);
    $years            = date("Y") - $Y;
    if( date("md") < $m.$d ) { $years--; }
    return $years;
}
function getAge2( $dateStamp ) {
	$p_strDate	= getRequiredDateFormat($dateStamp);
    list($m,$d,$Y)    = explode("-",$p_strDate);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	
}
// function to get day name on date
function getDayName($dateStamp){
	if($dateStamp!=''){
		$requiredFormat = date("l",$dateStamp);
		return $requiredFormat;
	}else{
		return NULL;
	}
}

/**
* Get difference between timestamps broken down into years/months/weeks/etc.
* @return array
* @param int $t1 UNIX timestamp
* @param int $t2 UNIX timestamp
*/
function timeDiff($t1, $t2)
{
   if($t1 > $t2)
   {
      $time1 = $t2;
      $time2 = $t1;
   }
   else
   {
      $time1 = $t1;
      $time2 = $t2;
   }
   $diff = array(
      'years' => 0,
      'months' => 0,
      'weeks' => 0,
      'days' => 0,
      'hours' => 0,
      'minutes' => 0,
      'seconds' =>0
   );
   foreach(array('years','months','weeks','days','hours','minutes','seconds')
         as $unit)
   {
      while(TRUE)
      {
         $next = strtotime("+1 $unit", $time1);
         if($next < $time2)
         {
            $time1 = $next;
            $diff[$unit]++;
         }
         else
         {
            break;
         }
      }
   }
   return($diff);
}
?>