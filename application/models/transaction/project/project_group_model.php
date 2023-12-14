<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class project_group_model extends CI_Model
{
    function Get($parameter)
    {
        $procedure = 'call usp_xt_project_group_select(?,?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($parameter)
    {
        $procedure = 'call usp_xt_project_group_insert(?,?,?,?,@result_message)';
        $this->db->query($procedure, $parameter);

        $result_message_query = $this->db->query('SELECT @result_message AS message');
        $result_message = $result_message_query->row()->message;

        if ($result_message === 'success') {
            return 'success';
        } else {
            return $result_message;
        }
    }

    function Delete($parameter)
    {
        $procedure = 'call usp_xt_project_group_delete(?,@result_message)';
        $this->db->query($procedure, $parameter);

        $result_message_query = $this->db->query('SELECT @result_message AS message');
        $result_message = $result_message_query->row()->message;

        if ($result_message === 'success') {
            return 'success';
        } else {
            return $result_message;
        }
    }
}
