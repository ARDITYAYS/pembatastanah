<?php


defined('BASEPATH') or exit('No direct script access allowed');

class dtanah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('m_lahan');
    }

    // List all your items
    public function index()
    {

        $data = array(
            'title' => 'Data Tanah',
            'lahan' => $this->m_lahan->get_all_data(),
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tanah/v_data', $data);
        $this->load->view('templates/footer');
    }

    // Add a new item
    public function add()
    {

        $this->form_validation->set_rules(
            'pengguna',
            'Pengguna',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'hak',
            'Hak',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'no',
            'No',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'tglhak',
            'Tanggal Hak',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'luas',
            'Luas',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'nilai',
            'Nilai',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'asal',
            'Asal',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'jenis',
            'Jenis Tanah',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'dinas',
            'Asal Dinas',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'status',
            'Status',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'denah_geojson',
            'Denah GeoJson',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'warna',
            'Warna',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $data = array(
                    'title' => 'Input Data Tanah',
                    'lahan' => $this->m_lahan->get_all_data(),
                    'error_upload' => $this->upload->display_errors(),
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()
                );
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('tanah/v_add', $data);
                $this->load->view('templates/footer');
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'pengguna' => $this->input->post('pengguna'),
                    'alamat' => $this->input->post('alamat'),
                    'hak' => $this->input->post('hak'),
                    'no' => $this->input->post('no'),
                    'tglhak' => $this->input->post('tglhak'),
                    'luas' => $this->input->post('luas'),
                    'nilai' => $this->input->post('nilai'),
                    'asal' => $this->input->post('asal'),
                    'jenis' => $this->input->post('jenis'),
                    'dinas' => $this->input->post('dinas'),
                    'status' => $this->input->post('status'),
                    'keterangan' => $this->input->post('keterangan'),
                    'denah_geojson' => $this->input->post('denah_geojson'),
                    'warna' => $this->input->post('warna'),
                    'gambar' => $upload_data['uploads']['file_name']
                );
                $this->m_lahan->add($data);
                $this->session->set_flashdata('sukses', 'Data berhasil disimpan');
                redirect('dtanah/add');
            }
        }
        $data = array(
            'datakelompok' => $this->m_lahan->getdatakelompok(),
            'title' => 'Tambah Data Tanah',
            'lahan' => $this->m_lahan->get_all_data(),
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tanah/v_add', $data);
        $this->load->view('templates/footer');
    }

    //Update one item
    public function edit($id_lahan)
    {

        $this->form_validation->set_rules(
            'pengguna',
            'Pengguna',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'hak',
            'Hak',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'no',
            'No',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'tglhak',
            'Tanggal Hak',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'luas',
            'Luas',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'nilai',
            'Nilai',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'asal',
            'Asal Tanah',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'jenis',
            'Jenis Tanah',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'dinas',
            'Asal Dinas',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'status',
            'Status',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'denah_geojson',
            'Denah GeoJson',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );
        $this->form_validation->set_rules(
            'warna',
            'Warna',
            'required',
            array('required' => '%s Harus Diisi!!!')
        );

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path']          = './gambar/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2000;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $data = array(
                    'title' => 'Data Tanah',
                    'error_upload' => $this->upload->display_errors(),
                    'lahan' => $this->m_lahan->detail($id_lahan),
                    'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()
                );
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('tanah/v_edit', $data);
                $this->load->view('templates/footer');
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_lahan' => $id_lahan,
                    'pengguna' => $this->input->post('pengguna'),
                    'alamat' => $this->input->post('alamat'),
                    'hak' => $this->input->post('hak'),
                    'no' => $this->input->post('no'),
                    'tglhak' => $this->input->post('tglhak'),
                    'luas' => $this->input->post('luas'),
                    'nilai' => $this->input->post('nilai'),
                    'asal' => $this->input->post('asal'),
                    'jenis' => $this->input->post('jenis'),
                    'dinas' => $this->input->post('dinas'),
                    'status' => $this->input->post('status'),
                    'keterangan' => $this->input->post('keterangan'),
                    'denah_geojson' => $this->input->post('denah_geojson'),
                    'warna' => $this->input->post('warna'),
                    'gambar' => $upload_data['uploads']['file_name']
                );
                $this->m_lahan->edit($data);
                $this->session->set_flashdata('sukses', 'Data berhasil diedit');
                redirect('dtanah');
            }
            $data = array(
                'id_lahan' => $id_lahan,
                'pengguna' => $this->input->post('pengguna'),
                'alamat' => $this->input->post('alamat'),
                'hak' => $this->input->post('hak'),
                'no' => $this->input->post('no'),
                'tglhak' => $this->input->post('tglhak'),
                'luas' => $this->input->post('luas'),
                'nilai' => $this->input->post('nilai'),
                'asal' => $this->input->post('asal'),
                'jenis' => $this->input->post('jenis'),
                'dinas' => $this->input->post('dinas'),
                'status' => $this->input->post('status'),
                'keterangan' => $this->input->post('keterangan'),
                'denah_geojson' => $this->input->post('denah_geojson'),
                'warna' => $this->input->post('warna'),
            );
            $this->m_lahan->edit($data);
            $this->session->set_flashdata('sukses', 'Data berhasil diedit');
            redirect('dtanah');
        }
        $data = array(
            'title' => 'Edit Data Tanah',
            'lahan' => $this->m_lahan->detail($id_lahan),
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tanah/v_edit', $data);
        $this->load->view('templates/footer');
    }

    //Delete one item
    public function delete($id_lahan)
    {
        $data = array('id_lahan' => $id_lahan);
        $this->m_lahan->delete($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect('dtanah');
    }

    //Export Data To PDF
    public function pdf()
    {

        $data['lahan'] = $this->m_lahan->get_all_data();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'Potrait');
        $this->pdf->filename = "Laporan-Data-Lahan.pdf";
        $this->pdf->load_view('pdf/pdf_lahan', $data);
    }

    public function get_jenis_tanah()
    {
        if (isset($_GET['term'])) {
            $result = $this->m_lahan->auto_jenis_tanah($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->uraian;
                echo json_encode($arr_result);
            }
        }
    }
    /* public function galleri()
    {
        $data = array(
            'title' => 'Foto Lokasi',
            'galleri' => $this->m_lahan->get_all_foto(),
            'isi' => 'tanah/v_galleri'
        );
        $this->load->view('layout/v_wrapper', $data, FALSE);
    }
}

/* End of file Controllername.php */
}
