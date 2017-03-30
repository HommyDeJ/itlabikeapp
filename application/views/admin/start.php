<?php
$currentUser = $_SESSION['itla_bike_user'];
$anuncios = getadByUser($currentUser->id);

?>

  <div class="text-right">
    <p>Usted está conectado como
      <?php echo $currentUser->correo ?> <a href="<?php echo base_url('admin/logout')?>"> Salir</a></p>
  </div>

  <div class="container-fluid">

    <div class="row">

      <div class="col-sm-4">
        <div class="panel panel-default bs-shad-user">
          <div class="panel-heading">
            <h2>Información del Usuario</h2>
          </div>
          <div class="panel-body">
            <p>Email:
              <?php echo $currentUser->correo ?>
            </p>
            <p>Nombre:
              <?php echo $currentUser->nombre ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-sm-offset-2">
        <h3>Anuncios registrados</h3>
        <div class="scroll-div bs-shad-user">
          <table class="table">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Descripcion</th>
              </tr>
            </thead>
            <tbody>
              <?php
if(!empty($anuncios)){
    foreach ($anuncios as $adVer) {
      $categoria = getCategoriaById($adVer->idCate);
        echo "<tr>
        <td>{$adVer->id}</td>
        <td>{$adVer->titulo}</td>
        <td>{$categoria->categoria}</td>
        <td>{$adVer->precio}$</td>
        <td>{$adVer->descripcion}</td>
        </tr>";
    }
}
else{
    echo "<h1> No hay anuncios registrados para este usuario</h1>";
}
?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>