<?php 

    if(isset($_GET['dir'])){
        $dir = $_GET['dir']; //Obtenemos el nombre del directorio

        // Creamos el archivo
        if(isset($_POST['btnarchivo'])){
            if(isset($_POST['nombreArchivo']) && !empty($_POST['nombreArchivo']) && isset($_POST['textoarchivo']) && !empty($_POST['textoarchivo'])){

                $nombreArchivo = $_POST['nombreArchivo'];
                $dir = $_POST['dir'];
                $textoarchivo = $_POST['textoarchivo'];
                $directorioArchivo = "./assets/directorios/$dir/$nombreArchivo.txt";

                if(file_exists($directorioArchivo)){
                    //echo ("Este archivo ya existe");
                }
                else{
                    
                    // echo('Archivo creado satisfactoriamente con la direccion:' .$directorioArchivo);
                    $fp = fopen($directorioArchivo, "a");
                    fputs($fp, $textoarchivo);
                    fclose($fp);

                }
    
            }

        } 

        unset($_POST['btnarchivo']);
        unset($_POST['nombreArchivo']);
    } else {
        header("Location: index.php");
    }

   




    //echo("<h2> El directorio accedido es $dir <h2/>");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio: <?php echo($dir);?></title>
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
      <a class="navbar-brand order-md-last link-nav " style="color:#fff;" href="index.php" >
        <img src="./assets/img/navimg.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Inicio
      </a>
      <span class="navbar-brand mb-0 h1 " style="color:#fff; cursor:default;">Estas en el directorio  <i class="fa-solid fa-folder-open " style="color:#fb8500;;"> </i> <?php echo("<span>/$dir<span/>") ?></span>
  </div>
</nav>

<div class="container p-5" >
    <p class="text-center mb-0 h4 p-3">Si deseas abrir el Bloc de notas presiona el boton "Desplegar Bloc"</p>
    <div class="d-grid gap-2 col-6 mx-auto p-3">     
        <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Desplegar Bloc
        </button>
    </div>


    
    
    <div class="collapse" id="collapseExample">
        <div class="container-fluid justify-content-center">
        <p class="text-center mb-0 h5 p-2">Escribe el nombre del archivo</p>
            <form action="directorios.php?dir=<?php echo $dir ?>" method="post">
                <div class="input-p">
                    <input type="text" class="form-control" style="margin:auto;" placeholder="Ejemplo: MiArchivo2" name="nombreArchivo" aria-label="default input example" required="true">
                </div>            
                <div class="textarea-p">
                    <textarea class="form-control" placeholder="Escribe lo que quieras" id="floatingTextarea2" style="height: 300px;" required="true" name="textoarchivo"></textarea>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto p-3">
                    <input class="btn btn-info" name="btnarchivo" type="submit" value="Crear">
                </div>
                <input type="hidden" name="dir" value="<?php echo $dir ?>"> <!-- Para enviar el directorio -->
            </form>
        </div>
    </div>


    <!-- Mostramos los archivos que se encuentren disponibles, en caso que  -->
    <div class="row row-cols-3 g-3">
    
    <?php

$directorio = "./assets/directorios/" . $dir;
$direc  = scandir($directorio);
if(file_exists($directorio)){
if (count($direc) > 2) {
    foreach ($direc as $valor) {
        if ('.' !== $valor && '..' !== $valor) {

            $file = "./assets/directorios/" . $dir . "/" . $valor;

            if (filesize($file) > 0) {
                $contents = file_get_contents($file, FILE_USE_INCLUDE_PATH);
            }else {
                $contents = 'No hay contenido aun';
            }

?>

                <div class="col">
                    <div class="containercarta" style="padding-top:20px;">
                        <div class="card border-info mb-3" style="max-width: 18rem;">
                        <div class="card-header">Datos del Archivo</div>
                        <div class="card-body">
                            <h6 class="card-subtitle">Nombre: <?php echo rtrim($valor, '(.txt)') ?>.txt</h6>
                            <hr>
                            <p class="card-text">Texto: <?php echo substr($contents, 0, 20); ?>...</p>
                            <hr>
                            <h6 class="card-subtitle mb-2">Caracteres: <?php echo filesize($file) ?></h6>
                            <hr>
                            <p class="card-text"><b>Ultimo Cambio: <?php date_default_timezone_set('America/Caracas'); echo(date("d-m-Y", filemtime($file)));?></b></p>
                            <hr>
                             <p class="card-text"><b>Tamaño: <?php $estadísticas = stat($file); echo($estadísticas['size']) ?> Bytes</b></p>
                            <a href="abrirArchivos.php?note=<?php echo $valor ?>&dir=<?php echo $dir ?>" class="card-link hover-a">Abrir </a>
                        </div>
                    </div>
                    </div>
            </div>
<?php

            
        }
    }

}

} else {
    echo("<span> No existe el archivo </span>");
}

?>
    </div>

</div>
</body>
</html>




