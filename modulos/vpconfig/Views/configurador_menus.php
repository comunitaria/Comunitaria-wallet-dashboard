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
                <?= tabla('tbMenuLateral',[ 'menu'=>[
                                            'titulo'=>'Menú lateral',
                                            'items' =>[
                                                [
                                                    'texto'=>'<i class="fas fa-plus pr-2"></i>Nuevo item',
                                                    'accion'=>[
                                                        'tipo'=>'anadir',
                                                        'formulario'=>[
                                                            'titulo'=>'Nuevo item',
                                                        ],
                                                        'url'=>base_url('/vpconf/anade_item_lateral')           
                                                    ]
                                                ],
                                                [
                                                    'texto'=>'Eliminar',
                                                    'accion'=>[
                                                        'tipo'=>'eliminar',
                                                        'url'=>base_url('/vpconf/elimina_items_laterales')           
                                                    ]
                                                ],
                                            ]
                                        ],
                                        'columnas'=>[
                                            [
                                                'titulo'=>'Nombre',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Identificador del item:'
                                                ],
                                                'accion'=>[
                                                    'tipo'=>'editar',
                                                    'formulario'=>[
                                                        'titulo'=>'Modificar item de menú lateral'
                                                    ],
                                                    'url'=>base_url('/vpconf/modifica_item_lateral'),           
                                                ],
                                                'esIndice'=>true
                                            ],
                                            [
                                                'titulo'=>'Orden',
                                                'orden'=>[2, 'asc'],
                                                'entrada'=>[
                                                    'tipo'=>'number',
                                                    'label'=>'Número de orden:'
                                                ],
                                            ],
                                            [
                                                'titulo'=>'Icono',
                                                'entrada'=>[
                                                        'tipo'=>'text',
                                                        'label'=>'Icono:',
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Etiqueta',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Etiqueta:'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Link',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Controlador:'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Padre',
                                                'orden'=>[1, 'asc'],
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Identificador del item padre:'
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
                                        'estilo'=>'hover dark  striped',
                                        'datos'=>$menu_lateral]) ?>
            <div class="my-5"></div>
                       <?= tabla('tbMenuSuperior',[ 'menu'=>[
                                            'titulo'=>'Menú superior',
                                            'items' =>[
                                                [
                                                    'texto'=>'<i class="fas fa-plus pr-2"></i>Nuevo item',
                                                    'accion'=>[
                                                        'tipo'=>'anadir',
                                                        'formulario'=>[
                                                            'titulo'=>'Nuevo item',
                                                        ],
                                                        'url'=>base_url('/vpconf/anade_item_superior')           
                                                    ]
                                                ],
                                                [
                                                    'texto'=>'Eliminar',
                                                    'accion'=>[
                                                        'tipo'=>'eliminar',
                                                        'url'=>base_url('/vpconf/elimina_items_superiores')           
                                                    ]
                                                ],
                                            ]
                                        ],
                                        'columnas'=>[
                                            [
                                                'titulo'=>'Nombre',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Identificador del item:'
                                                ],
                                                'accion'=>[
                                                    'tipo'=>'editar',
                                                    'formulario'=>[
                                                        'titulo'=>'Modificar item de menú superior'
                                                    ],
                                                    'url'=>base_url('/vpconf/modifica_item_superior'),           
                                                ],
                                                'esIndice'=>true
                                            ],
                                            [
                                                'titulo'=>'Orden',
                                                'orden'=>[2, 'asc'],
                                                'entrada'=>[
                                                    'tipo'=>'number',
                                                    'label'=>'Número de orden:'
                                                ],
                                            ],
                                            [
                                                'titulo'=>'Icono',
                                                'entrada'=>[
                                                        'tipo'=>'hidden',
                                                        'label'=>'Icono:',
                                                ],
                                                'oculta'=>true
                                            ],
                                            [
                                                'titulo'=>'Etiqueta',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Etiqueta:'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Link',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Controlador:'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Padre',
                                                'orden'=>[1, 'asc'],
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Identificador del item padre:'
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
                                        'estilo'=>'hover dark  striped',
                                        'datos'=>$menu_superior]) ?>
          <div class="my-5"></div>
            <?= tabla('tbMenuConfig',[ 'menu'=>[
                                            'titulo'=>'Menú configuración',
                                            'items' =>[
                                                [
                                                    'texto'=>'<i class="fas fa-plus pr-2"></i>Nuevo item',
                                                    'accion'=>[
                                                        'tipo'=>'anadir',
                                                        'formulario'=>[
                                                            'titulo'=>'Nuevo item',
                                                        ],
                                                        'url'=>base_url('/vpconf/anade_item_config')           
                                                    ]
                                                ],
                                                [
                                                    'texto'=>'Eliminar',
                                                    'accion'=>[
                                                        'tipo'=>'eliminar',
                                                        'url'=>base_url('/vpconf/elimina_items_config')           
                                                    ]
                                                ],
                                            ]
                                        ],
                                        'columnas'=>[
                                            [
                                                'titulo'=>'Nombre',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Identificador del item:'
                                                ],
                                                'accion'=>[
                                                    'tipo'=>'editar',
                                                    'formulario'=>[
                                                        'titulo'=>'Modificar item de menú configuración'
                                                    ],
                                                    'url'=>base_url('/vpconf/modifica_item_config'),           
                                                ],
                                                'esIndice'=>true
                                            ],
                                            [
                                                'titulo'=>'Orden',
                                                'orden'=>[2, 'asc'],
                                                'entrada'=>[
                                                    'tipo'=>'number',
                                                    'label'=>'Número de orden:'
                                                ],
                                            ],
                                            [
                                                'titulo'=>'Icono',
                                                'entrada'=>[
                                                        'tipo'=>'text',
                                                        'label'=>'Icono:',
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Etiqueta',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Etiqueta:'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Link',
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Controlador:'
                                                ]
                                            ],
                                            [
                                                'titulo'=>'Padre',
                                                'orden'=>[1, 'asc'],
                                                'entrada'=>[
                                                    'tipo'=>'text',
                                                    'label'=>'Identificador del item padre:'
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
                                        'estilo'=>'hover dark  striped',
                                        'datos'=>$menu_config]) ?>
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