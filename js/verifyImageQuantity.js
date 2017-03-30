var photo = document.getElementById('photo_file');
//This function will verify if the user is entering in fact 5 images or less
$(photo).change(function() {
  if(this.files.length > 5){
      $('#message').show(0,messageAppend).addClass('alert-dismissable fade in');
  }
});
function messageAppend(){
  $("<p>Solo se permiten un máximo  de 5 imágenes</p>").appendTo("#message").fadeIn(3000,closeAppear);
}
function closeAppear(){
 var close = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
   $(close).appendTo('#message').fadeIn(3000);
}
//This will verify in case it is bigger to don't post it
$('form').submit(function () {
  if(photo.files.length > 5) {
    alert('El límite de imágenes es 5');
    return false;
  }

});
