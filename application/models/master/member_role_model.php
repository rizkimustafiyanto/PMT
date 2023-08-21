<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class member_role_model extends CI_Model
{
    function Get($param)
    {
        $procedure = 'call usp_gm_member_role_select(?,?)';
        $sql_query = $this->db->query($procedure, $param);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($param)
    {
        $procedure = 'call usp_gm_member_role_insert(?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $param);

        return true;
    }

    function Update($param)
    {
        $procedure = 'call usp_gm_member_role_update(?,?,?,?,?)';
        $sql_query = $this->db->query($procedure, $param);
        return true;
    }

    function Delete($param)
    {
        $procedure = 'call usp_gm_member_role_delete(?)';
        $sql_query = $this->db->query($procedure, $param);
        return true;
    }
}
