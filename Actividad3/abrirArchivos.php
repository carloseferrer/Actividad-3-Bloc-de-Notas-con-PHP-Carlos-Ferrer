<?php

ob_start();

    if(isset($_GET['note']) && isset($_GET['dir'])){
        $nota = $_GET['note'];
        $dir = $_GET['dir'];
        $checkfile = "./assets/directorios/" .$dir ."/" . $nota;

        if(file_exists($checkfile)){

            // Obtenemos el valor del archivo 
            $file_contents = file_get_contents("./assets/directorios/" .$dir ."/" . $nota);
            // echo("<span> $file_contents <span/>");
        } else{
            header("location: directorios.php?dir=$dir");           
        }

    } else {
        header("Location: index.php");
    }




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivo: <?php echo($nota);?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="./assets/css/styles2.css">
</head>
<body>
<nav class="navbar bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
      <a class="navbar-brand order-md-last link-nav " style="color:#fff;" href="directorios.php?dir=<?php echo $dir ?>" >
        <img src="./assets/img/navimg3.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Volver al directorio
      </a>
      <span class="navbar-brand mb-0 h1 " style="color:#fff; cursor:default;">Estas en el archivo  <i class="fa-solid fa-folder-open " style="color:#fb8500;;"> </i> <?php echo("<span>/$nota<span/>") ?></span>
  </div>
</nav>
<div class="container-fluid justify-content-center">
    <br>
    <p class="text-center mb-0 h5 p-2 info-p">Informacion del Archivo</p>
    <form action="abrirArchivos.php?note=<?php echo $nota ?>&dir=<?php echo $dir ?>" method="post">
        <div class="textarea-p">
            <input type="text" name="file_name" hidden value="<?php echo($nota);?>"> <!-- Nombre del archivo -->
            <textarea class="form-control" id="floatingTextarea2" style="height: 400px;" required="true" name="file_contents"><?php echo($file_contents); ?></textarea>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto p-3">
            <input class="btn btn-info" name="btnguardar" type="submit" value="Guardar">
            
        </div>
    </form>
</div>

<?php

    if(isset($_POST['btnguardar'])){
        if(isset($_POST['file_contents']) && !empty($_POST['file_contents'])){
            $newfile_contents = $_POST['file_contents'];
            file_put_contents("./assets/directorios/" .$dir ."/" . $nota, $_POST['file_contents']);
            echo("el cambio se ha realizado");
            header("location: directorios.php?dir=$dir");
            ob_end_flush();
            
        } 
    } 

?>
</body>
</html>