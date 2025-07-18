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
    <div class="content-wrapper  bg-dark">
        <section class="content mt-5">
            <div class="container-fluid">
                <?= form_open_multipart('vpconf/identidad') ?>
                    <h3>Estilos</h3>
                    <div class="mb-3 row">
                        <div class="col-sm-4 text-right ">
                            <label for="ipTonalidad" class="mb-0 form-label">Tonalidades cuerpo:
                                <div class="text-xs">Pueden ser oscuras o claras</div>
                            </label>
                        </div>
                        <select class="col-sm-2 form-control" id="ipTonalidad" name="tonalidad" >
                            <option value="light-mode" <?= (($tonalidad=env('Config\VstPortal.tonalidad'))==''||$tonalidad=='light-mode')?'selected':''?> >Light</option>
                            <option value="dark-mode" <?= $tonalidad=='dark-mode'?'selected':''?>>Dark</option>
                        </select>
                        <div class="col-sm-3 text-right ">
                            <label for="ipAcento" class="mb-0 form-label">Color destacado:
                                <div class="text-xs">En enlaces o acentuados</div>
                            </label>
                        </div>
                        <select class="col-sm-2 form-control" id="ipAcento" name="acento" >
                        <option value="primary" <?= (($acento=env('Config\VstPortal.acento'))==''||$acento=='primary')?'selected':'' ?> >Primary</option>
                            <option value="secondary" <?= $acento=='secondary'?'selected':''?>>Secondary</option>
                            <option value="success" <?= $acento=='success'?'selected':''?>>Success</option>
                            <option value="info" <?= $acento=='info'?'selected':''?>>Info</option>
                            <option value="warning" <?= $acento=='warning'?'selected':''?>>Warning</option>
                            <option value="danger" <?= $acento=='danger'?'selected':''?>>Danger</option>
                            <option value="light" <?= $acento=='light'?'selected':''?>>Light</option>
                            <option value="dark" <?= $acento=='dark'?'selected':''?>>Dark</option>
                            <option value="gray" <?= $acento=='gray'?'selected':''?>>Gray</option>
                            <option value="olive" <?= $acento=='olive'?'selected':''?>>Olive</option>
                            <option value="lime" <?= $acento=='lime'?'selected':''?>>Lime</option>
                            <option value="maroon" <?= $acento=='maroon'?'selected':''?>>Maroon</option>
                            <option value="navy" <?= $acento=='navy'?'selected':''?>>Navy</option>
                            <option value="black" <?= $acento=='black'?'selected':''?>>Black</option>
                            <option value="fuchsia" <?= $acento=='fuchsia'?'selected':''?>>Fuchsia</option>
                            <option value="indigo" <?= $acento=='indigo'?'selected':''?>>Indigo</option>
                            <option value="purple" <?= $acento=='purple'?'selected':''?>>Purple</option>
                            <option value="pink" <?= $acento=='pink'?'selected':''?>>Pink</option>
                            <option value="red" <?= $acento=='red'?'selected':''?>>Red</option>
                            <option value="orange" <?= $acento=='orange'?'selected':''?>>Orange</option>
                            <option value="yellow" <?= $acento=='yellow'?'selected':''?>>Yellow</option>
                            <option value="green" <?= $acento=='green'?'selected':''?>>Green</option>
                            <option value="teal" <?= $acento=='teal'?'selected':''?>>Teal</option>
                            <option value="cyan" <?= $acento=='cyan'?'selected':''?>>Cyan</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-4 text-right ">
                            <label for="ipTonoLateral" class="mb-0 form-label">Tonalidades menú lateral:
                                <div class="text-xs">Fondo colores "dark" o "light" y destacado color de la paleta</div>
                            </label>
                        </div>
                        <select class="col-sm-3 form-control" id="ipTonoLateral" name="lateralDark" >
                            <option value="dark" <?= (($fondoLateral=env('Config\VstPortal.lateralDark'))==''||$fondoLateral=='dark')?'selected':'' ?> >Dark</option>
                            <option value="light" <?= $fondoLateral=='light'?'selected':''?>>Light</option>
                        </select>
                        <div class="col-sm-1 "></div>
                        <select class="col-sm-3 form-control" id="ipDestacadoLateral" name="lateralDestacado" >
                            <option value="primary" <?= (($lateralDestacado=env('Config\VstPortal.lateralDestacado'))==''||$lateralDestacado=='primary')?'selected':'' ?> >Primary</option>
                            <option value="secondary" <?= $lateralDestacado=='secondary'?'selected':''?>>Secondary</option>
                            <option value="success" <?= $lateralDestacado=='success'?'selected':''?>>Success</option>
                            <option value="info" <?= $lateralDestacado=='info'?'selected':''?>>Info</option>
                            <option value="warning" <?= $lateralDestacado=='warning'?'selected':''?>>Warning</option>
                            <option value="danger" <?= $lateralDestacado=='danger'?'selected':''?>>Danger</option>
                            <option value="light" <?= $lateralDestacado=='light'?'selected':''?>>Light</option>
                            <option value="dark" <?= $lateralDestacado=='dark'?'selected':''?>>Dark</option>
                            <option value="gray" <?= $lateralDestacado=='gray'?'selected':''?>>Gray</option>
                            <option value="olive" <?= $lateralDestacado=='olive'?'selected':''?>>Olive</option>
                            <option value="lime" <?= $lateralDestacado=='lime'?'selected':''?>>Lime</option>
                            <option value="maroon" <?= $lateralDestacado=='maroon'?'selected':''?>>Maroon</option>
                            <option value="navy" <?= $lateralDestacado=='navy'?'selected':''?>>Navy</option>
                            <option value="black" <?= $lateralDestacado=='black'?'selected':''?>>Black</option>
                            <option value="fuchsia" <?= $lateralDestacado=='fuchsia'?'selected':''?>>Fuchsia</option>
                            <option value="indigo" <?= $lateralDestacado=='indigo'?'selected':''?>>Indigo</option>
                            <option value="purple" <?= $lateralDestacado=='purple'?'selected':''?>>Purple</option>
                            <option value="pink" <?= $lateralDestacado=='pink'?'selected':''?>>Pink</option>
                            <option value="red" <?= $lateralDestacado=='red'?'selected':''?>>Red</option>
                            <option value="orange" <?= $lateralDestacado=='orange'?'selected':''?>>Orange</option>
                            <option value="yellow" <?= $lateralDestacado=='yellow'?'selected':''?>>Yellow</option>
                            <option value="green" <?= $lateralDestacado=='green'?'selected':''?>>Green</option>
                            <option value="teal" <?= $lateralDestacado=='teal'?'selected':''?>>Teal</option>
                            <option value="cyan" <?= $lateralDestacado=='cyan'?'selected':''?>>Cyan</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-4 text-right ">
                            <label for="ipTonoSuperior" class="mb-0 form-label">Tonalidades menú superior:
                                <div class="text-xs">Fondo colores "dark" o "light" </div>
                            </label>
                        </div>
                        <select class="col-sm-3 form-control" id="ipTonoSuperior" name="superiorDark" >
                            <option value="dark" <?= (($superiorDark=env('Config\VstPortal.superiorDark'))==''||$superiorDark=='dark')?'selected':'' ?> >Dark</option>
                            <option value="light" <?= $superiorDark=='light'?'selected':''?>>Light</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-4 text-right ">
                            <label for="ipTonoConfiguracion" class="mb-0 form-label">Tonalidades menú configuración:
                                <div class="text-xs">Fondo colores "dark" o "light" </div>
                            </label>
                        </div>
                        <select class="col-sm-3 form-control" id="ipTonoConfiguracion" name="configuracionDark" >
                            <option value="dark" <?= (($configuracionDark=env('Config\VstPortal.configuracionDark'))==''||$configuracionDark=='dark')?'selected':'' ?> >Dark</option>
                            <option value="light" <?= $configuracionDark=='light'?'selected':''?>>Light</option>
                        </select>
                    </div>
                    <h3>Textos</h3>
                    <div class="mb-3 row">
                        <div class="col-sm-4 text-right ">
                            <label for="ipTamanoTexto" class="mb-0 form-label">Tamaño general:
                                <div class="text-xs">Localmente usar clases <i>text-xs -sm -md -lg -xl</i></div>
                            </label>
                        </div>
                        <select class="col-sm-4 form-control" id="ipTamanoTexto" name="tamanoTexto" >
                            <option value="xs" class="text-xs" <?= ($tamanoTexto=env('Config\VstPortal.tamanoTexto'))=='xs'?'selected':'' ?>>Extra pequeño</option>
                            <option value="sm" class="text-sm" <?= $tamanoTexto=='sm'?'selected':'' ?>>Pequeño</option>
                            <option value="md" class="text-md" <?= ($tamanoTexto==''||$tamanoTexto=='md')?'selected':'' ?>>Medio</option>
                            <option value="lg" class="text-lg" <?= $tamanoTexto=='lg'?'selected':'' ?>>Grande</option>
                            <option value="xl" class="text-xl" <?= $tamanoTexto=='xl'?'selected':'' ?>>Extragrande</option>
                        </select>
                    </div>
                    <label class="text-center form-label mt-2">Secuencia de tipos de letra:
                    <div class="text-sm ">(no pongas comillas)</div>
                    </label>
