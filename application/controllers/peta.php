<?php

defined('BASEPATH') or exit('No direct script access allowed');

class peta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('m_lahan');
    }

    public function index()
    {
        $data = array(
            'title' => 'Peta',
            'lahan' => $this->m_lahan->get_all_data(),
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('peta/v_peta', $data);
        $this->load->view('templates/footer');
    }
}
