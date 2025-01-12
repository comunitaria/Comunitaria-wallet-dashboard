<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $VPConf->tituloWeb ?></title>
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
<body class="hold-transition sidebar-mini layout-fixed text-<?= $VPConf->tamanoTexto ?> <?= $VPConf->tonalidad ?>">
 <div class="wrapper">
<!-- Vpconf> barra (Zona sujeta a cambios automáticos)-->
    <?= barraNavegacion(json_decode($VPConf->menuSuperior,true),[['tipo'=>'usuario'],['tipo'=>'configuracion','titulo'=>'Configuracion', 'menu'=>$VPConf->menuConfig]],'','menu',true) ?>
<!-- Vpconf< barra -->
<!-- Vpconf> aside (Zona sujeta a cambios automáticos)-->
    <aside class="main-sidebar sidebar-<?= $VPConf->lateralDark ?>-<?= $VPConf->lateralDark ?> elevation-4">
                <?= encabezado(base_url(''),base_url('public/assets/imagenes').'/logotipo'.($VPConf->UAT?"UAT":"").'.png',$VPConf->nombreCliente) ?>
                <?= sidebar(json_decode($VPConf->menuLateral,true)) ?>

    </aside>
<!-- Vpconf< aside -->


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row ml-3 mt-2">
                    <div class="col">
                        <h3>Configuracion general</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
            <?php $base_url=base_url(); ?>
                <div class="row ml-3">
                    <div class="col">
                    <?= form_open_multipart('configuracion/modificar') ?>
                    <h5>Sistema de almacenamiento</h5>
                    <div class="mb-3 row">
                        <select class="col-sm-4 form-control" id="ipSistemaAlm" name="sistemaAlm" >
                            <option value="" <?= ($configuracion['almacenamiento']===false)?'selected':'' ?>>Ninguna</option>
                            <option value="SP" <?= (($configuracion['almacenamiento']['sistema']??'')=='SP')?'selected':'' ?>>Sharepoint</option>
                            <option value="S3" <?= (($configuracion['almacenamiento']['sistema']??'')=='S3')?'selected':'' ?>>AWS S3</option>
                        </select>
                    </div>
                    <div id="dvSP" style="<?= (($configuracion['almacenamiento']['sistema']??'')=='SP')?'':'display:none' ?>" class="mb-3 row">
                        <div class="col-sm-8">
                            <div class="mb-3">
                            Configuración de acceso a una librería Sharepoint
                            </div>
                            <div class="mb-3">
                                <label for="ipLibreria" class="mb-0 form-label">URL de la librería:
                                    <div class="text-xs">Ejemplo: "https://vestigia.sharepoint.com/sites/Portaldocumentos"</div>
                                </label>
                                <input type="text" class="form-control" id="ipLibreria" name="libreria" value="<?= $configuracion['almacenamiento']['libreria']??'' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ipDirBase" class="mb-0 form-label">Directorio base:
                                    <div class="text-xs">Ejemplo: "Documentos compartidos/TECSA"</div>
                                </label>
                                <input type="text" class="form-control" id="ipDirBase" name="dirBase" value="<?= $configuracion['almacenamiento']['dirBase']??'' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ipDirTemp" class="mb-0 form-label">Directorio temporal:
                                    <div class="text-xs">Ejemplo: "Documentos compartidos/TECSA/temp"</div>
                                </label>
                                <input type="text" class="form-control" id="ipDirTemp" name="dirTemp" value="<?= $configuracion['almacenamiento']['dirTemp']??'' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ipTenantID" class="mb-0 form-label">Tenant ID:
                                    <div class="text-xs">Ejemplo: "38c14ecb-8279-4bbe-b606-e0411060d3d7" (Segunda parte del ID de aplicación en .../_layouts/15/appprincipals.aspx)</div>
                                </label>
                                <input type="text" class="form-control" id="ipTenantID" name="tenantID" value="<?= $configuracion['almacenamiento']['tenantID']??'' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ipClientID" class="mb-0 form-label">Client ID:
                                    <div class="text-xs">Ejemplo: "f10f6a3d-e89a-4ce4-8ab6-3e76918660f0" (Primera parte del ID de aplicación en .../_layouts/15/appprincipals.aspx)</div>
                                </label>
                                <input type="text" class="form-control" id="ipClientID" name="clientID" value="<?= $configuracion['almacenamiento']['clientID']??'' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="ipClientSecret" class="mb-0 form-label">Client secret:
                                    <div class="text-xs">Ejemplo: "Ydy+tEykyYHWA48LLKwD+f6pDrRwmkWThYiaB9wTZEY="</div>
                                </label>
                                <input type="text" class="form-control" id="ipClientSecret" name="clientSecret" value="<?= $configuracion['almacenamiento']['clientSecret']??'' ?>">
                            </div>
                       </div>
                    </div>
                    <div id="dvS3" style="<?= (($configuracion['almacenamiento']['sistema']??'')=='S3')?'':'display:none' ?>" class="mb-3 row">
                        <div class="col-sm-8">
                            <div class="mb-3">
                            Configuración de acceso a un bucket AWS S3
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button value="reconfigurar" name="accion" type="submit" class="btn btn-primary ml-auto mr-5 mb-5 mt-4">Grabar configuración</button>    
                    </div>
                    <?= form_close() ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<!-- Vpconf> pie (Zona sujeta a cambios automáticos)-->
    <?= pie($VPConf->contenidoPie,'',true) ?>
<!-- Vpconf< pie -->
 </div>
 <script>
     $(document).ready(function(){
        $("#ipSistemaAlm").change(function(){
            $("#dvSP").hide();
            $("#dvS3").hide();
            switch($(this).val()){
                case 'SP':
                    $("#dvSP").show();
                    break;
                case 'S3':
                    $("#dvS3").show();
                    break;
            }
        });
      });
 </script>
</body>
</html>