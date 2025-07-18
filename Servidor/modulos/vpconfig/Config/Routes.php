<?php 
    $routes->get('/vpconf', '\Modulos\Vpconfig\Controllers\Vpconf::index');
    $routes->post('/vpconf', '\Modulos\Vpconfig\Controllers\Vpconf::index');

    $routes->get('/vpconf/imagenes', '\Modulos\Vpconfig\Controllers\Vpconf::imagenes');
    $routes->post('/vpconf/imagenes', '\Modulos\Vpconfig\Controllers\Vpconf::imagenes');
    
    $routes->get('/vpconf/identidad', '\Modulos\Vpconfig\Controllers\Vpconf::identidad');
    $routes->post('/vpconf/identidad', '\Modulos\Vpconfig\Controllers\Vpconf::identidad');
    
    $routes->get('/vpconf/paginas', '\Modulos\Vpconfig\Controllers\Vpconf::paginas');
    $routes->post('/vpconf/paginas', '\Modulos\Vpconfig\Controllers\Vpconf::paginas');
    $routes->post('/vpconf/anade_pagina', '\Modulos\Vpconfig\Controllers\Vpconf::anade_pagina');
    $routes->post('/vpconf/borra_paginas', '\Modulos\Vpconfig\Controllers\Vpconf::borra_paginas');
    $routes->post('/vpconf/modifica_pagina', '\Modulos\Vpconfig\Controllers\Vpconf::modifica_pagina');
    
    $routes->get('/vpconf/menus', '\Modulos\Vpconfig\Controllers\Vpconf::menus');
    
    $routes->post('/vpconf/anade_item_lateral', '\Modulos\Vpconfig\Controllers\Vpconf::anade_item_lateral');
    $routes->post('/vpconf/elimina_items_laterales', '\Modulos\Vpconfig\Controllers\Vpconf::elimina_items_laterales');
    $routes->post('/vpconf/modifica_item_lateral', '\Modulos\Vpconfig\Controllers\Vpconf::modifica_item_lateral');
    
    $routes->post('/vpconf/anade_item_superior', '\Modulos\Vpconfig\Controllers\Vpconf::anade_item_superior');
    $routes->post('/vpconf/elimina_items_superiores', '\Modulos\Vpconfig\Controllers\Vpconf::elimina_items_superiores');
    $routes->post('/vpconf/modifica_item_superior', '\Modulos\Vpconfig\Controllers\Vpconf::modifica_item_superior');

    $routes->post('/vpconf/anade_item_config', '\Modulos\Vpconfig\Controllers\Vpconf::anade_item_config');
    $routes->post('/vpconf/elimina_items_config', '\Modulos\Vpconfig\Controllers\Vpconf::elimina_items_config');
    $routes->post('/vpconf/modifica_item_config', '\Modulos\Vpconfig\Controllers\Vpconf::modifica_item_config');
    
    
    $routes->get('/vpconf/permisos', '\Modulos\Vpconfig\Controllers\Vpconf::permisos');
    
    $routes->post('/vpconf/anade_permiso', '\Modulos\Vpconfig\Controllers\Vpconf::anade_permiso');
    $routes->post('/vpconf/elimina_permisos', '\Modulos\Vpconfig\Controllers\Vpconf::elimina_permisos');
    $routes->post('/vpconf/modifica_permiso', '\Modulos\Vpconfig\Controllers\Vpconf::modifica_permiso');
    
    $routes->get('/vpconf/ayuda', '\Modulos\Vpconfig\Controllers\Vpconf::ayuda');
    
    $routes->post('/vpconf/inicializar', '\Modulos\Vpconfig\Controllers\Vpconf::inicializar');

?>
