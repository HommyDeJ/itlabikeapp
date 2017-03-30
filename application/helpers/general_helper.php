<?php
//This method will help me get ads by user
function getadByUser($userId){
  $CI =& get_instance();
  $sql = "select * from anuncio where idUser = ?";
  $rs = $CI->db->query($sql,array($userId));
  return $rs->result();
}
// This will help me get the id of the current category
function getCategoriaByName($categoria){
  $CI =& get_instance();
  $sql = "select * from categoria where categoria = ?";
  $rs = $CI->db->query($sql,array($categoria));
  $rs = $rs->result();
  return $rs[0];
}
//this will help me get all the categories
function getAllCategorias(){
   $CI =& get_instance();
  $sql = "select * from categoria";
  $rs = $CI->db->query($sql);
  return $rs->result();
}
//Here i get the adds by its category
function getAdByCategoria($idCate){
$CI =& get_instance();
  $sql = "select * from anuncio where idCate = ?";
  $rs = $CI->db->query($sql,array($idCate));
  return $rs->result();
}
//Added this function to get the user
function getUsuariosById($id){
   $CI =& get_instance();
  $sql = "select * from usuario where id = ?";
  $rs = $CI->db->query($sql,array($id));
  $rs = $rs->result();
  $result = $rs[0];
  return $result;

}
//This will retrieve all photos by advertisement
function getPhotosByAd($idAnuncio){
    $CI =& get_instance();
    $sql = "select * from images where idAd = ?";
    $rs = $CI->db->query($sql,array($idAnuncio));
    $rs = $rs->result();
    $result = $rs[0];
    return $result;
}
//Method to load all the ads
function cargar_anuncios(){
    $CI =& get_instance();
    $sql = "select * from anuncio";
    $rs = $CI->db->query($sql);
    return $rs->result();
}
//Method to get categories by Id
function getCategoriaById($idCate){
  
  $CI =& get_instance();
  $sql = "select * from categoria where id = ?";
  $rs = $CI->db->query($sql,array($idCate));
  $rs = $rs->result();
  return $rs[0];
}
 ?>
