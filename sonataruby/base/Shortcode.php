<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
use \Sonata\Components;
/**
     * API Shortcode do Wordpress adaptada para uma library do CI.
     *
     * A few examples are below:
     *
     * $this->load->library('shortcode');
     * $this->shortcode->add('shortcode', 'myCodeParser');
     * Atenção: "myCodeParser" deve estar disponível!
     *
     * [shortcode /]
     * [shortcode foo="bar" baz="bing" /]
     * [shortcode foo="bar"]content[/shortcode]
     *
     * Shortcode tags support attributes and enclosed content, but does not entirely
     * support inline shortcodes in other shortcodes. You will have to call the
     * shortcode parser in your function to account for that.
     *
     *
     * To apply shortcode tags to content:
     *
     * $out = $this->shortcode->run($content);
     */
class Shortcode {


    /**
     * Container for storing shortcode tags and their hook to call for the shortcode
     * @name $shortcode_tags
     * @var array
     */

    public $shortcode_tags = array();

    /**
     * Add hook for shortcode tag.
     *
     * There can only be one hook for each shortcode. Which means that if another
     * plugin has a similar shortcode, it will override yours or yours will override
     * theirs depending on which order the plugins are included and/or ran.
     *
     * Simplest example of a shortcode tag using the API:
     *
     * <code>
     * // [footag foo="bar"]
     * function footag_func($atts) {
     * 	return "foo = {$atts[foo]}";
     * }
     * $this->shortcode->add('footag', 'footag_func');
     * </code>
     *
     * Example with nice attribute defaults:
     *
     * <code>
     * // [bartag foo="bar"]
     * function bartag_func($atts) {
     * 	extract(shortcode_atts(array(
     * 		'foo' => 'no foo',
     * 		'baz' => 'default baz',
     * 	), $atts));
     *
     * 	return "foo = {$foo}";
     * }
     * $this->shortcode->add('bartag', 'bartag_func');
     * </code>
     *
     * Example with enclosed content:
     *
     * <code>
     * // [baztag]content[/baztag]
     * function baztag_func($atts, $content='') {
     * 	return "content = $content";
     * }
     * $this->shortcode->add('baztag', 'baztag_func');
     * </code>
     *
     * @uses $shortcode_tags
     *
     * @param string $tag Shortcode tag to be searched in post content.
     * @param callable $func Hook to run when shortcode is found.
     */

    function __construct()
    {
        $components = new Components;
        $this->add("plugin", function($atts, $content=""){
            extract($this->shortcode_atts(array(
                       'name' => false
               ), $atts));
            if($name){
                $data = get_instance()->load->getPlugin($name, $atts, $content);
                return $data;
            }
            
        });
        $this->add("components", function($atts, $content="") use(&$components){
            extract($this->shortcode_atts(array(
                       'name' => false
               ), $atts));
            
            if($name){
                
                ob_start();
                print_r($components->{$name}($content, $atts));
                $data = ob_get_contents();
                ob_end_clean();
               
                return $data;
            }
            
        });
        
        $this->add("social", function($atts, $content=""){
            
            $explode = explode('|', $content);
            $arv = [];
            foreach ($explode as $key => $value) {
                list($type, $url) = explode(':', $value);
                $arv[] = ["icon" => "fa fa-".$type,"url" => $url];
                
            }
            $html = '';
            foreach ($arv as $key => $value) {
                $html .= '<a href="'.$value["url"].'" target="_bank"><i class="'.$value["icon"].'"></i></a>';
            }
            return $html;
        });

    }

    function add($tag, $func) {

        if (is_callable($func))
            $this->shortcode_tags[$tag] = $func;
    }

    /**
     * Removes hook for shortcode.
     *
     * @uses $shortcode_tags
     *
     * @param string $tag shortcode tag to remove hook for.
     */
    function remove($tag) {

        unset($this->shortcode_tags[$tag]);
    }

    /**
     * Clear all shortcodes.
     *
     * This function is simple, it clears all of the shortcode tags by replacing the
     * shortcodes global by a empty array. This is actually a very efficient method
     * for removing all shortcodes.
     *
      * @uses $shortcode_tags
     */
    function remove_all() {

        $this->shortcode_tags = array();
    }

    /**
     * Search content for shortcodes and filter shortcodes through their hooks.
     *
     * If there are no shortcode tags defined, then the content will be returned
     * without any filtering. This might cause issues when plugins are disabled but
     * the shortcode will still show up in the post or content.
     *
     * @uses $shortcode_tags
     * @uses get_shortcode_regex() Gets the search pattern for searching shortcodes.
     *
     * @param string $content Content to search for shortcodes
     * @return string Content with shortcodes filtered out.
     */
    function run($content) {

        if (empty($this->shortcode_tags) || !is_array($this->shortcode_tags))
            return $content;

        $pattern = $this->get_shortcode_regex();
        return preg_replace_callback('/' . $pattern . '/s', '\Sonata\Shortcode::do_shortcode_tag', $content);
    }

