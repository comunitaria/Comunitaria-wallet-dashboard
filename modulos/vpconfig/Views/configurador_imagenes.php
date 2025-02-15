<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vestigia Portal - Configuracion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('public/assets/imagenes','https') ?>/confFavicon.png">
    <?= inserta_enlaces($enlaces) ?>
<style>
    .imagenConfig:hover{
        cursor: pointer;
        box-shadow: 0px 0px 15px yellow;
    }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed bg-dark">
<?= barraNavegacion($menuNav,$componentesNav) ?>
<aside class="main-sidebar sidebar-dark-dark elevation-4">

    <?= encabezado('vpconf',base_url('public/assets/imagenes').'/logo_vst chico.png','VstPortal') ?>
    <?= sidebar($menuConf) ?>

</aside>
<div class="content-wrapper  bg-dark">
    <section class="content mt-5">
        <div class="container-fluid">
            <?= form_open_multipart('vpconf/imagenes') ?>
                <div class="mb-3 row">
                    <div class="col-sm-1"></div>
                    <div class="text-right col-sm-3">
                        <div>Favicon:</div>
                        <small>Formato PNG, cuadrado, 48x48, 96x96,... <br/>(múltiplo de 48)</small>
                    </div>
                    <div class="col"><img id="imgFavicon" class="imagenConfig" src="<?= base_url('public/assets/imagenes','https') ?>/confFavicon.png" style="width:130px"></div>
                    <input type="file" class="form-control" id="ipFavicon" name="confFavicon" hidden>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-1"></div>
                    <div class="text-right col-sm-3">
                        <div>Fondo página Login:</div>
                        <small>Formato PNG, cualquier tamaño, un tono uniforme o brumoso</small>
                    </div>
                    <div class="col"><img id="imgBGLogin" class="imagenConfig" src="<?= base_url('public/assets/imagenes','https') ?>/bg_login.png" style="width:330px"></div>
                    <input type="file" class="form-control" id="ipBGLogin" name="bg_login" hidden>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-1"></div>
                    <div class="text-right col-sm-3">
                        <div>Logotipo:</div>
                        <small>Formato PNG, cuadrado, que contraste el fondo con el del menú lateral, tamaño recomendado 128x128</small>
                    </div>
                    <div class="col"><img id="imgLogo" class="imagenConfig" src="<?= base_url('public/assets/imagenes','https') ?>/logotipo<?= $VPConf->UAT?"UAT":""?>.png" style="width:128px"></div>
                    <input type="file" class="form-control" id="ipLogo" name="logotipo<?= $VPConf->UAT?"UAT":""?>" hidden>
                </div>
                <button id="btReconfigurar" type="submit" class="btn btn-primary mt-4">Grabar configuración</button>    
            <?= form_close() ?>
        </div>
</section>
</div>

<script>
    $(document).ready(function(){
        $(".imagenConfig").click(function(){
            $("#"+$(this).attr('id').replace('img','ip')).click();
        });
    });
</script>
</body>
</html>
