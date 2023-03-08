<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 3 - Bloc de Notas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body>
   
<nav class="navbar navbar-dark bg-dark ">
    <div class="container-fluid justify-content-center">
        <span class="navbar-brand mb-0 h1">Actividad #3 - Carlos Ferrer</span>
    </div>
</nav>

<div class="container p-2" >
    <p class="text-center mb-0 h2 p-3">Bienvenido al Sistema de Bloc de Notas Web</p>
    <div class="form-directory">
        <p class="text-center mb-0 h4 p-3">Por favor, escribe el nombre del Directorio donde trabajaras</p>
        <form class="d-flex justify-content-center form-personalization" action="index.php" method="post">
        <input class="form-control " name="nombreDirectorio" type="text" placeholder="Ejemplo: Mi repositorio1" aria-label="default input example" required='true'>
        <input class="form-control" value = "Crear Directorio" name="btndirectorio" type="submit" aria-label="default input example">
        </form>
    </div>
</div>


<?php 


    if(isset($_POST['btndirectorio'])){
        if(isset($_POST['nombreDirectorio']) && !empty($_POST['nombreDirectorio'])){

            // Obtenemos el nombre del directorio a crear

            $nombreDirectorio = $_POST['nombreDirectorio'];
            $condicion = false;
            if(!file_exists("./assets/directorios/$nombreDirectorio")){

                if(!is_dir("./assets/directorios/$nombreDirectorio")){
                    mkdir("./assets/directorios/$nombreDirectorio"); 
                    // echo('El directorio ha sido creado con el nombre: '.$nombreDirectorio. ' ha sido creado correctamente en la direccion: C:\xampp\htdocs\Actividad3\assets\directorios/'.$nombreDirectorio);

                    echo '<script type="text/javascript">
               $(document).ready(function() {
                   setTimeout(function() {
                       $(".success").fadeOut(1500);
                   },3000);
               });
               </script>';

               echo("<div class='container text-center success' style='margin-top:30px;'>
               <div class='alert alert-success' role='alert' style='padding-bottom: -20px;'>
               El directorio ha sido creado correctamente !
             </div>
            </div>");
                    
                } else {
                    // $msg_error = 'El directorio ya existe';
                    // echo('<h3 $msg_error <h3/>');
                }
            } else{

               // echo('El directorio ya existe');

               echo '<script type="text/javascript">
               $(document).ready(function() {
                   setTimeout(function() {
                       $(".alert").fadeOut(1500);
                   },3000);
               });
               </script>';

               echo("<div class='container text-center alert' style='margin-top:30px;'>
               <div class='alert alert-danger' role='alert' style='padding-bottom: -20px;'>
               El directorio ya existe !
             </div>
            </div>");

        
            }


        }
    } 
    

    unset($_POST['btndirectorio']);
    unset($_POST['nombreDirectorio']);

?>


</div>



    <div class="directory-files">




    <?php
    try {

        $dir = './assets/directorios';
        $dirs  = scandir($dir);

    

        // Mostramos los directorios que han sido creados
        foreach ($dirs as $direc) {
            if ('.' !== $direc && '..' !== $direc) {

    ?>

    

                <!-- Mostramos los directorios a traves del foreach -->
                <ul class="list-group" style="padding-top:20px;">
                    <li class="list-group-item hover-item">
                        <h5 class="card-title"> <i class="fa-solid fa-folder changecolor"></i>  <b><?php echo " $direc "?>  </b>  </h5> <a href="directorios.php?dir=<?php echo $direc ?>" class="link-css">Abrir Directorio</a> <!-- Accedemos al  -->
                    </li>
                </ul>

    <?php
            }
        }
    } catch (Exception $e) {
        echo 'Se ha encontrado un error: ',  $e->getMessage(), "\n\n";
    }
    ?>


    
</div>

</body>
</html>