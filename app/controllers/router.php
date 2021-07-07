<?php
 
include('conf/config.inc.php');
//fetch the passed request
$request = $_SERVER['REQUEST_URI'];
// split url by forward slash
$request = split2($request, '/', 1);

//parse the page request and other GET variables
$parsed = explode('/', $request[1]);

////the page is the first element it is controller name
$page = array_shift($parsed);

// seconde is method name;
$functionName = array_shift($parsed);

if (strpos($functionName, '?') !== FALSE) {

    $functionName = explode('?', $functionName);
    $functionName = $functionName[0];
}

//the rest of the array are get statements, parse them out.
$getVars = array();
$k = 0;
foreach ($parsed as $argument) {
    //split GET vars along '=' symbol to separate variable, values
    $getVars[$argument] = urldecode($argument);
}
//compute the path to the file
$target = SERVER_ROOT . '/controllers/' . $page . 'Controller.php';

//get target
// if controller exist call it else call error controller
if (file_exists($target)) {
    include_once($target);

    //modify page to fit naming convention
    $class = ucfirst($page) . 'Controller';

    //instantiate the appropriate class
    if (class_exists($class)) {
        $controller = new $class;
    } else {
        //did we name our class correctly?
        die('class does not exist!');
    }
} else {
    '<br />' . $target;
    $target = SERVER_ROOT . '/controllers/APController.php';
    include_once($target);

    //modify page to fit naming convention
    $class = 'APController';

    //instantiate the appropriate class
    if (class_exists($class)) {
        $controller = new $class;
    } else {
        //did we name our class correctly?
        die('class does not exist!');
    }
    //can't find the file in 'controllers'!
    //die('page does not exist!');
}
//once we have the controller instantiated, execute the default function
//pass any GET varaibles to the main method
// get information about class
$ReflectionFoo = new ReflectionClass($class);
 
// if method name is empty call index method
if ($functionName == '') {
    $functionName = 'indexAction';
} elseif ($functionName == 'id') {
    $functionName = 'indexAction';
    foreach ($parsed as $argument) {
        //split GET vars along '=' symbol to separate variable, values
        $getVars[$argument] = urldecode($argument);
    }
}elseif ($class == 'ProductController') {
    
    if(empty($parsed)) {
        $functionName = 'indexAction';
        foreach ($parsed as $argument) {
            //split GET vars along '=' symbol to separate variable, values
            $getVars[$argument] = urldecode($argument);
        }
    }else{
        
        $functionName .= 'Action';
    }
    
    }elseif ($class == 'BlogController') {
    $functionName = 'indexAction';
    foreach ($parsed as $argument) {
        //split GET vars along '=' symbol to separate variable, values
        $getVars[$argument] = urldecode($argument);
    }
    
    } else {
    $functionName .= 'Action';
}
// if method name is not found in class call index method
if (!method_exists($class, $functionName)) {
    $functionName = 'errorpage';
}
// count number of argument of a function
$argumentsCount = $ReflectionFoo->getMethod($functionName)->getNumberOfParameters();
// create argument array to pass argument in function
if (($key = array_search('id', $getVars)) !== false) {
    unset($getVars[$key]);
}
$arguments = array_slice($getVars, 0, $argumentsCount);

call_user_func_array(array($controller, $functionName), $arguments);

function split2($string, $needle, $nth) {
    $max = strlen($string);
    $n = 0;
    for ($i = 0; $i < $max; $i++) {
        if ($string[$i] == $needle) {
            $n++;
            if ($n >= $nth) {
                break;
            }
        }
    }
    $arr[] = substr($string, 0, $i);
    $arr[] = substr($string, $i + 1, $max);

    return $arr;
}

function splitAtUpperCase($s) {
    return preg_split('/(?=[A-Z])/', $s, -1, PREG_SPLIT_NO_EMPTY);
}
