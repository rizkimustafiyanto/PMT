<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Calendar_model extends CI_Model
{
    function GetEvent($parameter)
    {
        $procedure = 'call usp_xt_event_select(?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function InsertEvent($parameter)
    {
        $procedure = 'call usp_xt_event_insert(?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function UpdateEvent($parameter)
    {
        $procedure = 'call usp_xt_event_update(?,?,?,?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function DeleteEvent($parameter)
    {
        $procedure = 'call usp_xt_event_delete(?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }

    // External ---------------------------------------------------------------------------
    function GetEventExternal($parameter)
    {
        $procedure = 'call usp_xt_event_external_select(?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function InsertEventExternal($parameter)
    {
        $procedure = 'call usp_xt_event_external_insert(?,?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function UpdateEventExternal($parameter)
    {
        $procedure = 'call usp_xt_event_external_update(?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function DeleteEventExternal($parameter)
    {
        $procedure = 'call usp_xt_event_external_delete(?,?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }

    // Colornya -------------------------------------------------------------------------------------
    function GetEventColor($parameter)
    {
        $procedure = 'call usp_xt_event_colors_select(?,?)';
        $sql_query = $this->db->query($procedure, $parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }

    function InsertEventColor($parameter)
    {
        $procedure = 'call usp_xt_event_colors_insert(?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function UpdateEventColor($parameter)
    {
        $procedure = 'call usp_xt_event_colors_update(?,?,?)';
        $result = $this->db->query($procedure, $parameter);

        return true;
    }

    function DeleteEventColor($parameter)
    {
        $procedure = 'call usp_xt_event_colors_delete(?)';
        $sql_query = $this->db->query($procedure, $parameter);
        return true;
    }
}
