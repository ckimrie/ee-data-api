<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @author      ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license     http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Output Class
 *
 * Responsible for sending final output to browser
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Output
 * @author      ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/libraries/output.html
 */
class MY_Output extends CI_Output {


    var $format = "xml";

    /**
     * Outputs JSON data for dojo datastore
     *
     * @param string $data 
     * @return void
     * @author Christopher Imrie
     */
    public function json($data=array())
    {
        $this->output->parse_exec_vars = FALSE;


        $this->set_header("Content-Type: application/json");

        $this->set_output(json_encode($data));
    }



    /**
     * Outputs JSON data for dojo datastore
     *
     * @param string $data 
     * @return void
     * @author Christopher Imrie
     */
    public function xml($data=array())
    {
        $this->output->parse_exec_vars = FALSE;


        $this->set_header("Content-Type: text/xml");
       // echo "<pre>";
       // var_dump($data);
        $this->set_output($this->toXml($data));
    }



    

    public function error($message='', $code = 500)
    {
        $this->set_status_header($code);
        $this->data(array("error" => $message));
    }



    public function data($data=array())
    {
        if($this->format == "json"){
            $this->json($data);    
        }
        else if($this->format == "xml") {
            $this->xml($data);
        }
        $this->_display();
        exit;
    }







    /**
     * The main function for converting to an XML document.
     * Pass in a multi dimensional array and this recrusively loops through and builds up an XML document.
     *
     * @param array $data
     * @param string $rootNodeName - what you want the root node to be - defaultsto data.
     * @param SimpleXMLElement $xml - should only be used recursively
     * @return string XML
     */
    private static function toXml($data, $rootNodeName = 'root', $xml=null)
    {
        // turn off compatibility mode as simple xml throws a wobbly if you don't.
        if (ini_get('zend.ze1_compatibility_mode') == 1)
        {
            ini_set ('zend.ze1_compatibility_mode', 0);
        }
 
        if ($xml == null)
        {
            $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
        }
 
        // loop through the data passed in.
        foreach($data as $key => $value)
        {
            // no numeric keys in our xml please!
            if (is_numeric($key))
            {
                // make string key...
                $key = "item". (string) $key;
            }
 
            // replace anything not alpha numeric
            if(strpos($key, "field_id") === false){
                $key = preg_replace('/[^a-z_]/i', '', $key);
            }
            // if there is another array found recrusively call this function
            if (is_array($value))
            {
                $node = $xml->addChild($key);
                // recrusive call.
                MY_Output::toXml($value, $rootNodeName, $node);
            }
            else 
            {
                // add single node.
                                $value = htmlentities($value);
                $xml->addChild($key,$value);
            }
 
        }
        // pass back as string. or simple xml object if you want!
        return $xml->asXML();
    }

}