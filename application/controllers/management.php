<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }
    
    function index()
    {
        $this->load->view('templates/top');
        $this->load->view('management');
        $this->load->view('templates/footer');
    }
}