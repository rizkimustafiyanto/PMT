<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Card_log_model extends CI_Model
{
    function Get($parameter)
    {
        $procedure = 'call usp_xt_card_log_select(?,?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($parameter)
    {
        $procedure = 'call usp_xt_card_log_insert(?,?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function Update($parameter)
    {
        $procedure = 'call usp_xt_card_log_update(?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function Delete($parameter)
    {
        $procedure = 'call usp_xt_card_log_delete(?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }
}
