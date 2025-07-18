<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vestigia Portal - Configuracion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('public/assets/imagenes','https') ?>/confFavicon.png">
    <?= inserta_enlaces($enlaces) ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed bg-dark">
    <div class="wrapper">
    <?= barraNavegacion($menuNav,$componentesNav) ?>
    <aside class="main-sidebar sidebar-dark-dark elevation-4">

        <?= encabezado('vpconf',base_url('public/assets/imagenes').'/logo_vst chico.png','VstPortal') ?>
        <?= sidebar($menuConf) ?>

    </aside>
    <div class="content-wrapper text-dark">
        <section class="content mt-5">
            <div class="container-fluid">
                       <?= $texto ?>
            </div>
    </section>
    </div>
    </div>
<script>
    $(document).ready(function(){
  });
</script>
</body>
</html>