<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
* 
*/
class Channel_data extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function all()
	{
		return $this->db->get("channels")->result_array();
	}


	public function get_channel($channel_name)
	{
		$this->db->where("channel_name", $channel_name);
		$channels = $this->db->get("channels")->result_array();

		if(count($channels)==0){
			return array();
		}

		$channel = $channels[0];

		$this->db->where("channel_titles.channel_id", $channel['channel_id']);
		$this->db->join("channel_data","channel_titles.entry_id = channel_data.entry_id");
		$this->db->from("channel_titles");
		$channel['entries'] = $this->db->get()->result_array();


		$this->db->select("field_id, field_name");
		$fields = $this->db->get("channel_fields")->result_array();
		

		foreach ($channel['entries'] as $key => $entry) {
			foreach($fields as $field_key => $field){
				
				if(!isset($entry["field_id_".$field['field_id']])) continue;

				$channel['entries'][$key][$field['field_name']] = $entry["field_id_".$field['field_id']];
				unset($channel['entries'][$key]["field_ft_".$field['field_id']]);
				unset($channel['entries'][$key]["field_id_".$field['field_id']]);

			}
		}

		return $channel;
	}



	public function get_entry($entry_id, $channel_name)
	{
		$this->db->where("channel_name", $channel_name);
		$channels = $this->db->get("channels")->result_array();

		if(count($channels)==0){
			return array();
		}


		/**
		 * TODO:
		 * 
		 * Need to make the entry query only pull in the relevant fields for the specified channel (ie: filter field group)
		 * 
		 */


		$channel = $channels[0];

		$this->db->where("channel_titles.entry_id", $entry_id);
		$this->db->where("channel_titles.channel_id", $channel['channel_id']);
		$this->db->join("channel_data","channel_titles.entry_id = channel_data.entry_id");
		$this->db->from("channel_titles");
		$entries = $this->db->get()->result_array();

		if(count($entries)==0){
			return array();
		}

		$entry = $entries[0];


		$this->db->select("field_id, field_name");
		$fields = $this->db->get("channel_fields")->result_array();
		

		foreach($fields as $field_key => $field){
			
			if(!isset($entry["field_id_".$field['field_id']])) continue;

			$entry[$field['field_name']] = $entry["field_id_".$field['field_id']];
			unset($entry["field_ft_".$field['field_id']]);
			unset($entry["field_id_".$field['field_id']]);
		}
	

		return $entry;
	}
}