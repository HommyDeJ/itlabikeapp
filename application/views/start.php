<h1>Últimos Anuncios</h1>
<!-- This is the main page -->
<div class="row">

  <?php
$url = base_url('');




$anuncios = cargar_anuncios();


foreach($anuncios as $anuncio){
$fotos = getPhotosByAd($anuncio->id);

$user = getUsuariosById($anuncio->idUser);
        $path = base_url('')."bikeImages/";
        $content = $fotos->imgContent;

        $fullPath= $path . $content;

    echo "<div class='row'>
    <div class='col-sm-6 col-sm-offset-3'>
    <a href='{$url}start/ver_anuncio/{$anuncio->id}'>
      <div class='thumbnail bs-shad-user'>
        <img src='{$fullPath}' alt='foto' class='img-responsive'/>
        <div class='caption'>
          <p>Publicante: {$user->nombre}</p>
          <p>Titulo Anuncio: {$anuncio->titulo}</p>
        </div>
      </div></a>

    </div>
    </div>
    ";
}



?>

</div>
