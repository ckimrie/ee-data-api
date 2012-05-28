<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead_data extends CI_Model {


    function capture($email, $formId, $leadData)
    {
        $data = array();

        $data['email'] = $email;
        $data['data'] = serialize($leadData);
        $data['form'] = $formId;
        $data['timestamp'] = time();
        //Store everything using the first session they were given since the session may have cycled
        $data['session'] = $this->session->userdata('static_session'); 

        $this->db->insert("leads", $data);

        return $this->db->insert_id();

    }


    public function update($leadId, $email, $formId, $leadData)
    {

        //Make sure the updating user is allowed to modify this contact
        if(!$this->getCurrentUserLead($leadId)){
            return FALSE;
        }

        $data = array();
        $data['data'] = serialize($leadData);
        $data['form'] = $formId;
        $data['updated'] = time();

        //Store everything using the first session they were given since the session may have cycled
         
        $this->db->where("id",$leadId);
        $this->db->update("leads", $data);

        return TRUE;
    }




    public function getForCurrentUser()
    {
        $this->db->where("email", $this->session->userdata('email'));
        $this->db->where("session", $this->session->userdata('static_session'));
        $this->db->order_by("timestamp", "desc");
        $a = $this->db->get("leads")->result_array();

        
        foreach($a as $key => $row){
            if($key == "data"){
                $a[$key]['data'] = unserialize($row['data']);
            }
        }
        return $a;
    }



    public function getCurrentUserLead($id='')
    {
        $this->db->where("id", $id);
        $this->db->where("session", $this->session->userdata('static_session'));
        $a = $this->db->get("leads")->result_array();

        if(count($a) > 0){
            $a[0]['data'] = unserialize($a[0]['data']);
        }else{
            return FALSE;
        }

        return $a[0];
    }


    
}