<?php
include("php/HTML_Element.class.php");

// We will build upon our index page by modular additions in the form of string concatenations
$index = new HTML_Element("img", ["src" => "hehe.png", "style" => "width: 50%; height: 75%"]);
echo $index;