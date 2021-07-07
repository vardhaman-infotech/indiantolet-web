<?php

/**
* htmlHelper class 
*
* htmlHelper is designed to help keep your code clean, stop mistakes and provide you
* with a solid base to develop further functionality
*
* @author D. Hawkins <dan@pointnet.co.uk>
* @version 1.1
* @package HTMLHelper
*/

class htmlElement{
	/**
	* @var string
	*/
	public $tag;
	
	public $type;
	/**
	* Array of additon attributes for inside the opening tag
	* @var array
	*/
	public $attr = array();
	/**
	* The stack of elements contained within this element
	* @var array
	*/
	public $stack = array();
	/**
	* Opens the html tag and adds all the attributes
	* @return string the html for the opening tag
	*/
	public function openTag(){
		$tag = "<{$this->tag}";
		$id = null;
		$attrHTML = "";
		foreach($this->attr as $k => $v){
			if($v){
				if($k == "id") $id = $v;
				if($k == "type" && !$this->type){
					$this->type = $v;
				}else{ 
					$attrHTML .= " {$k}=\"{$v}\"";
				}
			}
		}
		if($this->type) $tag .= " type=\"{$this->type}\"";
		if(!$id && isset($this->attr['name'])) $tag .= " id=\"{$this->attr['name']}\"";
		$tag .= $attrHTML;
		if(isset($this->value) && is_a($this->value,"data")){
			$tag .= ">";
		}else{
			switch($this->tag){
				case "input": $tag .= "/>"; break;
				case "submit": $tag .= "/>"; break;
				default:
					$tag .= ">";
			}
		}
		return $tag;
	}
	/**
	* Closes the html if required
	* @return string the html for the closing tag
	*/	
	public function closeTag(){
		if(isset($this->value) && is_a($this->value,"data")){
			return "</{$this->tage}>";
		}
		switch($this->tag){
			case "input":
				return "";
			case "submit":
				return "";
			default:
				return "</{$this->tag}>";
		}
	}
	/**
	* Renders the html for $this and all children contained in $this->stack
	* @return string the html for the object and it's children
	*/
	public function html(){
		if($this->tag) $retHTML = $this->openTag();
		if(count($this->stack)){
			for($i = 0;$i < count($this->stack);$i++){
				//if(method_exists($this->stack[$i], "html")) $retHTML .= $this->stack[$i]->html();
				$retHTML .= $this->stack[$i]->html();
			}
		}else{
			//$retHTML .= $this->html();
		}
		if($this->tag) $retHTML .= $this->closeTag();
		return $retHTML;
	}
	/**
	* Adds a child element onto the stack
	* @param mixed
	*/
	public function add($obj){
		$this->stack[] = $obj;
		return $obj;
	}
	public function __set($key,$value){
		$this->attr[$key] = $value;
	}
	
	public function __get($key){
		if(isset($this->attr[$key])){
			return $this->attr[$key];
		}
		return null;
	}
	
	/**
	* add a generic tag
	* @param string
	* @param string
	* @param string
	* @param array additional attributes to be used in the tag
	* @return mixed the object added to the stack
	*/
	public function genericTag($tag,$name = null,$class = null,$attr = array()){
		return $this->add(new genericTag($tag,$name,$class,$attr));
	}
	
