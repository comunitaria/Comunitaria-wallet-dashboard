<?php
/**
 * Nombre: pagina
 * Descripcion: ficheros propios de esta página web
 * 
 */

 anade_filtro('barra_superior_componentes',function ($componentes){
   // $nuevos = [];
   // $mensajes=model('Modulos\Pagina\Models\Cls_mensajes')->findPara(session()->get('usuario')['idUsuario'],true);
   // $remitentes=[];
   // foreach($mensajes as $unMensaje){
   //    if (!array_key_exists($unMensaje->autor,$remitentes)) $remitentes[$unMensaje->autor]=model('Modulos\Pagina\Models\Cls_usuarios_p')->find($unMensaje->autor);
   // }
   // foreach($mensajes as $unMensaje){
   //    $nombreAutor=\Modulos\Pagina\USUARIO_SISTEMA;
   //    if ($unMensaje->autor!=0) $nombreAutor=$remitentes[$unMensaje->autor]->nombre_usr;
   //          $nuevos[]=[ 
   //                'titulo'=>'Expediente '.$unMensaje->expediente['titulo'], 
   //                'texto'=>$unMensaje->texto, 
   //                'autor_nombre'=>$nombreAutor,
   //                'autor_avatar'=>imagen_usr($unMensaje->autor),
   //                'hace'=>strtotime('now')-strtotime($unMensaje->fecha),
   //                'link'=>base_url('expediente').'?exp='.$unMensaje->expediente['id'].($unMensaje->historico?'&h=1':'').'&b=1'
   //                ];
   // }
   // array_unshift($componentes,
   //    [  'tipo'=>'comentarios',
   //       'url'=>base_url('/usuarios/mensajes_nuevos')
   //    ],
   //   [   'tipo'=>'icono',
   //   'icono'=>'fas fa-info-circle',
   //   'href'=>'#',
   //    'id'=>'aAyuda']
   //     );
      
    return $componentes;
 });
 anade_filtro('barra_superior_menu',function ($menu){
   // $sesion = session();
   // if ($sesion->has('conFiltroFormulario')?$sesion->get('conFiltroFormulario'):false){
   //    $parametros=$_GET;
   //    if (isset($parametros['fl'])) unset($parametros['fl']);
   //    $filtrando=0;
   //    $filtrando=$sesion->has('soloFormulario')?$sesion->get('soloFormulario'):0;
   //    foreach(model('Modulos\Pagina\Models\Cls_formularios')->findAll() as $unFormulario){
   //       $href = current_url().'?'.http_build_query( array_merge($parametros,['fl'=>$unFormulario->id]) );
   //       if ($unFormulario->activo){
   //          array_push($menu,
   //          [   'texto'=>$unFormulario->denominacion,
   //             'href'=>$href,
   //             'aut'=>0,
   //             'activo'=>($filtrando==$unFormulario->id)],
   //          );
                  
   //       }
   //    }
   //    $href = current_url().'?'.http_build_query(array_merge($parametros,['fl'=>0]) );
   //    array_unshift($menu,
   //    [   'texto'=>'Todo',
   //       'href'=>$href,
   //       'aut'=>0,
   //       'activo'=>($filtrando==0)],
   //    );
   // }
  return $menu;
});
anade_filtro('menu_sidebar',function ($menu){
   // $oficios=[];
   // $usuario=model('Modulos\Pagina\Models\Cls_usuarios_p')->find(session()->get('usuario')['idUsuario']);
   // if (!is_null($usuario)){
   //    $oficios=$usuario->oficios();
   // }

   // //Supervisor
   // if ((tienePermiso([5]))&&isset($menu['peticiones_supervisor'])){
   //    if (count($oficios)==1){
   //       unset($menu['peticiones_supervisor']);
   //       $menu['peticiones']['aut'].=',5';
   //    }
   //    else{
   //       $menu['peticiones_supervisor']['menu']=[];
   //       foreach($oficios as $unOficio){
   //          $menu['peticiones_supervisor']['menu']['Cola '.$unOficio->desc_oficio]=['texto'=>'Perfil '.$unOficio->desc_oficio,'aut'=>5,'href'=>base_url('/peticiones?o='.$unOficio->id_oficio),'icono'=>'fas fa-tasks'];
   //       }
   //    }
   // }

   // $veAlgo=false;
   // $formularios=model('Modulos\Pagina\Models\Cls_formularios')->findAll();
   // $listaIDOficios=[];
   // foreach($oficios as $unOficio){
   //    $listaIDOficios[]=$unOficio->id_oficio;
   // }
   // foreach($formularios as $unFormulario){
   //    foreach(explode(',',$unFormulario->en_preparacion) as $oficioQueVe){
   //       if (($oficioQueVe==0)||(in_array($oficioQueVe,$listaIDOficios))){
   //          $veAlgo=true;
   //          break;
   //       }
   //    }
   // }      
   // if (!$veAlgo){
   //    unset($menu['preparacion']);
   // }
   return $menu;
});

function filtraPorFormulario(){
   if (isset($_GET['fl'])) session()->set('soloFormulario',$_GET['fl']);

}
function enFiltro($id_formulario){
   $sesion = session();
   $filtrando=$sesion->has('soloFormulario')?$sesion->get('soloFormulario'):0;
   return ($filtrando==0||($filtrando==$id_formulario)); 
}
?>