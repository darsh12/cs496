<?php
// Class for creating HTMl elements through strings
class HTML_Element
{
    private $type;

    // Variable to contain inner html of elements;
    // Use this to place html elements and text within other elements
    // ex: <div> 'data of $inside var goes here' </div>
    private $inside;

    private $emptyElements = ["area", "base", "br", "col", "embed", "hr", "img", "input", "keygen", "link", "meta", "param", "source", "track", "wbr"];

    // Constructor; attributes are optional associative array
    public function __construct($type, $attributes = array()) {
        $this->type = $type;
        foreach($attributes as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    public function __toString()
    {
        return $this->getContainer();
    }

    // Returns container string to be echoed on index page
    public function getContainer() {

        // Properties to exclude when adding attribute strings
        $exclusions = ["type", "inside", "emptyElements"];

        $isEmptyElement = false;

        // Check if element needs closing tag
        if(in_array($this->type, $this->emptyElements))
            $isEmptyElement = true;

        // Open element tag
        $container = "<$this->type ";

        // Append attributes to element tag
        foreach (get_object_vars($this) as $attribute => $value) {

            // If attribute is non-magic property, add as element attribute
            if(!in_array($attribute, $exclusions)) {
                $container .= "$attribute = " . '"' . $value . '" ';
            }
        }

        // Close element tag
        if($isEmptyElement) {
            $container .= ">";
        }
        else {
            $container .= ">$this->inside</$this->type>";
        }

        return $container;
    }

    // GET and SET property overloading to dynamically set attributes of diff HTML elements
    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }

}