<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	var $CI;

	var $valid_formats = array(
			"xml",
			"json"
		);

	var $channel 	= false;
	var $entry_id 	= false;
	var $query 		= array();
	var $sort 		= array();


	function __construct()
	{
		parent::__construct();

		$this->CI =& get_instance();
	}


	public function index()
	{
        $this->channel = $this->uri->segment(1);
        $this->entry_id = $this->uri->segment(2);

        //Parse format
        if(preg_match('/\.(('.implode(")|(", $this->valid_formats).'))/i', $this->uri->segment($this->uri->total_segments()), $result) > 0){
        	$this->CI->output->format = $result[1];

        	if($this->uri->total_segments() == 2){
        		$this->entry_id = str_replace(".".$result[1], "", $this->entry_id);
        	}else if ($this->uri->total_segments() == 1){
        		$this->channel = str_replace(".".$result[1], "", $this->channel);
        	}
        }


        //Channel specified? If not, fetch all
        if($this->channel == false){
        	$data = $this->channel_data->all();
        	if($data){
        		return $this->CI->output->data($data);	
        	}
        	$this->CI->output->error("Channel data not found", 404);
        }

        //Entry ID specified? If not, fetch all entries in channel
        if($this->entry_id == false){
        	$data = $this->channel_data->get_channel($this->channel);
        	if($data){
        		return $this->CI->output->data($data);	
        	}
        	$this->CI->output->error("Channel not found", 404);
        }

        //Fetch specified entry 
        $data = $this->channel_data->get_entry($this->entry_id, $this->channel);
        if($data){
        	return $this->CI->output->data($data);
        }
        $this->CI->output->error("Entry not found", 404);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */