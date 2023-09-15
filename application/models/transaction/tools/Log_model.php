<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Log_model extends CI_Model
{
    function Get($parameter)
    {
        $procedure = 'call usp_xt_log_select(?,?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($parameter)
    {
        $procedure = 'call usp_xt_log_insert(?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }
}
