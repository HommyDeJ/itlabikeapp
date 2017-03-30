<!--In this view you can see all info about the categories-->
<div class="row">
    

<?php 
$url = base_url('');
$anuncio = getAdByCategoria($id);
$categoria = getCategoriaById($id);
echo "<h1> Anuncios para la categoria de {$categoria->categoria}";
foreach($anuncio as $ad){
$fotos = getPhotosByAd($ad->id);

$user = getUsuariosById($ad->idUser);
        $path = base_url('')."bikeImages/";
        $content = $fotos->imgContent;
        $fullPath= $path . $content;

    echo "<div class='row'>
    <div class='col-sm-6 col-sm-offset-3'>
    <a href='{$url}start/ver_anuncio/{$ad->id}'>
      <div class='thumbnail bs-shad-user'>
        <img src='{$fullPath}' alt='foto' class='img-responsive'/>
        <div class='caption'>
          <p>Publicante: {$user->nombre}</p>
          <p>Titulo Anuncio: {$ad->titulo}</p>
        </div>
      </div></a>

    </div>
    </div>
    ";
}

?>
</div>