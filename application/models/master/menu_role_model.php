<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class menu_role_model extends CI_Model
{
    function GetMenuRole($menu_role_parameter)
    {
        $procedure = 'call usp_gm_menu_role_select(?, ?, ?)';
        $sql_query = $this->db->query($procedure, $menu_role_parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function InsertMenuRole($menu_role_parameter)
    {
        $procedure = 'call usp_gm_menu_role_insert(?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $menu_role_parameter);

        return true;
    }

    // function UpdateMenuRole($menu_role_parameter)
    // {
    //     $procedure = "call usp_gmMenuRole_Update(?,?,?,?,?,?)";
    //     $sql_query = $this->db->query($procedure, $menu_role_parameter);
    //     return true;
    // }

    function DeleteMenuRole($menu_role_parameter)
    {
        $procedure = 'call usp_gm_menu_role_delete(?)';
        $sql_query = $this->db->query($procedure, $menu_role_parameter);
        return true;
    }
}
