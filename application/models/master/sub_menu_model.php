<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class sub_menu_model extends CI_Model
{
    function GetSubMenu($sub_menu_parameter)
    {
        $procedure = 'call usp_gm_sub_menu_select(?, ?)';
        $sql_query = $this->db->query($procedure, $sub_menu_parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function InsertSubMenu($sub_menu_parameter)
    {
        $procedure = 'call usp_gm_sub_menu_insert(?,?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $sub_menu_parameter);

        return true;
    }

    function UpdateSubMenu($sub_menu_parameter)
    {
        $procedure = 'call usp_gm_sub_menu_update(?,?,?,?,?,?,?)';
        $sql_query = $this->db->query($procedure, $sub_menu_parameter);
        return true;
    }

    function DeleteSubMenu($sub_menu_parameter)
    {
        $procedure = 'call usp_gm_sub_menu_delete(?)';
        $sql_query = $this->db->query($procedure, $sub_menu_parameter);
        return true;
    }
}