	public function containerTag($tag,$value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new containerTag($tag,$value,$name,$class,$attr));
	}
	
	public function inputTag($tag = "text",$name = null,$value = "",$class = null,$attr = array()){
		return $this->add(new inputTag($tag,$name,$value,$class,$attr));
	}
	
	public function body($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new body($value,$name,$class,$attr));
	}
	
	public function form($name = null,$action = null,$method = "post",$attr = array()){
		return $this->add(new form($name,$action,$method,$attr));
	}
	
	public function input($name = null,$value = "",$class = null,$attr = array()){
		return $this->add(new input($name,$value,$class,$attr));
	}
	
	public function radio($name = null,$value = "",$selected = false,$class = null,$attr = array()){
		return $this->add(new radio($name,$value,$selected,$class,$attr));
	}
	
	public function inputImage($name = null,$value = null,$src = null,$alt = null,$class = null,$attr = array()){
		return $this->add(new inputImage($name,$value,$src,$alt,$class,$attr));
	}	
	public function hidden($name = null,$value = "",$class = null,$attr = array()){
		return $this->add(new hidden($name,$value,$class,$attr));
	}
	
	public function select($name = null,$class = null,$attr = array()){
		return $this->add(new select($name,$class,$attr));
	}
	
	public function button($name = null,$value = "",$class = null,$attr = array()){
		return $this->add(new button($name,$value,$class,$attr));
	}
	
	public function submit($name = null,$value = "",$class = null,$attr = array()){
		return $this->add(new submit($name,$value,$class,$attr));
	}
	
	public function checkbox($name = null,$value = "",$checked = false,$attr = array()){
		return $this->add(new checkbox($name,$value,$checked,$attr));
	}
	
	public function option($value= "",$key = null,$selected = false,$attr = array()){
		return $this->add(new option($value,$key,$selected,$attr));
	}
	
	public function table($name = null,$class = null,$attr = array()){
		return $this->add(new table($name,$class,$attr));
	}
	
	public function tr($name = null,$class = null,$attr = array()){
		return $this->add(new tr($name,$class,$attr));
	}
	
	public function td($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new td($value,$name,$class,$attr));
	}
	
	public function th($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new th($value,$name,$class,$attr));
	}
	
	public function div($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new div($value,$name,$class,$attr));
	}
	
	public function p($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new p($value,$name,$class,$attr));
	}
	
	public function span($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new span($value,$name,$class,$attr));
	}
	public function ul($name = null,$class = null,$attr = array()){
		return $this->add(new ul($name,$class,$attr));
	}
	public function li($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new li($value,$name,$class,$attr));
	}
	
	public function h1($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new h1($value,$name,$class,$attr));
	}
		
	public function h2($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new h2($value,$name,$class,$attr));
	}
		
	public function h3($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new h3($value,$name,$class,$attr));
	}
		
	public function h4($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new h4($value,$name,$class,$attr));
	}
		
	public function h5($value = "",$name = null,$class = null,$attr = array()){
		return $this->add(new h5($value,$name,$class,$attr));
	}
		
	public function label($value = null,$for = null,$class = null,$attr = array()){
		return $this->add(new label($value,$for,$class,$attr));
	}
		
	public function a($href = null,$value = "link",$title = null,$name= null,$class = null,$attr = array()){
		return $this->add(new a($href,$value,$title,$name,$class,$attr));
	}
		
	public function img($src = null,$alt = null,$name = null,$class = null,$attr = array()){
		return $this->add(new img($src,$alt,$name,$class,$attr));
	}

	public function clearfix(){return $this->add(new div(null,null,array("class" => "clearfix")));}
	
	public function setAttribute($key,$value){
		$this->attr[$key] = $value;
	}
}

class data{
	public $data;
	
	public function __construct($data){
		$this->data = $data;
	}
	
	public function html(){
		return $this->data;
	}
}

class genericTag extends htmlElement{
	public function __construct($name = null,$class = null,$attr = array()){
		$this->attr = $attr;
		$this->name = $name;
		$this->class = $class;
	}
}

class containerTag extends htmlElement{
	public function __construct($value = "",$name = null,$class = null,$attr = array()){
		$this->attr = $attr;
		$this->name = $name;
		$this->class = $class;
		if(is_object($value)){
			$this->add($value);
		}else{
			$this->add(new data($value));
		}	
	}
}

class ul extends genericTag{
	public $tag = "ul";
}

class li extends containerTag{
	public $tag = "li";
}

class body extends containerTag{
	public $tag = "body";
}

class inputTag extends htmlElement{
	public function __construct($name = null,$value = "",$class = null,$attr = array()){
		$this->attr = $attr;
		$this->name = $name;
		$this->class = $class;
		$this->tag = "input";
		$this->value = $value;
	}
}

