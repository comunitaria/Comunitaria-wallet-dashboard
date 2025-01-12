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
                <?php $base_url=base_url(); ?>
                <?= tabla('tbPaginas',[ 'menu'=>[
                                            'titulo'=>'Páginas definidas en el proyecto',
                                            'items' =>[
                                                [
                                                    'texto'=>'<i class="fas fa-plus pr-2"></i>Nueva',
                                                    'accion'=>[
                                                        'tipo'=>'anadir',
                                                        'formulario'=>[
                                                            'titulo'=>'Nueva página',
                                                            'requerido'=>
<<<JS
    (___formularios_campo("Nombre")!='')&&(___formularios_campo("Controlador")!='')
JS
                                                        ],
                                                        'url'=>base_url('/vpconf/anade_pagina')           
                                                    ]
                                                ],
                                                [
                                                    'texto'=>'Eliminar',
                                                    'accion'=>[
                                                        'tipo'=>'eliminar',
                                                        'url'=>base_url('/vpconf/borra_paginas')           
                                                    ]
                                                ],
                                            ]
                                        ],
                                        'columnas'=>[
                                            [
                                                'titulo'=>'Nombre',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Nombre de la página:'
                                                ],
                                                'accion'=>[
                                                    'tipo'=>'editar',
                                                    'formulario'=>[
                                                        'titulo'=>'Modificar página',
                                                        'requerido'=>
    <<<JS
    (___formularios_campo("Nombre")!='')&&(___formularios_campo("Controlador")!='')
    JS
                                                    ],
                                                    'url'=>base_url('/vpconf/modifica_pagina'),           
                                                ],
                                                'esIndice'=>true
                                            ],
                                            [
                                                'titulo'=>'Estructura',
                                                'entrada'=>[
                                                        'tipo'=>'text',
                                                        'label'=>'Disposición:',
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Controlador',
                                                'orden'=>[0,'asc'],
                                                'render'=>
<<<JS
                return "<a href='$base_url"+data+"'>"+data+"</a>";
JS,
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Controlador:'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Verbos',
                                                'entrada'=>[
                                                    'tipo'=>'select',
                                                    'label'=>'Verbos:',
                                                    'opciones'=>['g'=>'get','g+p'=>'get+post'],
                                                    'valor'=>'g'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Acceso',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Permisos requeridos (separados por coma, 0=todos):'
                                                ]
                                            ],
                                         ],
                                        'estilo'=>'hover dark striped',
                                        'datos'=>$paginas]) ?>
            </div>
    </section>
    </div>
    </div>
<script>
    $(document).ready(function(){
        $("body").click(function(){
            $("#frmPrueba").modal("show");
        });
  });
</script>
</body>
</html>

