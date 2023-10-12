<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class maintenance_model extends CI_Model
{
    function Get($downtime_parameter)
    {
        $procedure = 'call usp_gm_downtime_select(?, ?)';
        $sql_query = $this->db->query($procedure, $downtime_parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($downtime_parameter)
    {
        $procedure = 'call usp_gm_downtime_insert(?,?,@result_message)';
        $result = $this->db->query($procedure, $downtime_parameter);

        $result_message_query = $this->db->query('SELECT @result_message AS message');
        $result_message = $result_message_query->row()->message;

        if ($result_message === 'success') {
            return 'success';
        } else {
            return $result_message;
        }
    }

    function Update($downtime_parameter)
    {
        $procedure = 'call usp_gm_downtime_update(?,?,?,?,?)';
        $sql_query = $this->db->query($procedure, $downtime_parameter);
        if ($sql_query) {
            return true;
        } else {
            return false;
        }
    }
}