<?php
        $fuentes=explode(',',$fontFamily);
        foreach($fuentes as $f=>$unaFamilia){
            $fuentes[$f]=trim(str_replace('"','',str_replace("'",'',$unaFamilia)));
        }
        $fuentes=array_slice($fuentes,0,9);
        for($n=count($fuentes);$n<9;$n++){
            $fuentes[$n]='';
        }
        for($f=0;$f<2;$f++){
?>
                    <div class="mb-3 mx-2 row">
<?php
            for($c=0;$c<3;$c++){
?>
                        <div class="col-sm-4 ">
                            <span>(<?=($f*3+$c+1)?>)</span><input class="form-control" list="fonts" type="text" name="fontFamily<?= $f*3+$c ?>" value="<?= $fuentes[$f*3+$c] ?>">
                        </div>
<?php
            }
?>
                    </div>
<?php
        }
?>
                    </div>
                    <datalist id="fonts">
<?php
        foreach(['Arial','Verdana','Tahoma','Trebuchet MS','Times New Roman','Georgia','Garamond','Courier New','Brush Script MT','Serif', 'Sans-serif','Monospace','Cursive','Fantasy'] as $unaFamilia){
?>
                        <option value="<?= $unaFamilia ?>">
<?php
        }
?>

                    </datalist>
                    <h3>Paleta</h3>
                    <div class="mb-3 row">
                        <div class="col-sm-3 text-center">
                            <label for="ipColorPrimary" class="form-label">Primary:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorPrimary" name="colorPrimary" value="<?= $colorPrimary ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipColorSecondary" class="form-label">Secondary:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorSecondary" name="colorSecondary" value="<?= $colorSecondary ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipColorSuccess" class="form-label">Success:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorSuccess" name="colorSuccess" value="<?= $colorSuccess ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipColorInfo" class="form-label">Info:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorInfo" name="colorInfo" value="<?= $colorInfo ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-3 text-center">
                            <label for="ipColorWarning" class="form-label">Warning:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorWarning" name="colorWarning" value="<?= $colorWarning ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipColorDanger" class="form-label">Danger:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorDanger" name="colorDanger" value="<?= $colorDanger ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipColorLight" class="form-label">Light:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorLight" name="colorLight" value="<?= $colorLight ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipColorDark" class="form-label">Dark:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipColorDark" name="colorDark" value="<?= $colorDark ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorGray" class="form-label">Gray (no editable):</label>
                            <input type="color" disabled style="height:4em" class="form-control" id="ipcolorGray" name="colorGray" value="<?= $colorGray ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorOlive" class="form-label">Olive:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorOlive" name="colorOlive" value="<?= $colorOlive ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorLime" class="form-label">Lime:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorLime" name="colorLime" value="<?= $colorLime ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorMaroon" class="form-label">Maroon:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorMaroon" name="colorMaroon" value="<?= $colorMaroon ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorNavy" class="form-label">Navy:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorNavy" name="colorNavy" value="<?= $colorNavy ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorBlack" class="form-label">Black:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorBlack" name="colorBlack" value="<?= $colorBlack ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorFuchsia" class="form-label">Fuchsia:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorFuchsia" name="colorFuchsia" value="<?= $colorFuchsia ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorIndigo" class="form-label">Indigo:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorIndigo" name="colorIndigo" value="<?= $colorIndigo ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorPurple" class="form-label">Purple:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorPurple" name="colorPurple" value="<?= $colorPurple ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorPink" class="form-label">Pink:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorPink" name="colorPink" value="<?= $colorPink ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorRed" class="form-label">Red:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorRed" name="colorRed" value="<?= $colorRed ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorOrange" class="form-label">Orange:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorOrange" name="colorOrange" value="<?= $colorOrange ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorYellow" class="form-label">Yellow:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorYellow" name="colorYellow" value="<?= $colorYellow ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorGreen" class="form-label">Green:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorGreen" name="colorGreen" value="<?= $colorGreen ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorTeal" class="form-label">Teal:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorTeal" name="colorTeal" value="<?= $colorTeal ?>">
                        </div>
                        <div class="col-sm-3 text-center">
                            <label for="ipcolorCyan" class="form-label">Cyan:</label>
                            <input type="color" style="height:4em" class="form-control" id="ipcolorCyan" name="colorCyan" value="<?= $colorCyan ?>">
                        </div>
                    </div>
                    <div class="row">
                        <button value="reset" name="accion" type="submit" class="btn btn-danger mt-4 ml-4">Recuperar paleta estándar</button>    
                    </div>
                    <div class="row">
                        <button value="reconfigurar" name="accion" type="submit" class="btn btn-primary ml-auto mr-5 mb-5 mt-4">Grabar configuración</button>    
                    </div>
                    <?= form_close() ?>
            </div>
    </section>
    </div>
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
