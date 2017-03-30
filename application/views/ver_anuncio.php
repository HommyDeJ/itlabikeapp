<?php

$CI =& get_instance();
$sql = "select * from anuncio where id = ?";
$rs = $CI->db->query($sql, array($id));
$rs = $rs->result();

$anuncio = $rs[0];

$CI2 =& get_instance();
$sql2 = "select * from images where idAd = ?";
$rs2 = $CI2->db->query($sql2, array($id));
$rs2 = $rs2->result();

$image = $rs2;

$path = base_url('')."bikeImages/";
$categoria = getCategoriaById($anuncio->idCate);
$user = getUsuariosById($anuncio->idUser);
?>

<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1><?php echo $anuncio->titulo ?></h1>
      </div>
        <div id="imageSliding" class="panel-body"> 

        </div>
        <div class="panel-footer">
          <h3>Vendedor: <?php echo $user->nombre?></h3>
          <h3>Precio: <?php echo $anuncio->precio?> $USD</h3>
          <h3>Categoria: <?php echo $categoria->categoria?></h3>
          <h3>Descripcion: <?php echo $anuncio->descripcion?></h3>
          <h3>
        </div>
  </div>
  </div>
</div>

  <script>
    //This script will allow me to make some sort of slideshow with the images
    var path = '<?php echo base_url("")?>';
    var image;
    var i = 0;
    function loadData(){
        image = JSON.parse('<?php echo json_encode($image);?>');
       showImage();
    }
    function showImage(){
      if( i == image.length){
        i = 0;
        setTimeout(showImage,0);
      }
      else{
        $("#imageSliding").html("<img src='"+path+"bikeImages/"+image[i].imgContent+"' class='img-responsive'/>").show(0,dissappearImage);
      }
    }

    function dissappearImage(){
      $("#imageSliding").fadeOut(6000);
      i++;
      setTimeout(showImage,5000);
    }

   $(document).ready(loadData);
  </script>
