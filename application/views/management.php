<?php
$queryAd = $this->db->query('SELECT * FROM anuncio');
$queryUsers = $this->db->query('SELECT * FROM usuario');


$CI =& get_instance();
if($_POST){
    $a = new stdClass();
    $a->id = $_POST['id'];
    $sql = "delete from anuncio where id = ?";
    
    $rs = $CI->db->query($sql, array($u->id));
}

?>


  <h1 class="text-center">Actualmente hay: <?php echo $queryAd->num_rows(); ?> anuncios registrados</h1>
  <h1 class="text-center">Actualmente hay: <?php echo $queryUsers->num_rows(); ?> usuarios registrados</h1>

  <div class="jumbotron jb-reduced-ad">
    <legend>
      <h2>Bloquear usuario</h2></legend>
    <div class="row">
      <div class="col-sm-12">
        <form class="form-horizontal" action="" method="post">
          <div class="form-group input-group">
            <label for="email" class="input-group-addon bg-green">Correo</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-green" id="btn_block">Bloquear</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="jumbotron jb-reduced-ad">
    <legend>
      <h2>Bloquear anuncios</h2></legend>
    <div class="row">
      <div class="col-sm-12">
        <form class="form-horizontal" action="" method="post">
          <div class="form-group input-group">
            <label for="id" class="input-group-addon bg-green">ID del anuncio</label>
            <input type="number" name="id" class="form-control" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-green" id="btn_block">Bloquear</button>
          </div>
        </form>
      </div>
    </div>
  </div>