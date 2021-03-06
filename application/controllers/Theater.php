<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Theater extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();  
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Theater';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['ruangan'] = $this->db->get('theater')->result_array();

       /** $this->form_validation->set_rules('judul', 'Judul', 'required');**/

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('theater/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('movie', ['judul' => $this->input->post('movie')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New movie added!</div>');
            redirect('theater');
        }
    }
}