<?php

class M_User extends CI_Model
{
    public function registration($table, $data)
    {
        $this->db->insert($table, $data);

        return $this->db->affected_rows();
    }

    public function getDataW($table, $where)
    {
        $data = $this->db->get_where($table, $where)->row_array();

        return $data;
    }

    public function getDataAll($table)
    {
        $data = $this->db->get($table)->result_array();

        return $data;
    }
}
