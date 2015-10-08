<?php 
/*
Plugin Name: Bible Text
Plugin URI: http://www.4-14.org.uk/wordpress-plugins/bible-text
Description: Add Bible text to your Wordpress blog. Use shortcodes like [bible passage="John 4, 1 Cor 12" version="kjv" heading="h3"] in your posts/pages for it to work. For a full list of versions and further help, visit the <a href="http://www.4-14.org.uk/wordpress-plugins/bible-text">plugin site</a>.
Author: Mark Barnes
Version: 0.1
Author URI: http://www.4-14.org.uk/

Copyright (c) 2009 Mark Barnes

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

/**
* Initialisation
* 
* Sets version constants and basic Wordpress hooks.
* @package common_functions
*/
define('MBBT_CURRENT_VERSION', '0.1');
//add_action ('plugins_loaded', 'mbbt_first');
add_action ('init', 'mbbt_init');

function mbbt_first () {
    if (function_exists('wp_timezone_supported') && wp_timezone_supported())
        wp_timezone_override_offset();
}

/**
* Main initialisation function
* 
* Sets up Wordpress hooks and filters.
*/
function mbbt_init () {
	add_shortcode('bible', 'mbbt_shortcode');
    add_action ('wp_head', 'mbbt_styles');
    //Need to add TinyMCE button
}

/**
* Main initialisation function
* 
* Adds styles to the HEAD.
*/
function mbbt_styles () {
    echo "\t<style type =\"text/css\">";
    echo "span.chapter-num { font-weight: bold;} ";
    echo "div.bibletext span.chapter-num { font-size: 150%} ";
    echo "span.verse-num, span.bibletext span.chapter-num  { vertical-align:super; line-height: 1em; font-size: 65%; }";
    echo "div.esv span.small-caps {font-variant: small-caps }";
    echo "div.net p.poetry { font-style: italics; margin: 0 }";
    echo ".audio {display:none;}";
    //echo ".audio_mpeg {width: 250px; height:5px;}";
    echo ".audio_mpeg {margin-left:50px;}";
    echo "</style>";
}


/**
* Create the shortcode handler
* 
* Standard shortcode handler that inserts the bible text output into the post/page
* 
* @param array $atts
* @param string $content
* @return string 
*/
function mbbt_shortcode($atts, $content=null) {
	$atts = shortcode_atts(array('passage' => 'Genesis 1:1', 'version' => 'esv', 'heading' => FALSE), $atts);
    $content = mbbt_add_bible_text ($atts['passage'], $atts['version'], $atts['heading']);
    $pos = 0;
    $loop_ = 0;
    $cont_final = "";
    $code_temp = "";
    $code_left = "";
    do {
    	
    	// This case is the first loop
    	if ( $loop_ == 0 ) {
    		$code_temp = $content;
    	} else {
    		$code_temp = $code_left;
    	}
    		
    	//Let's check if a flash object exist
    	$ocurr_ = substr_count($code_temp, '</object>');
    		
    	if ( $ocurr_ > 0 ) {
    		// if flash object exists, let's get the first part of the code
    		$code_left = strafter($code_temp,'</object>');
    		$code_temp = strbefore($code_temp,'</object>');    		
    		
    		//Let's get ocurrences of ESV
    		$ocurr_ = substr_count($code_temp, 'myUrl=hw%2F');
    		
    		if ( $ocurr_ > 0 ) {
    			//ESV exists
    			$thepasage = strafter($code_temp,'myUrl=hw%2F');  //$myvar = 'Christ,World'
    			$thepasage = strbefore($thepasage,'"'); //result 'Christ'
    			
    			$pos = count( $code_temp );
    			
    			$str_added = "</object>&nbsp;&nbsp;<audio class=\"audio_mpeg\" controls><source src=\"http://stream.esvmedia.org/mp3-play/hw/$thepasage.mp3\" type=\"audio/mpeg\"></audio>";
    			//$str_added = "</object><span><!-- thepasage:$thepasage POS: $pos LOOP: $loop_ OCURR: $ocurr_ --></span>";

    			$code_temp .= $str_added;
    			
    			$cont_final .= $code_temp;
    		}
    	}	
    	$loop_++;
    	
    } while (  $ocurr_ > 0 );
    
    if ( $cont_final != "" )
    	$content = $cont_final . $code_left;
    
    return $content;
}

