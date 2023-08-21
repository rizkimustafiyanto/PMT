<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class variable_model extends CI_Model
{
    function GetVariable($variable_parameter)
    {
        $procedure = 'call usp_gm_variable_select(?, ?)';
        $sql_query = $this->db->query($procedure, $variable_parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function InsertVariable($variable_parameter)
    {
        $procedure = 'call usp_gm_variable_insert(?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $variable_parameter);

        return true;
    }

    function UpdateVariable($variable_parameter)
    {
        $procedure = 'call usp_gm_variable_update(?,?,?,?,?)';
        $sql_query = $this->db->query($procedure, $variable_parameter);
        return true;
    }

    function DeleteVariable($variable_parameter)
    {
        $procedure = 'call usp_gm_variable_delete(?)';
        $sql_query = $this->db->query($procedure, $variable_parameter);
        return true;
    }
}
