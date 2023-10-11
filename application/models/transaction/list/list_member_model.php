<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class list_member_model extends CI_Model
{
    function Get($parameter)
    {
        $procedure = 'call usp_xt_list_member_select(?,?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($parameter)
    {
        $procedure = 'call usp_xt_list_member_insert(?,?,?,?,@result_message)';
        $result = $this->db->query($procedure, $parameter);

        $result_message_query = $this->db->query('SELECT @result_message AS message');
        $result_message = $result_message_query->row()->message;

        if ($result_message === 'success') {
            return 'success';
        } else {
            return $result_message;
        }
    }

    function Update($parameter)
    {
        $procedure = 'call usp_xt_list_member_update(?,?,?,?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }

    function Delete($parameter)
    {
        $procedure = 'call usp_xt_list_member_delete(?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }
}