    /**
     * Retrieve the shortcode regular expression for searching.
     *
     * The regular expression combines the shortcode tags in the regular expression
     * in a regex class.
     *
     * The regular expresion contains 6 different sub matches to help with parsing.
     *
     * 1/6 - An extra [ or ] to allow for escaping shortcodes with double [[]]
     * 2 - The shortcode name
     * 3 - The shortcode argument list
     * 4 - The self closing /
     * 5 - The content of a shortcode when it wraps some content.
     *
     * @uses $shortcode_tags
     *
     * @return string The shortcode search regular expression
     */
    function get_shortcode_regex() {

        $tagnames = array_keys($this->shortcode_tags);
        $tagregexp = join('|', array_map('preg_quote', $tagnames));

// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcodes()
        return '(.?)\[(' . $tagregexp . ')\b(.*?)(?:(\/))?\](?:(.+?)\[\/\2\])?(.?)';
    }

    /**
     * Regular Expression callable for do_shortcode() for calling shortcode hook.
     * @see get_shortcode_regex for details of the match array contents.
     *
     * @access private
     * @uses $shortcode_tags
     *
     * @param array $m Regular expression match array
     * @return mixed False on failure.
     */
    function do_shortcode_tag($m) {


// allow [[foo]] syntax for escaping a tag
        if ($m[1] == '[' && $m[6] == ']') {
            return substr($m[0], 1, -1);
        }

        $tag = $m[2];
        $attr = $this->shortcode_parse_atts($m[3]);

        if (isset($m[5])) {
// enclosing tag - extra parameter
            return $m[1] . call_user_func($this->shortcode_tags[$tag], $attr, $m[5], $tag) . $m[6];
        } else {
// self-closing tag
            return $m[1] . call_user_func($this->shortcode_tags[$tag], $attr, NULL, $tag) . $m[6];
        }
    }

    /**
     * Retrieve all attributes from the shortcodes tag.
     *
     * The attributes list has the attribute name as the key and the value of the
     * attribute as the value in the key/value pair. This allows for easier
     * retrieval of the attributes, since all attributes have to be known.
     *
     *
     * @param string $text
     * @return array List of attributes and their value.
     */
    function shortcode_parse_atts($text) {
        $atts = array();
        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
        if (preg_match_all($pattern, $text, $match, PREG_SET_ORDER)) {
            foreach ($match as $m) {
                if (!empty($m[1]))
                    $atts[strtolower($m[1])] = stripcslashes($m[2]);
                elseif (!empty($m[3]))
                    $atts[strtolower($m[3])] = stripcslashes($m[4]);
                elseif (!empty($m[5]))
                    $atts[strtolower($m[5])] = stripcslashes($m[6]);
                elseif (isset($m[7]) and strlen($m[7]))
                    $atts[] = stripcslashes($m[7]);
                elseif (isset($m[8]))
                    $atts[] = stripcslashes($m[8]);
            }
        } else {
            $atts = ltrim($text);
        }
        return $atts;
    }

    /**
     * Combine user attributes with known attributes and fill in defaults when needed.
     *
     * The pairs should be considered to be all of the attributes which are
     * supported by the caller and given as a list. The returned attributes will
     * only contain the attributes in the $pairs list.
     *
     * If the $atts list has unsupported attributes, then they will be ignored and
     * removed from the final returned list.
     *
     *
     * @param array $pairs Entire list of supported attributes and their defaults.
     * @param array $atts User defined attributes in shortcode tag.
     * @return array Combined and filtered attribute list.
     */
    function shortcode_atts($pairs, $atts) {
        $atts = (array) $atts;
        $out = array();
        foreach ($pairs as $name => $default) {
            if (array_key_exists($name, $atts))
                $out[$name] = $atts[$name];
            else
                $out[$name] = $default;
        }
        return $out;
    }

    /**
     * Remove all shortcode tags from the given content.
     *
     * @uses $shortcode_tags
     *
     * @param string $content Content to remove shortcode tags.
     * @return string Content without shortcode tags.
     */
    function strip_shortcodes($content) {

        if (empty($this->shortcode_tags) || !is_array($this->shortcode_tags))
            return $content;

        $pattern = $this->get_shortcode_regex();

        return preg_replace('/' . $pattern . '/s', '$1$6', $content);
    }

    

}
