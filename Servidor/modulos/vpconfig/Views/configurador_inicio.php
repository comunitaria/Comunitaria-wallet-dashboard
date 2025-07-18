<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vestigia Portal - Configuracion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <?= inserta_enlaces($enlaces) ?>

</head>
<body class="hold-transition sidebar-mini layout-fixed bg-dark">
<?= barraNavegacion($menuNav,$componentesNav) ?>
<aside class="main-sidebar sidebar-dark-dark elevation-4">

    <?= encabezado('vpconf',base_url('public/assets/imagenes').'/logo_vst chico.png','VstPortal') ?>
    <?= sidebar($menuConf) ?>

</aside>
<div class="content-wrapper  bg-dark">
    <section class="content">
        <div class="container-fluid">
            <?= form_open('vpconf') ?>
                    <div class="mb-3">
                    <label for="ipTituloWeb" class="form-label">Título de la página:</label>
                        <input type="text" class="form-control" id="ipTituloWeb" name="tituloWeb" value="<?= env('Config\VstPortal.tituloWeb') ?>">
                    </div>
                    <div class="mb-3">
                    <label for="ipNombreCliente" class="form-label">Nombre del cliente:</label>
                        <input type="text" class="form-control" id="ipNombreCliente" name="nombreCliente" value="<?= env('Config\VstPortal.nombreCliente') ?>">
                    </div>
                    <label for="ipContenidoPie" class="form-label">HTML del pie:</label>
                        <input type="text" class="form-control" id="ipContenidoPie" name="contenidoPie" value="<?= htmlspecialchars(env('Config\VstPortal.contenidoPie')) ?>">
                    </div>
                    <button id="btReconfigurar" type="submit" class="btn btn-primary mt-4">Grabar configuración</button>    
            <?= form_close() ?>
        </div>
</section>
</div>


</body>
</html>
