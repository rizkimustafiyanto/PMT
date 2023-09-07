<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Card_member_model extends CI_Model
{
    function Get($parameter)
    {
        $procedure = 'call usp_xt_card_member_select(?,?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($parameter)
    {
        $procedure = 'call usp_xt_card_member_insert(?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function Update($parameter)
    {
        $procedure = 'call usp_xt_card_member_update(?,?,?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }

    function Delete($parameter)
    {
        $procedure = 'call usp_xt_card_member_delete(?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }
}
