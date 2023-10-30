<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Notification_model extends CI_Model
{
    function Get($parameter)
    {
        $procedure = 'call t_notification_select(?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function Insert($parameter)
    {
        $procedure = 'call t_notification_insert(?,?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function Update($parameter)
    {
        $procedure = 'call t_notification_update(?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }
}
