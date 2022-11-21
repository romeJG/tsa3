<?php

class main_models extends CI_Model
{
    function insert_data($table, $data)
    {
        $this->db->insert($table, $data);
    }
    function fetch_data($table)
    {
        $query = $this->db->get($table);
        return $query;
    }
    
    function fetch_single_data($table, $id)
    {
        $this->db->where("id", $id);
        $query = $this->db->get($table);
        return $query;
    }
    function update_data($table, $data, $id)
    {
        $this->db->where("id", $id);
        $this->db->update($table, $data);
    }
    function delete_data($table, $id)
    {
        $this->db->where("id", $id);
        $this->db->delete($table);
    }
}
