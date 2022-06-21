<?php
if ($res){
$data=mysqli_fetch_array($res);
}
 ?>
 <div class="container" style="border-style: solid; border-radius: 10px; margin-top: 5%; margin-bottom: 5%">
   <p >
     Datos no fueron procesados correctamente
     <?php
       for ($i=0; $i<count($_SESSION['errores'][0]) ; $i++){
         echo "<br> - ".$_SESSION['errores'][0][$i];
       }
      ?>
   </p>

 </div>
