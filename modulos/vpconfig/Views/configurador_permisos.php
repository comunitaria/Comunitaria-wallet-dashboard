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
                       <?= tabla('tbPermisos',[ 'menu'=>[
                                            'titulo'=>'Menú superior',
                                            'items' =>[
                                                [
                                                    'texto'=>'<i class="fas fa-plus pr-2"></i>Nuevo permiso',
                                                    'accion'=>[
                                                        'tipo'=>'anadir',
                                                        'formulario'=>[
                                                            'titulo'=>'Nuevo permiso',
                                                        ],
                                                        'url'=>base_url('/vpconf/anade_permiso')           
                                                    ]
                                                ],
                                                [
                                                    'texto'=>'Eliminar',
                                                    'accion'=>[
                                                        'tipo'=>'eliminar',
                                                        'url'=>base_url('/vpconf/elimina_permisos')           
                                                    ]
                                                ],
                                            ]
                                        ],
                                        'columnas'=>[
                                            [
                                                'titulo'=>'Código',
                                                'entrada'=>[
                                                    'tipo'=>'number',
                                                    'label'=>'Número identificativo del permiso:'
                                                ],
                                                'accion'=>[
                                                    'tipo'=>'editar',
                                                    'formulario'=>[
                                                        'titulo'=>'Modificar permiso'
                                                    ],
                                                    'url'=>base_url('/vpconf/modifica_permiso'),           
                                                ],
                                                'esIndice'=>true
                                            ],
                                            [
                                                'titulo'=>'Descripción',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Descripción del permiso:'
                                                ]
                                            ]
                                        ],
                                        'estilo'=>'hover dark  striped w-50',
                                        'datos'=>$permisos]) ?>
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