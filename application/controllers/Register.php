<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {



        // Check if user is logged in
        if ($this->facebook->is_authenticated())
        {
            // User logged in, get user details
            $user = $this->facebook->request('get', '/me?fields=id,name,last_name,gender,email, picture');

            $CI =& get_instance();
            $f = new stdClass();
            $f->nombre = $user['name'];
            $f->correo = $user['email'];
            //Add a default password for the user
            $f->clave = md5('123');

            // Check if the user exist in the database, if it does not exist add it
            $sql = "select * from usuario where correo = ?";
            $CI =& get_instance();
            $email = $user['email'];
            $rs = $CI->db->query($sql, array($email));
            $rs = $rs->result();

            // The user exists in the database
            if(count($rs) > 0){
                // The user does not exist in the database
                //Here i set the variable $_SESSION
                $_SESSION['itla_bike_user'] = $rs[0];
            } else {
                $CI->db->insert('usuario',$f);
            }

            if (!isset($user['error']))
            {
                $data['user'] = $user;
            }
        }
        //The first and third line imports the templates
        // which are in the templates folder under views.
        // the middle one is to render the view you want to see.
        $this->load->view('templates/top');
        $this->load->view("admin/register");
        $this->load->view('templates/footer');

    }
  }