class form extends htmlElement{
	public function __construct($name = null,$action = null,$method = "post",$attr = array()){
		$this->tag = "form";
		$this->attr = $attr;
		$this->name = $name;
		$this->action = $action;
		$this->method = $method;
	}
}

class input extends inputTag{
	public $type = "text";
}


class radio extends inputTag{
	public $type = "radio";
	
	public function __construct($name = null,$value = "",$selected = false,$class = null,$attr = array()){
		$this->attr = $attr;
		$this->name = $name;
		$this->class = $class;
		$this->tag = "input";
		$this->value = $value;
		$this->selected = $selected ? " selected=\"selected\" " : "";
	}
}

class inputImage extends inputTag{
//inputImage($name,$value,$src,$alt,$class,$attr)
	public function __construct($name = null,$value = null,$src = null,$alt = null,$class = null,$attr = array()){
		$this->tag = "input";
		$this->attr = $attr;
		$this->name = $name;
		$this->src = $src;
		$this->alt = $alt;
		$this->type = "image";
		$this->value = $value;
	}
}

class hidden extends inputTag{
	public $type = "hidden";
}

class button extends inputTag{
	public $type = "button";
}

class submit extends inputTag{
	public $type = "submit";
}

class checkbox extends htmlElement{
	//$name,$value = "",$checked = false,$attr = array()
	public function __construct($name = null,$value = "",$checked = false,$attr = array()){
		$this->tag = "input";
		$this->attr = $attr;
		$this->name = $name;
		$this->type = "checkbox";
		$this->value = $value;
		$this->checked = $checked ? " checked=\"checked\" " : "";
	}
}

class select extends genericTag{
	public $tag = "select";
	
	public function optionsFromArray($array,$select = null){
		 if(count($array) > 0 && $array){
		  foreach($array as $k => $v){
			   $selected = ($select == $k);
			   $this->add(new option($v,$k,$selected));
		  }	
		
		} else
			 return false;
	}
}

class option extends htmlElement{
	public function __construct($value= "",$key = null,$selected = false,$attr = array()){
		$this->tag = "option";
		$this->attr = $attr;
		if(!$key) $key = $value;
		$this->value = $key;
		$this->selected = $selected ? " selected=\"selected\" " : "";
		$this->add(new data($value));
	}
}

class table extends genericTag{
	public $tag = "table";
}

class tr extends genericTag{
	public $tag = "tr";
}

class td extends containerTag{
	public $tag = "td";
}

class th extends containerTag{
	public $tag = "th";
}

class div extends containerTag{
	public $tag = "div";
}

class p extends containerTag{
	public $tag = "p";
}

class span extends containerTag{
	public $tag = "span";
}

class h1 extends containerTag{
	public $tag = "h1";
}
class h2 extends containerTag{
	public $tag = "h2";
}

class h3 extends containerTag{
	public $tag = "h3";
}
class h4 extends containerTag{
	public $tag = "h4";
}
class h5 extends containerTag{
	public $tag = "h5";
}

class label extends containerTag{
	public function __construct($value = null,$for = null,$class = null,$attr = array()){
		$this->tag = "label";
		$this->attr = $attr;
		$this->for = $for;
		$this->class = $class;
		if(is_object($value)){
			$this->add($value);
		}else{
			$this->add(new data($value));
		}
	}
	
}

class a extends htmlElement{
	public function __construct($href = null,$value = "link",$title = null,$name= null,$class = null,$attr = array()){
		$this->tag = "a";
		$this->attr = $attr;
		$this->href = $href;
		$this->name = $name;
		$this->title = $title;
		$this->class = $class;

		if(is_object($value)){
			$this->add($value);
		}else{
			$this->add(new data($value));
		}
	}
}

class img extends htmlElement{
	public function __construct($src = null,$alt = null,$name = null,$class = null,$attr = array()){
		$this->tag = "img";
		$this->attr = $attr;
		$this->src = $src;
		$this->alt = $alt;
		$this->name = $name;
		$this->title = $title;
	}
}

class holder extends htmlElement{
	public $tag = null;
}
?>