<?php
// The following lines check if the user exists in the database.
$this->load->database();
$message = "";

if($_POST){
    $sql = "select * from usuario where correo = ? and clave = ?";
    $sql2 = "select * from usuario where correo = ? and bloqueado = 1";
    
    $CI =& get_instance();
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    $rs = $CI->db->query($sql, array($email, $password));
    $rs2 = $CI->db->query($sql2, array($email));
    
    $rs = $rs->result();
    $rs2 = $rs2->result();
    
    // The user exists in the database
    
    if(count($rs) > 0){
        
        // The user is blocked in the database
        if(count($rs2) > 0){
            $message = "Usuario bloqueado";
            
        } else {
            $_SESSION['itla_bike_user'] = $rs[0];
            //I redirect this to admin because if it is set it is better to show the start page
            // in this view you should be able to see all the info of the user
            redirect('admin');
            // The user does not exist in the database
        }
    } else {
        $message = "Usuario o contraseña no válida";
    }
}

?>

  <!-- This view is for logging in -->
  <div class="row" id="input_login">
    <div class="col col-sm-6">
      <div class="jumbotron redcd_jb">
        <h2>Ingresa en tu cuenta</h2>
        <form action="" method="post" class="form-horizontal" id="form_login">
          <div class="form-group input-group">
            <label for="email" class="input-group-addon bg-green"><i class="fa fa-envelope"></i> Email:</label>
            <input type="email" class="form-control" name="email" required placeholder="user@example.com" />
          </div>
          <div class="form-group input-group">
            <label for="pass" class="input-group-addon bg-green"><i class="fa fa-key"></i> contraseña:</label>
            <input type="password" class="form-control" name="pass" required/>
          </div>
          <div style="color:red">
            <?php echo $message; ?>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-success">Ingresar</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Redirect to register -->
    <div class="col col-sm-6">
      <div class="jumbotron redcd_jb">
        <h1>¿No tiene cuenta?</h1>
        <div class="row">
          <div class="col-sm-12">
            <a href="<?php echo base_url('register') ?>" class="btn btn-info"><i class="fa fa-sign-in"></i> Registrarse</a>
          </div>
        </div>
      </div>
    </div>
  </div>