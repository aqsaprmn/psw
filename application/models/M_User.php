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

    public function getDataWAll($table, $where)
    {
        $data = $this->db->get_where($table, $where)->result_array();

        return $data;
    }

    public function getDataAll($table)
    {
        $data = $this->db->get($table)->result_array();

        return $data;
    }

    public function editData($table, $data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update($table);

        return $this->db->affected_rows();
    }

    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);

        return $this->db->affected_rows();
    }

    public function deletetData($table, $where)
    {
        $this->db->delete($table, $where);

        return $this->db->affected_rows();
    }

    public function cekDataAvai($table, $where)
    {
        return $this->db->get_where($table, $where)->num_rows();
    }

    public function getDataAllDescLim($table, $column, $order, $limit)
    {
        $this->db->order_by($column, $order);
        $this->db->limit($limit);
        $data = $this->db->get($table)->result_array();
        return $data;
    }
}
