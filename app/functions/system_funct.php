<?php

 // when inserting string into database
function F_SAFE_INSERT2( $string ){
	#$string = str_replace( "\r", "<br>", $string ) ;
	#$string = str_replace( "\n", "<br>", $string ) ;
	if ( function_exists('mysql_real_escape_string') ){
		return mysql_real_escape_string( trim($string) ) ;
	}elseif ( function_exists('mysql_escape_string') ){
		return mysql_escape_string( trim($string) ) ;
	}
	return addslashes( $string );
}

// returns decoded string as arrays of variables
//   or false on error (when session_decode returns false)
function DecodeSession($sess_string){
   // save current session data
   //   and flush $_SESSION array
   $old = $_SESSION;
   $_SESSION = array();
   // try to decode passed string
   $ret = session_decode($sess_string);
   if (!$ret) {
	   // if passed string is not session data,
	   //   retrieve saved (old) session data
	   //   and return false
	   $_SESSION = array();
	   $_SESSION = $old;
	   return false;
   }
   // save decoded session data to sess_array
   //   and flush $_SESSION array
   $sess_array = $_SESSION;
   $_SESSION = array();
   // restore old session data
   $_SESSION = $old;
   // return decoded session data
   return $sess_array;
}	
		
function unlinkRecursive($dir, $deleteRootToo)
{
    if(!$dh = @opendir($dir))
    {
        return;
    }
    while (false !== ($obj = readdir($dh)))
    {
        if($obj == '.' || $obj == '..')
        {
            continue;
        }

        if (!@unlink($dir . '/' . $obj))
        {
            unlinkRecursive($dir.'/'.$obj, true);
        }
    }

    closedir($dh);
   
    if ($deleteRootToo)
    {
        @rmdir($dir);
    }
   
    return;
} 	
?>
