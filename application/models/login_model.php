<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_model extends CI_Model
{
    function Login($login_parameter, $password)
    {
        $procedure = 'call usp_login(?, ?)';
        $sql_query = $this->db->query($procedure, $login_parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            foreach ($sql_query->result() as $k) {
                $DBpassword = $k->password;
            }

            if (verifyHashedPassword($password, $DBpassword)) {
                return $sql_query->result();
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    function cekRole($cek_role_parameter)
    {
        $procedure = 'call usp_cek_role(?, ?)';
        $sql_query = $this->db->query($procedure, $cek_role_parameter);
        mysqli_next_result($this->db->conn_id);
        if ($sql_query->num_rows() > 0) {
            return $sql_query->result();
        }
    }
}
