<?php
$categorias = getAllCategorias();
?>
<div id="catRow" class="row">
   
</div>

<script type="text/javascript">
    var cate;
     function startVariable(){
        cate = JSON.parse('<?php echo json_encode($categorias); ?>');
        relativePath = '<?php echo base_url("")?>';
        showCategories();
     }
     //This code is to show all the categories stored in the database
     function showCategories(){
         for(var i = 0; i < cate.length; i++){
                $("#catRow").hide().append("\
                <div class='col-sm-4'>\
                 <a href='"+relativePath+"start/ver_categoria/"+cate[i].id+"' class='text-muted'>\
                <div class='panel panel-default bs-shad-user'>\
                <div class='panel-heading'><h1>"+
                cate[i].categoria+"</h1></div>\
                <div class='panel-body'>\
                <img src='"+relativePath+'bikeImages/'+cate[i].imgContent+"' class='img-responsive'/>\
                </div>\
                <div class='panel-footer'>\
                <p>"+cate[i].descripcion+"</p>\
                </div>\
                </div></a>\
                </div>").fadeIn(2000);
                
            
         }
     }

    
    $(document).ready(startVariable);
</script>