//Downloads external webpage. Used to add Bible passages to sermon page.
function mbbt_download_page ($page_url) {
    if (function_exists('curl_init')) {
        $curl = curl_init();
        curl_setopt ($curl, CURLOPT_URL, $page_url);
        curl_setopt ($curl, CURLOPT_TIMEOUT, 2);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($curl, CURLOPT_HTTPHEADER, array('Accept-Charset: utf-8;q=0.7,*;q=0.7'));
        $contents = curl_exec ($curl);
        $content_type = curl_getinfo( $curl, CURLINFO_CONTENT_TYPE );
        curl_close ($curl);
    }
    else
        {
        $handle = @fopen ($page_url, 'r');
        if ($handle) {
            stream_set_blocking($handle, TRUE );
            stream_set_timeout($handle, 2);
            $info = socket_get_status($handle);
            while (!feof($handle) && !$info['timed_out']) {
                $contents .= fread($handle, 8192);
                $info = socket_get_status($handle);
            }
        @fclose($handle);
        }
    }
    return $contents;
}

//Add Bible text to single sermon page
function mbbt_add_bible_text ($reference, $version, $heading) {
    $version = strtolower($version);
    if ($version == 'esv')
        return mbbt_add_esv_text ($reference, $heading);
    elseif ($version == 'net')
        return mbbt_add_net_text ($reference, $heading);
    else
        return mbbt_add_other_bibles ($reference, $version, $heading);
}
    
//Returns ESV text
function mbbt_add_esv_text ($reference, $heading) {
    // If you are experiencing errors, you should sign up for an ESV API key, 
    // and insert the name of your key in place of the letters IP in the URL
    // below (.e.g. ...passageQuery?key=YOURAPIKEY&passage=...)
    $esv_url = 'http://www.esvapi.org/v2/rest/passageQuery?key=IP&passage='.urlencode($reference).'&include-headings=false&include-footnotes=false';
    if ($heading === FALSE || strtolower($heading) == 'span')
        $esv_url .= '&include-passage-references=false&include_audio_link=false&include-first-verse-numbers=false';
    return mbbt_download_page ($esv_url);
}

//Returns NET Bible text
function mbbt_add_net_text ($reference, $heading) {
    $net_url = "http://labs.bible.org/api/xml/verse.php?passage=".str_replace(" ", "+", $reference);
    if (!class_exists('SimpleXMLElement') || $heading === FALSE || strtolower($heading) == 'span')
        $xml = mbbt_get_xml(mbbt_download_page($net_url.'&formatting=plain'));
    else
        $xml = mbbt_get_xml(mbbt_download_page($net_url.'&formatting=para'));
    $output='';
    $items = array();
    $items = $xml->item;
    foreach ($items as $item) {
        if ($item->text != '[[EMPTY]]') {
            if (substr($item->text, 0, 8) == '<p class') {
                $paraend = stripos($item->text, '>', 8)+1;
                $output .= "\n".substr($item->text, 0, $paraend);
                $item->text = substr ($item->text, $paraend);
            }
            if ($old_chapter == $item->chapter) {
                $output .= " <span class=\"verse-num\">{$item->verse}</span>";
            } else {
                $output .= " <span class=\"chapter-num\">{$item->chapter}:{$item->verse}</span> ";
                $old_chapter = strval($item->chapter);
            }
            $output .= $item->text;
        }
    }
    if ($heading !== FALSE && strtolower($heading) != 'span')
        return "<div class=\"bibletext version-net\">\r<{$heading}>".$reference."</{$heading}><p>{$output} (<a href=\"http://net.bible.org/?{$reference}\">NET Bible</a>)</p></div>";
    else
        return "<span class=\"bibletext version-net\">{$output} (<a href=\"http://net.bible.org/?{$reference}\">NET Bible</a>)</span>";
}

//Returns Bible text using the plugin's own API
function mbbt_add_other_bibles ($reference, $version, $heading) {
    $old_chapter = '';
    $reference = urlencode($reference);
    $url = "http://api.preachingcentral.com/bible.php?passage={$reference}&version={$version}";
    $xml = mbbt_get_xml(mbbt_download_page($url));
    $final = array();
    if ($xml->range)
        foreach ($xml->range as $range) {
            $output = '';
            if ($range->item)
                foreach ($range->item as $item) {
                    if ($item->text != '[[EMPTY]]') {
                        if ($old_chapter == $item->chapter || $range->chapter_span=='1') {
                            $output .= " <span class=\"verse-num\">{$item->verse}</span>";
                        } else {
                            $output .= " <span class=\"chapter-num\">{$item->chapter}:{$item->verse}</span> ";
                            $old_chapter = strval($item->chapter);
                        }
                        $output .=     $item->text;
                    }
                }
            if ($heading !== FALSE && strtolower($heading) != 'span')
                $final[] = '<'.$heading.'>'.$range->result.'</'.$heading.'>'.$output;
            else
                $final[] = $output;
        }
        if ($heading !== FALSE && strtolower($heading) != 'span')
            return '<div class="bibletext version-'.$version.'">'.implode($final).'</div>';
        else
            return '<span class="bibletext version-'.$version.'">'.implode($final, '&hellip;').'</span>';
}

