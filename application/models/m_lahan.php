<?php

defined('BASEPATH') or exit('No direct script access allowed');

class m_lahan extends CI_Model
{

    public function add($data)
    {
        $this->db->insert('tbl_lahan', $data);
    }
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_lahan');
        $this->db->order_by('id_lahan', 'asce');
        return $this->db->get()->result();
    }
    public function detail($id_lahan)
    {
        $this->db->select('*');
        $this->db->from('tbl_lahan');
        $this->db->where('id_lahan', $id_lahan);
        return $this->db->get()->row();
    }
    public function edit($data)
    {
        $this->db->where('id_lahan', $data['id_lahan']);
        $this->db->update('tbl_lahan', $data);
    }
    public function delete($data)
    {
        $this->db->where('id_lahan', $data['id_lahan']);
        $this->db->delete('tbl_lahan', $data);
    }
    public function get_all_foto()
    {
        $this->db->select('tbl_lahan.*,count(tbl_foto.id_lahan) as total_foto');
        $this->db->from('tbl_lahan');
        $this->db->join('tbl_foto', 'tbl_foto.id_lahan = tbl_lahan.id_lahan', 'left');
        $this->db->group_by(' tbl_lahan.id_lahan');
        $this->db->order_by('id_lahan', 'asce');
        return $this->db->get()->result();
    }
    public function getdatakelompok(){
        $this->db->select('uraian');
        $this->db->from('tbl_7');
        $this->db->order_by('uraian','ASC');
        return $this->db->get()->result();
    }
    public function auto_jenis_tanah($title){
        $this->db->like('uraian',$title);
        $this->db->order_by('uraian','ASC');
        $this->db->limit(10);
        return $this->db->get('tbl_7')->result();
    }
}
