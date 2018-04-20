<?php
/**
 * Created by PhpStorm.
 * User: pateldarshan
 * Date: 4/20/18
 * Time: 8:06 AM
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtentsion extends  AbstractExtension {

//    public function getFilters() {
//
//        return [
//            new TwigFilter('json_decode',[$this, 'jsonDecode'])
//        ];
//
//    }
//
//    public function jsonDecode() {
//
//    }
    /**
     * Define Twig filters
     * @example
     * {{ string|json_decode }}
     * {{ string|json_encode }}
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('json_decode', array($this, 'jsonDecode'))
        );
    }
    /**
     * Define Twig functions
     * @example
     * {{ json_decode(string) }}
     * {{ json_encode(string) }}
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'json_decode'  => new \Twig_SimpleFunction('json_decode', [$this, 'jsonDecode']),
            'json_encode' => new \Twig_SimpleFunction('json_encode', [$this, 'jsonEncode']),
        );
    }
    /**
     * Decode JSON string
     * @param  string $string
     * @return object
     */
    public function jsonDecode($string)
    {
        return json_decode($string);
    }
    /**
     * Encode an object or array to JSON
     * @param  array $array
     * @return string
     */
    public function jsonEncode($array)
    {
        return json_encode($array);
    }
    /** Extension name */
    public function getName()
    {
        return 'json_extension';
    }


}