// Converts XML string to object
function mbbt_get_xml ($content) {
    if (class_exists('SimpleXMLElement')) {
        $xml = new SimpleXMLElement($content);
    } else {
        $xml = new SimpleXMLElement4();
        $xml = $xml->xml_load_file($content, 'object', 'utf-8');
    }
    return $xml;
}

/*
 * strafter and strbefore are the easiest way of getting part of string given to its sub-string or character
 * See more at: http://www.wordinn.com/solution/108/php-getting-part-string-after-and-given-sub-string-or-character#sthash.jNwsmc9E.dpuf
 */
function strafter($string, $substring) {
	$pos = strpos($string, $substring);
	if ($pos === false)
		return $string;
	else
		return(substr($string, $pos+strlen($substring)));
}
function strbefore($string, $substring) {
	$pos = strpos($string, $substring);
	if ($pos === false)
		return $string;
	else
		return(substr($string, 0, $pos));
}

// Emulates SimpleXMLElement on PHP4
if (!class_exists('SimpleXMLElement4')) {

    class SimpleXMLObject{
        function attributes(){
            $container = get_object_vars($this);
            return (object) $container["@attributes"];
        }
        function content(){
            $container = get_object_vars($this);
            return (object) $container["@content"];
        }

    }

    class SimpleXMLElement4 {
        var $result = array();
        var $ignore_level = 0;
        var $skip_empty_values = false;
        var $php_errormsg;
        var $evalCode="";

        function array_insert($level, $tags, $value, $type) {
            $temp = '';
            for ($c = $this->ignore_level + 1; $c < $level + 1; $c++) {
                if (isset($tags[$c]) && (is_numeric(trim($tags[$c])) || trim($tags[$c]))) {
                    if (is_numeric($tags[$c])) {
                        $temp .= '[' . $tags[$c] . ']';
                    } else {
                        $temp .= '["' . $tags[$c] . '"]';
                    }
                }
            }
            $this->evalCode .= '$this->result' . $temp . "=\"" . addslashes($value) . "\";//(" . $type . ")\n";
            #echo $code. "\n";
        }

        function xml_tags($array) {
            $repeats_temp = array();
            $repeats_count = array();
            $repeats = array();
            if (is_array($array)) {
                $n = count($array) - 1;
                for ($i = 0; $i < $n; $i++) {
                    $idn = $array[$i]['tag'].$array[$i]['level'];
                    if(in_array($idn,$repeats_temp)){
                        $repeats_count[array_search($idn,$repeats_temp)]+=1;
                    } else {
                        array_push($repeats_temp,$idn);
                        $repeats_count[array_search($idn,$repeats_temp)]=1;
                    }
                }
            }
            $n = count($repeats_count);
            for($i=0;$i<$n;$i++){
                if($repeats_count[$i]>1){
                    array_push($repeats,$repeats_temp[$i]);
                }
            }
            unset($repeats_temp);
            unset($repeats_count);
            return array_unique($repeats);
        }

        function array2object ($arg_array) {
            if (is_array($arg_array)) {
                $keys = array_keys($arg_array);
                if(!is_numeric($keys[0])) $tmp = new SimpleXMLObject;
                foreach ($keys as $key) {
                    if (is_numeric($key)) $has_number = true;
                    if (is_string($key)) $has_string = true;
                }
                if (isset($has_number) and !isset($has_string)) {
                    foreach ($arg_array as $key => $value) {
                        $tmp[] = $this->array2object($value);
                    }
                } elseif (isset($has_string)) {
                    foreach ($arg_array as $key => $value) {
                        if (is_string($key))
                        $tmp->$key = $this->array2object($value);
                    }
                }
            } elseif (is_object($arg_array)) {
                foreach ($arg_array as $key => $value) {
                    if (is_array($value) or is_object($value))
                    $tmp->$key = $this->array2object($value);
                    else
                    $tmp->$key = $value;
                }
            } else {
                $tmp = $arg_array;
            }
            return $tmp;
        }

        function array_reindex($array) {
            if (is_array($array)) {
                if(count($array) == 1 && $array[0]){
                    return $this->array_reindex($array[0]);
                } else {
                    foreach($array as $keys => $items) {
                        if (is_array($items)) {
                            if (is_numeric($keys)) {
                                $array[$keys] = $this->array_reindex($items);
                            } else {
                                $array[$keys] = $this->array_reindex(array_merge(array(), $items));
                            }
                        }
                    }
                }
            }
            return $array;
        }

        function xml_reorganize($array) {
            $count = count($array);
            $repeat = $this->xml_tags($array);
            $repeatedone = false;
            $tags = array();
            $k = 0;
            for ($i = 0; $i < $count; $i++) {
                switch ($array[$i]['type']) {
                    case 'open':
                        array_push($tags, $array[$i]['tag']);
                        if ($i > 0 && ($array[$i]['tag'] == $array[$i-1]['tag']) && ($array[$i-1]['type'] == 'close'))
                        $k++;
                        if (isset($array[$i]['value']) && ($array[$i]['value'] || !$this->skip_empty_values)) {
                            array_push($tags, '@content');
                            $this->array_insert(count($tags), $tags, $array[$i]['value'], "open");
                            array_pop($tags);
                        }
                        if (in_array($array[$i]['tag'] . $array[$i]['level'], $repeat)) {
                            if (($repeatedone == $array[$i]['tag'] . $array[$i]['level']) && ($repeatedone)) {
                                array_push($tags, strval($k++));
                            } else {
                                $repeatedone = $array[$i]['tag'] . $array[$i]['level'];
                                array_push($tags, strval($k));
                            }
                        }
                        if (isset($array[$i]['attributes']) && $array[$i]['attributes'] && $array[$i]['level'] != $this->ignore_level) {
                            array_push($tags, '@attributes');
                            foreach ($array[$i]['attributes'] as $attrkey => $attr) {
                                array_push($tags, $attrkey);
                                $this->array_insert(count($tags), $tags, $attr, "open");
                                array_pop($tags);
                            }
                            array_pop($tags);
                        }
                        break;
                    case 'close':
                        array_pop($tags);
                        if (in_array($array[$i]['tag'] . $array[$i]['level'], $repeat)) {
                            if ($repeatedone == $array[$i]['tag'] . $array[$i]['level']) {
                                array_pop($tags);
                            } else {
                                $repeatedone = $array[$i + 1]['tag'] . $array[$i + 1]['level'];
                                array_pop($tags);
                            }
                        }
                        break;
                    case 'complete':
                        array_push($tags, $array[$i]['tag']);
                        if (in_array($array[$i]['tag'] . $array[$i]['level'], $repeat)) {
                            if ($repeatedone == $array[$i]['tag'] . $array[$i]['level'] && $repeatedone) {
                                array_push($tags, strval($k));
                            } else {
                                $repeatedone = $array[$i]['tag'] . $array[$i]['level'];
                                array_push($tags, strval($k));
                            }
                        }
                        if (isset($array[$i]['value']) && ($array[$i]['value'] || !$this->skip_empty_values)) {
                            if (isset($array[$i]['attributes']) && $array[$i]['attributes']) {
                                array_push($tags, '@content');
                                $this->array_insert(count($tags), $tags, $array[$i]['value'], "complete");
                                array_pop($tags);
                            } else {
                                $this->array_insert(count($tags), $tags, $array[$i]['value'], "complete");
                            }
                        }
                        if (isset($array[$i]['attributes']) && $array[$i]['attributes']) {
                            array_push($tags, '@attributes');
                            foreach ($array[$i]['attributes'] as $attrkey => $attr) {
                                array_push($tags, $attrkey);
                                $this->array_insert(count($tags), $tags, $attr, "complete");
                                array_pop($tags);
                            }
                            array_pop($tags);
                        }
                        if (in_array($array[$i]['tag'] . $array[$i]['level'], $repeat)) {
                            array_pop($tags);
                            $k++;
                        }
                        array_pop($tags);
                        break;
                }
            }
            eval($this->evalCode);
            $last = $this->array_reindex($this->result);
            return $last;
        }

        function xml_load_file($data, $resulttype = 'object', $encoding = 'UTF-8') {
            $php_errormsg="";
            $this->result="";
            $this->evalCode="";
            $values="";
            $parser = xml_parser_create($encoding);
            xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
            xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
            $ok = xml_parse_into_struct($parser, $data, $values);
            if (!$ok) {
                $errmsg = sprintf("XML parse error %d '%s' at line %d, column %d (byte index %d)",
                xml_get_error_code($parser),
                xml_error_string(xml_get_error_code($parser)),
                xml_get_current_line_number($parser),
                xml_get_current_column_number($parser),
                xml_get_current_byte_index($parser));
            }
            xml_parser_free($parser);
            if (!$ok)
            return $errmsg;
            if ($resulttype == 'array')
            return $this->xml_reorganize($values);
            return $this->array2object($this->xml_reorganize($values));
        }
    }
}
?>