<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class role_model extends CI_Model
{
    function GetRole($role_parameter)
    {
        $procedure = 'call usp_gm_role_select(?, ?)';
        $sql_query = $this->db->query($procedure, $role_parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function InsertRole($role_parameter)
    {
        $procedure = 'call usp_gm_role_insert(?,?,?,?,?)';
        $result = $this->db->query($procedure, $role_parameter);

        return true;
    }

    function UpdateRole($role_parameter)
    {
        $procedure = 'call usp_gm_role_update(?,?,?,?)';
        $sql_query = $this->db->query($procedure, $role_parameter);
        return true;
    }

    function DeleteRole($role_parameter)
    {
        $procedure = 'call usp_gm_role_delete(?)';
        $sql_query = $this->db->query($procedure, $role_parameter);
        return true;
    }
}
