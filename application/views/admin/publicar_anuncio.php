<!-- In this view we will register the adds -->
<?php
//This will catch who is the current user
$currentUser = $_SESSION['itla_bike_user'];
$CI =& get_instance();
$message = "";
if($_POST){
    //var_dump($_FILES['photo_ad']);
    $ad = new stdClass();
    $ph = new stdClass();
    $ad->titulo = $_POST['titulo'];
    $categoria = $_POST['categoria'];
    //This method will retrieve the category
    $categoria = getCategoriaByName($categoria);
    $photo = $_FILES['photo_ad'];
    $imgPath = $_SERVER['DOCUMENT_ROOT']."/itlaBike/bikeImages/";
    $ad->precio = $_POST['precio'];
    $ad->descripcion = $_POST['descripcion'];
    $ad->idUser = $currentUser->id;
    $ad->idCate = $categoria->id;
    $sql = "select * from anuncio where titulo = ?";
    //Check if the add already exists..
    $rs = $CI->db->query($sql, array($ad->titulo));
    $rs = $rs->result();
    if(count($rs) > 0){
        $message = "este anuncio ya existe con ese titulo";
    }
    else{
        //Here i verify if the photos are empty
        if(!empty($photo)){
            $CI->db->insert('anuncio',$ad);
            $last_id = $this->db->insert_id();
            //Get the last inserted id
            $ph->idAd = $last_id;
            for($i =0; $i < count($photo['name']);$i++) {
                //Here i verify if it is a file and if it is an image
                if($photo["error"][$i] == 0 && ($photo['type'][$i] == 'image/jpeg' || $photo['type'][$i] == 'image/png' )){
                    $ph->imgContent = $photo['name'][$i];
                    $CI->db->insert('images',$ph);
                    move_uploaded_file($photo['tmp_name'][$i],"$imgPath"."$ph->imgContent");
                }
                //Here i show in case it is not an image of the specified format
                else{
                    $message = "La foto no es png o jpeg intente denuevo";
                    $CI->db->where("id",$last_id);
                    $CI->db->delete("anuncio");
                }
            }

        }
        else{
            $message = "Los archivos estan vacios";
        }
    }
}
?>

  <div class="text-right">
    <!-- This will show me an option to logout from the system -->
    <p>Esta conectado como
      <?php echo $currentUser->correo ?> <a href="<?php echo base_url('admin/logout') ?>"> Salir</a></p>
  </div>
  <div class="jumbotron jb-reduced-ad">
    <legend>
      <h2>Publique su anuncio</h2></legend>
    <div class="row">
      <div class="col-sm-12">
        <form class="form-horizontal" enctype="multipart/form-data" action="" method="post">
          <div class="form-group input-group">
            <label for="titulo" class="input-group-addon bg-green"><i class="fa fa-header"></i> Titulo</label>
            <input type="text" name="titulo" class="form-control" required>
          </div>
          <div class="form-group input-group">
            <label for="categoria" class="input-group-addon bg-green"><i class="fa fa-bars"></i> Categoria</label>
            <select class="form-control" name="categoria" required>
              <option value="" disabled selected="">Escoja una categoria</option>
              <?php 
              $cate = getAllCategorias();
              foreach ($cate as $ct) {
                echo "<option value='{$ct->categoria}'>{$ct->categoria}</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group input-group">
            <label for="photo_ad[]" class="input-group-addon bg-green"><i class="fa fa-camera"></i> Foto max 5</label>
            <input type="file" name="photo_ad[]" class="form-control" accept="image/*" multiple="true" id="photo_file" required>
          </div>

          <div id="message" class="alert alert-danger" style="display:none;">

          </div>
          <div class="form-group input-group">
            <label for="precio" class="input-group-addon bg-green"><i class="fa fa-usd"></i> Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
          </div>
          <div class="form-group input-group">
            <label for="descripcion" class="input-group-addon bg-green"><i class="fa fa-comment"></i> Descripcion</label>
            <textarea name="descripcion" rows="4" cols="80" class="form-control" required></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-green" id="btn_publish"><i class="fa fa-paper-plane-o"></i> Publicar</button>
          </div>
        </form>
      </div>
    </div>
    <div id="messagePhp" class="alert alert-danger" style="display:none;">
      <?php echo $message ?>
        <script type="text/javascript">
          $(document).ready(initMessage);

          function initMessage() {
            //This will retrieve my variable from php verifying that is not empty
            var message = '<?php echo (isset($message)?$message:'
            ') ?>';
            if (message != '') {
              $("#messagePhp").show(0, messageAppend).addClass('alert-dismissable fade in');
            } else {
              $("#messagePhp").hide();
            }

          }
          //function to append the desired message
          function messageAppend() {
            $(message).appendTo('#messagePhp').fadeIn(5000, closeMessage).addClass("animated bounce");
          }

          function closeMessage() {
            var close = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            $(close).appendTo('#messagePhp').fadeIn(5000);
          }
        </script>
    </div>
  </div>

  <script src="<?php echo base_url('') ?>js/verifyImageQuantity.js" charset="utf-8"></script>
