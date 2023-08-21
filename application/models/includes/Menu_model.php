<?php

class Menu_model extends CI_Model
{
    public function getMainMenu($role_id)
    {
        $this->db->distinct();
        $this->db->select('c.menu_id, c.menu_name, c.menu_url, c.menu_icon');
        $this->db->from('gm_menu_role a');
        $this->db->join('gm_role b', 'a.role_id = b.role_id', 'left');
        $this->db->join('gm_menu c', 'a.menu_id = c.menu_id', 'left');
        $this->db->where('a.role_id', $role_id);
        return $this->db->get()->result();
    }

    public function getSubMenu($role_id, $menu_id)
    {
        $this->db->select('c.sub_menu_id, c.sub_menu_name, c.sub_menu_url, c.sub_menu_icon');
        $this->db->from('gm_menu_role a');
        $this->db->join('gm_sub_menu c', 'a.sub_menu_id = c.sub_menu_id');
        $this->db->where('a.role_id', $role_id);
        $this->db->where('a.menu_id', $menu_id);
        $this->db->order_by('c.sub_menu_name', 'asc');
        return $this->db->get()->result();
    }
}
