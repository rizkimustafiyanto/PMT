<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class management_member_model extends CI_Model
{
    function Get($param)
    {
        $procedure = 'call usp_gm_management_member_select(?,?)';
        $sql_query = $this->db->query($procedure, $param);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($param)
    {
        $procedure = 'call usp_gm_management_member_insert(?,?,?)';
        $result = $this->db->query($procedure, $param);

        return true;
    }

    function Update($param)
    {
        $procedure = 'call usp_gm_management_member_update(?,?,?,?)';
        $sql_query = $this->db->query($procedure, $param);
        return true;
    }

    function Delete($param)
    {
        $procedure = 'call usp_gm_management_member_delete(?)';
        $sql_query = $this->db->query($procedure, $param);
        return true;
    }
}
