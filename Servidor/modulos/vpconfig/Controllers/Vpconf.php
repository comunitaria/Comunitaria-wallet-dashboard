<?php

namespace Modulos\Vpconfig\Controllers;
use App\Controllers\BaseController;

define('MENU_COL_NOMBRE',0);
define('MENU_COL_ORDEN',1);
define('MENU_COL_ICONO',2);
define('MENU_COL_ETIQUETA',3);
define('MENU_COL_ENLACE',4);
define('MENU_COL_PADRE',5);
define('MENU_COL_AUT',6);

include('modulos/vpconfig/Libraries/Parsedown.php');
        
class Vpconf extends BaseController
{
    private $comunesPagina;
    private $data;    
    protected $helpers=['enlaces','autorizaciones', 'form', 'Modulos\Vpbasicos\navegacion', 'Modulos\Vpbasicos\tabla', 'Modulos\Vpbasicos\formularios'];
   
    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        
        if (!($this->data['usuario']=datos_usuario()))
                    return redirect('login');
        
        $this->comunesPagina=[
            'menuConf'=>[
                'general'=>['texto'=>'Configuración general', 'icono'=>'fas fa-tachometer-alt', 'href'=>base_url('vpconf'), 'aut'=>1],
                'imagenes'=>['texto'=>'Imágenes', 'icono'=>'far fa-images', 'href'=>base_url('vpconf/imagenes'), 'aut'=>1],
                'identidad'=>['texto'=>'Identidad visual', 'icono'=>'fas fa-palette', 'href'=>base_url('vpconf/identidad'), 'aut'=>1],
                'paginas'=>['texto'=>'Páginas', 'icono'=>'far fa-file-code', 'href'=>base_url('vpconf/paginas'), 'aut'=>1],
                'menus'=>['texto'=>'Menús', 'icono'=>'fas fa-bars', 'href'=>base_url('vpconf/menus'), 'aut'=>1],
                'permisos'=>['texto'=>'Permisos', 'icono'=>'fas fa-user-lock', 'href'=>base_url('vpconf/permisos'), 'aut'=>1],
            ],
            'menuNav'=>[
                ['texto'=>'Página inicio', 'href'=>base_url(), 'aut'=>'1', 'vpconf'=>true]
            ],
            'componentesNav'=>[
                [   'tipo'=>'icono',
                    'icono'=>'fas fa-info-circle',
                    'href'=>base_url('vpconf/ayuda')],
                ['tipo'=>'usuario']
            ],

        ];
        $this->data=array_merge($this->data,$this->comunesPagina);

        //Enlaces de helpers visuales:
        $this->data['enlaces']=[];
        enlaces($this->helpers,$this->data['enlaces']);
        $this->data['enlaces']['stylesheet']['adminlte']['link']=str_replace('adminlte.css','adminlte.conf.css',$this->data['enlaces']['stylesheet']['adminlte']['link']);
                    
    }
    public function index()
    {
        if ($_ENV['database.default.database']==''){
            //Valor por defecto: ir a inicialización   
                return view('vpconf_inicial');
        }
        else{
            //Zona de configuración
            if (!tienePermiso(1)) return view('no_autorizado');
            if (strtolower($this->request->getMethod()) !== 'post') {
                activar_menu_item($this->data['menuConf'],'general');
                return view('Modulos\Vpconfig\Views\configurador_inicio',$this->data);
            }
            else{
                $ficheroENV=file_get_contents('.env');
                foreach(['tituloWeb','nombreCliente','contenidoPie'] as $unItem){
                    $ficheroENV=preg_replace("/Config\\\\VstPortal\.".$unItem."\s*=\s*'.*'/","Config\\VstPortal.".$unItem." = '".$this->request->getPost($unItem)."'", $ficheroENV);
                }
                file_put_contents('.env',$ficheroENV);
                return redirect('vpconf');
            }
        }    
    }
    public function inicializar(){
        //Se han documentado los valores iniciales

        //Registro de valores de configuracion
        $URL=$_POST['URL'];
        if (substr($URL,-1)=='/'){
            $URL=substr($URL,0,-1);
        }
        $URL=str_replace('http://', 'https://', $URL);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/#?\s+app\.baseURL = '.*'/","  app.baseURL = '".$URL."'", $ficheroENV);
        $ficheroENV=preg_replace("/#?\s+database\.default\.database =\s+/","\n  database.default.database =".$_POST['BD']."\n  ", $ficheroENV);
        $ficheroENV=preg_replace("/#?\s+database\.default\.username =\s+/","\n  database.default.username =".$_POST['UsuarioMySQL']."\n  ", $ficheroENV);
        $ficheroENV=preg_replace("/#?\s+database\.default\.password =\s+/","\n  database.default.password =".$_POST['ClaveMySQL']."\n  ", $ficheroENV);

        //V3st1g14*2019
        file_put_contents('.env',$ficheroENV);
        $_ENV['database.default.username']=$_POST['UsuarioMySQL'];
        $_ENV['database.default.password']=$_POST['ClaveMySQL'];
        //Creación de la base de datos
        $db=db_connect();
        $db->query('CREATE DATABASE IF NOT EXISTS '.$_POST['BD'].'
                        CHARACTER SET latin1
                        COLLATE latin1_spanish_ci');
        $db->setDatabase($_POST['BD']);
        foreach(explode(";",file_get_contents('app/Config/inicial.sql')) as $unaOrden){
            if (trim($unaOrden)!=''){
                if (!$db->query($unaOrden.';')){
                    throw new Exception('Error Processing Request: '.$unaOrden.' '.$db->error(), 1); 
                }
            }
        }
        if (!$db->query('INSERT INTO usuarios (id_usr,nombre_usr,login_usr,pwd_usr) VALUES (1,"Superusuario Vestigia","'.$_POST['Super'].'", MD5("'.$_POST['Clave'].'"))')){
            throw new Exception('Error Processing Request INSERT INTO usuarios (id_usr,nombre_usr,login_usr,pwd_usr) VALUES (1,"Superusuario Vestigia","'.$_POST['Super'].'", MD5("'.$_POST['Clave'].'"))', 1);
        }

        
        //Login Superusuario
        $MUsuario=model('App\Models\Cls_usuarios');
        $superusuario=$MUsuario->find(1);
        $superusuario->login($_POST['Clave']);
        
        //Redirige a página de configuracion
        header("Location: ".$URL."/vpconf");
        exit();
        //redirect()->to($_POST['URL'].'/inicio');
    }
    public function imagenes(){
        if (!tienePermiso(1)) return view('no_autorizado');
        if (strtolower($this->request->getMethod()) !== 'post') {
            activar_menu_item($this->data['menuConf'],'imagenes');
            $this->data['VPConf']=config('VstPortal');
            return view('Modulos\Vpconfig\Views\configurador_imagenes',$this->data);
        }
        else{
            foreach(['confFavicon', 'bg_login', 'logotipo', 'logotipoUAT'] as $nombre){
                $img = $this->request->getFile($nombre);
                if (!is_null($img)){
                    if ($img->isValid() && ! $img->hasMoved()) {
                        if (file_exists(ROOTPATH . 'public/assets/imagenes/'.$nombre.'.png')){
                            unlink(ROOTPATH . 'public/assets/imagenes/'.$nombre.'.png');
                        }
                        $img->move(ROOTPATH . 'public/assets/imagenes', $nombre.'.png');
                    }
                }
            }
            return redirect('vpconf/imagenes');
        }
            
    }
    public function identidad(){
        $lista=['colorPrimary'=>'primary',
                'colorSecondary'=>'secondary',
                'colorSuccess'=>'success',
                'colorInfo'=>'info',
                'colorWarning'=>'warning',
                'colorDanger'=>'danger',
                'colorLight'=>'light',
                'colorDark'=>'dark',
                'colorGray'=>'gray',
                'colorOlive'=>'olive',
                'colorLime'=>'lime',
                'colorMaroon'=>'maroon',
                'colorNavy'=>'navy',
                'colorBlack'=>'black',
                'colorFuchsia'=>'fuchsia',
                'colorIndigo'=>'indigo',
                'colorPurple'=>'purple',
                'colorPink'=>'pink',
                'colorRed'=>'red',
                'colorOrange'=>'orange',
                'colorYellow'=>'yellow',
                'colorGreen'=>'green',
                'colorTeal'=>'teal',
                'colorCyan'=>'cyan',
                'fontFamily'=>'font-family-base'
            ];
        if (!tienePermiso(1)) return view('no_autorizado');
        if (strtolower($this->request->getMethod()) !== 'post') {
            activar_menu_item($this->data['menuConf'],'identidad');
            $ficheroSCSS=file_get_contents(ROOTPATH.'vendor/almasaeed2010/adminlte/build/scss/adminlte.scss');
            foreach($lista as $variable=>$variableSCSS){
                $matches = array();
                preg_match('/\$'.$variableSCSS.':\s?(.+?);/', $ficheroSCSS, $matches);
                if (count($matches)>1){
                    $this->data[$variable]=$matches[1];
                }
                else{
                    $this->data[$variable]='';
                }
            }
            return view('Modulos\Vpconfig\Views\configurador_identidad',$this->data);
        }
        else{
            if ($this->request->getPost('accion')=='reset'){
                unlink(ROOTPATH.'public/assets/css/adminlte.css');
                copy(ROOTPATH.'vendor/almasaeed2010/adminlte/build/scss/adminlte original.scss',ROOTPATH.'vendor/almasaeed2010/adminlte/build/scss/adminlte.scss');
            }
            else{
                $fontFamilies=[];
                for($f=0;$f<6;$f++){
                    $unaFuente=trim($this->request->getPost('fontFamily'.$f));
                    if ($unaFuente!=''){
                        $conEspacios=(strpos($unaFuente,' ')!==false);
                        array_push($fontFamilies,($conEspacios?'"':'').$unaFuente.($conEspacios?'"':''));
                    }
                }
                $ficheroSCSS=file_get_contents(ROOTPATH.'vendor/almasaeed2010/adminlte/build/scss/adminlte.scss');
                foreach($lista as $variable=>$variableSCSS){
                    if ($variable=='fontFamily'){
                        $ficheroSCSS=preg_replace('/\$font-family-base:\s?(.+?);/','$font-family-base: '.implode(', ',$fontFamilies).';', $ficheroSCSS);
                        continue;
                    }
                    if ($variable=='colorGray') continue;
                    $ficheroSCSS=preg_replace('/\$'.$variableSCSS.':\s?(.+?);/','$'.$variableSCSS.': '.$this->request->getPost($variable).';', $ficheroSCSS);
                }
                file_put_contents(ROOTPATH.'vendor/almasaeed2010/adminlte/build/scss/adminlte.scss',$ficheroSCSS);
            }
            exec('sass '.ROOTPATH.'vendor/almasaeed2010/adminlte/build/scss/adminlte.scss '.ROOTPATH.'public/assets/css/adminlte.css');
            $ficheroENV=file_get_contents('.env');

            foreach(['tamanoTexto','tonalidad', 'lateralDark', 'lateralDestacado', 'superiorDark', 'configuracionDark'] as $unItem){
                $ficheroENV=preg_replace("/Config\\\\VstPortal\.".$unItem."\s*=\s*'.*'/","Config\\VstPortal.".$unItem." = '".$this->request->getPost($unItem)."'", $ficheroENV);
            }
            file_put_contents('.env',$ficheroENV);
            return redirect('vpconf/identidad');
        }
            
    }
    public function paginas()
    {
        //Zona de configuración
        if (!tienePermiso(1)) return view('no_autorizado');
        if (strtolower($this->request->getMethod()) !== 'post') {
            activar_menu_item($this->data['menuConf'],'paginas');
            $this->data['paginas']=array_merge(
                                            [
                                                ['Login','','/login','g+p',0],
                                            ],
                                            $this->leePaginasDeRouter()
                                        );
            return view('Modulos\Vpconfig\Views\configurador_paginas',$this->data);
        }
        else{
            $ficheroENV=file_get_contents('.env');
            foreach(['tituloWeb','nombreCliente','contenidoPie'] as $unItem){
                $ficheroENV=preg_replace("/Config\\\\VstPortal\.".$unItem."\s*=\s*'.*'/","Config\\VstPortal.".$unItem." = '".$this->request->getPost($unItem)."'", $ficheroENV);
            }
            file_put_contents('.env',$ficheroENV);
            return redirect('vpconf');
        }
    }
    public function anade_pagina(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado creando página'];
        $nombre=$this->request->getPost('Nombre');
        $estructura=$this->request->getPost('Estructura');
        $permisos=$this->request->getPost('Acceso');
        $verbos=$this->request->getPost('Verbos');
        $path=strtolower($this->request->getPost('Controlador'));
        if (substr($path,0,1)=='/') $path=substr($path,1);
        $controlador=$path;
        $metodo="index";
        if ($controlador!='inicio'){
            if ($controlador=='') $controlador='inicio';
            $paths=explode("/",$controlador);
            if (count($paths)>1){
                $controlador=$paths[0];
                $metodo=$paths[1];
            }
            $respuesta=$this->grabaRoute($nombre,$estructura,$controlador,$metodo,$verbos,$permisos);
            if ($respuesta['exito']){
                $respuesta=$this->creaControlador($nombre,$estructura,$controlador,$metodo,$verbos,$permisos);
                if ($respuesta['exito']){
                    $respuesta=$this->creaVista($nombre,$estructura);
                }
            }
        }
        else{
            $respuesta['mensaje']='Controlador inadmisible: "inicio" está reservado para el raiz';
        }
        return json_encode($respuesta);
    }
    public function borra_paginas(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado borrando página'];
        $lista=json_decode($this->request->getPost('lista'),true);
        $paginas=$this->leePaginasDeRouter();
        //$respuesta['mensaje']=print_r($paginas,true).'////'.print_r($lista,true);
        $ficheroRoutes=file_get_contents('modulos/pagina/Config/Routes.php');
        $respuesta['mensaje']='Página no encontrada';
        foreach($paginas as $unaPagina){
            if (in_array($unaPagina[0],$lista)){
                $respuesta['exito']=true;
                $respuesta['mensaje']='';
                $ficheroRoutes=preg_replace('/\$routes->(.*)\/\/Vpconf:\s*\[\''.$unaPagina[0].'\'(.*)\n/','',$ficheroRoutes);
                $controlador=$unaPagina[2];
                if (substr($controlador,0,1)=='/') $controlador=substr($controlador,1);
                if ($controlador=='') $controlador='inicio';
                $controlador=ucfirst($controlador);
                $ficheroControlador='modulos/pagina/Controllers/'.$controlador.'.php';
                if (file_exists($ficheroControlador)) unlink($ficheroControlador);
                $ficheroVista='modulos/pagina/Views/vista_'.$unaPagina[0].'.php';
                if (file_exists($ficheroVista)) unlink($ficheroVista);
            }
        }
        file_put_contents('modulos/pagina/Config/Routes.php',$ficheroRoutes);
        return json_encode($respuesta);
    }
    public function modifica_pagina(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado modificando página'];
        $nombre=$this->request->getPost('Nombre');
        $estructura=$this->request->getPost('Estructura');
        $permisos=$this->request->getPost('Acceso');
        $path=strtolower($this->request->getPost('Controlador'));
        $controlador=$path;
        $metodo="index";
        if (substr($controlador,0,1)=='/') $controlador=substr($controlador,1);
        if ($controlador=='') $controlador='inicio';
        $paths=explode("/",$controlador);
        if (count($paths)>1){
            $controlador=$paths[0];
            $metodo=$paths[1];
        }
        $verbos=$this->request->getPost('Verbos');
        $respuesta=$this->grabaRoute($nombre,$estructura,$controlador,$metodo,$verbos,$permisos);
        if ($respuesta['exito']){
            $respuesta=$this->creaControlador($nombre,$estructura,$controlador,$metodo,$verbos,$permisos);
            if ($respuesta['exito']){
                $respuesta=$this->creaVista($nombre,$estructura);
            }
        }
        return json_encode($respuesta);
    }
  
    public function menus()
    {
        //Zona de configuración
        if (!tienePermiso(1)) return view('no_autorizado');
        $txtMenu=env('Config\VstPortal.menuLateral')==''?'[]':env('Config\VstPortal.menuLateral');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_lateral']=$this->menu_a_lista(json_decode($txtMenu,true));
        $txtMenu=env('Config\VstPortal.menuSuperior')==''?'[]':env('Config\VstPortal.menuSuperior');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_superior']=$this->menu_a_lista(json_decode($txtMenu,true));
        $txtMenu=env('Config\VstPortal.menuConfig')==''?'[]':env('Config\VstPortal.menuConfig');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_config']=$this->menu_a_lista(json_decode($txtMenu,true));
        return view('Modulos\Vpconfig\Views\configurador_menus',$this->data);
    }
    public function anade_item_lateral(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado creando item menu lateral'];
        $txtMenu=env('Config\VstPortal.menuLateral')==''?'[]':env('Config\VstPortal.menuLateral');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_lateral']=$this->menu_a_lista(json_decode($txtMenu,true));
        $this->data['menu_lateral'][]=[
                                        $this->request->getPost('Nombre'),
                                        $this->request->getPost('Orden'),
                                        $this->request->getPost('Icono'),
                                        $this->request->getPost('Etiqueta'),
                                        $this->request->getPost('Link'),
                                        $this->request->getPost('Padre'),
                                        $this->request->getPost('Acceso'),
        ];
        $menu=$this->lista_a_menu($this->data['menu_lateral']);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuLateral\s*=\s*'.*'/","Config\\VstPortal.menuLateral = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function elimina_items_laterales(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado borrando item'];
        $lista=json_decode($this->request->getPost('lista'),true);
        $txtMenu=env('Config\VstPortal.menuLateral')==''?'[]':env('Config\VstPortal.menuLateral');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $menuAntes=$this->menu_a_lista(json_decode($txtMenu,true));
           
        $nuevoMenu=[];
        foreach($menuAntes as $unItem){
            if (!in_array($unItem[0],$lista)){
                $nuevoMenu[]=$unItem;
            }
        }
        $menu=$this->lista_a_menu($nuevoMenu);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuLateral\s*=\s*'.*'/","Config\\VstPortal.menuLateral = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function modifica_item_lateral(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado modificando item menu lateral'];
        $txtMenu=env('Config\VstPortal.menuLateral')==''?'[]':env('Config\VstPortal.menuLateral');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_lateral']=$this->menu_a_lista(json_decode($txtMenu,true));
        foreach($this->data['menu_lateral'] as $i=>$unItem){
            if ($unItem[0]==$this->request->getPost('Nombre')){
                $this->data['menu_lateral'][$i]=[
                    $this->request->getPost('Nombre'),
                    $this->request->getPost('Orden'),
                    $this->request->getPost('Icono'),
                    $this->request->getPost('Etiqueta'),
                    $this->request->getPost('Link'),
                    $this->request->getPost('Padre'),
                    $this->request->getPost('Acceso'),
                ];
            }
        }
        $menu=$this->lista_a_menu($this->data['menu_lateral']);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuLateral\s*=\s*'.*'/","Config\\VstPortal.menuLateral = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function anade_item_superior(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado creando item menu superior'];
        $txtMenu=env('Config\VstPortal.menuSuperior')==''?'[]':env('Config\VstPortal.menuSuperior');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_superior']=$this->menu_a_lista(json_decode($txtMenu,true));
        $this->data['menu_superior'][]=[
                                        $this->request->getPost('Nombre'),
                                        $this->request->getPost('Orden'),
                                        $this->request->getPost('Icono'),
                                        $this->request->getPost('Etiqueta'),
                                        $this->request->getPost('Link'),
                                        $this->request->getPost('Padre'),
                                        $this->request->getPost('Acceso'),
        ];
        $menu=$this->lista_a_menu($this->data['menu_superior']);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuSuperior\s*=\s*'.*'/","Config\\VstPortal.menuSuperior = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function elimina_items_superiores(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado borrando item de menu superior'];
        $lista=json_decode($this->request->getPost('lista'),true);
        $txtMenu=env('Config\VstPortal.menuSuperior')==''?'[]':env('Config\VstPortal.menuSuperior');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $menuAntes=$this->menu_a_lista(json_decode($txtMenu,true));
           
        $nuevoMenu=[];
        foreach($menuAntes as $unItem){
            if (!in_array($unItem[0],$lista)){
                $nuevoMenu[]=$unItem;
            }
        }
        $menu=$this->lista_a_menu($nuevoMenu);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuSuperior\s*=\s*'.*'/","Config\\VstPortal.menuSuperior = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function modifica_item_superior(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado modificando item menu superior'];
        $txtMenu=env('Config\VstPortal.menuSuperior')==''?'[]':env('Config\VstPortal.menuSuperior');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_superior']=$this->menu_a_lista(json_decode($txtMenu,true));
        foreach($this->data['menu_superior'] as $i=>$unItem){
            if ($unItem[0]==$this->request->getPost('Nombre')){
                $this->data['menu_superior'][$i]=[
                    $this->request->getPost('Nombre'),
                    $this->request->getPost('Orden'),
                    $this->request->getPost('Icono'),
                    $this->request->getPost('Etiqueta'),
                    $this->request->getPost('Link'),
                    $this->request->getPost('Padre'),
                    $this->request->getPost('Acceso'),
                ];
            }
        }
        $menu=$this->lista_a_menu($this->data['menu_superior']);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuSuperior\s*=\s*'.*'/","Config\\VstPortal.menuSuperior = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function anade_item_config(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado creando item menu configuración'];
        $txtMenu=env('Config\VstPortal.menuConfig')==''?'[]':env('Config\VstPortal.menuConfig');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_config']=$this->menu_a_lista(json_decode($txtMenu,true));
        $this->data['menu_config'][]=[
                                        $this->request->getPost('Nombre'),
                                        $this->request->getPost('Orden'),
                                        $this->request->getPost('Icono'),
                                        $this->request->getPost('Etiqueta'),
                                        $this->request->getPost('Link'),
                                        $this->request->getPost('Padre'),
                                        $this->request->getPost('Acceso'),
        ];
        $menu=$this->lista_a_menu($this->data['menu_config']);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuConfig\s*=\s*'.*'/","Config\\VstPortal.menuConfig = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function elimina_items_config(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado borrando item'];
        $lista=json_decode($this->request->getPost('lista'),true);
        $txtMenu=env('Config\VstPortal.menuConfig')==''?'[]':env('Config\VstPortal.menuConfig');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $menuAntes=$this->menu_a_lista(json_decode($txtMenu,true));
           
        $nuevoMenu=[];
        foreach($menuAntes as $unItem){
            if (!in_array($unItem[0],$lista)){
                $nuevoMenu[]=$unItem;
            }
        }
        $menu=$this->lista_a_menu($nuevoMenu);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuConfig\s*=\s*'.*'/","Config\\VstPortal.menuConfig = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function modifica_item_config(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado modificando item menu configuración'];
        $txtMenu=env('Config\VstPortal.menuConfig')==''?'[]':env('Config\VstPortal.menuConfig');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_config']=$this->menu_a_lista(json_decode($txtMenu,true));
        foreach($this->data['menu_config'] as $i=>$unItem){
            if ($unItem[0]==$this->request->getPost('Nombre')){
                $this->data['menu_config'][$i]=[
                    $this->request->getPost('Nombre'),
                    $this->request->getPost('Orden'),
                    $this->request->getPost('Icono'),
                    $this->request->getPost('Etiqueta'),
                    $this->request->getPost('Link'),
                    $this->request->getPost('Padre'),
                    $this->request->getPost('Acceso'),
                ];
            }
        }
        $menu=$this->lista_a_menu($this->data['menu_config']);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuConfig\s*=\s*'.*'/","Config\\VstPortal.menuConfig = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }


    public function permisos()
    {
        $db = \Config\Database::connect();
        $this->data['permisos']=$db->table('permisos')->get()->getResult();
        return view('Modulos\Vpconfig\Views\configurador_permisos',$this->data);
    }
    public function anade_permiso(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado creando permiso'];
        $db = \Config\Database::connect();
        if (!$db->table('permisos')->ignore(true)->insert([
            'id_per'=>$this->request->getPost('Código'),
            'desc_per'=>$this->request->getPost('Descripción'),
        ])){
            $respuesta['mensaje']=json_encode($db->error());
        }
        else{
            $respuesta['exito']=true;
            $respuesta['mensaje']='';
        }
        return json_encode($respuesta);
    }
    public function elimina_permisos(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado borrando página'];
        $lista=json_decode($this->request->getPost('lista'),true);
        if (count($lista)>0){
            $db = \Config\Database::connect();
            if (!$db->table('permisos')->where('id_per IN ('.implode(',',$lista).')')->delete()){
                $respuesta['mensaje']=json_encode($db->error());
            }
            else{
                $respuesta['exito']=true;
                $respuesta['mensaje']='';
            }
        }
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function modifica_permiso(){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado modificando item menu lateral'];
        $txtMenu=env('Config\VstPortal.menuLateral')==''?'[]':env('Config\VstPortal.menuLateral');
        if (substr($txtMenu,0,1)=="'") $txtMenu=substr($txtMenu,1,-1);
        $this->data['menu_lateral']=$this->menu_a_lista(json_decode($txtMenu,true));
        foreach($this->data['menu_lateral'] as $i=>$unItem){
            if ($unItem[0]==$this->request->getPost('Nombre')){
                $this->data['menu_lateral'][$i]=[
                    $this->request->getPost('Nombre'),
                    $this->request->getPost('Orden'),
                    $this->request->getPost('Icono'),
                    $this->request->getPost('Etiqueta'),
                    $this->request->getPost('Link'),
                    $this->request->getPost('Padre'),
                    $this->request->getPost('Acceso'),
                ];
            }
        }
        $menu=$this->lista_a_menu($this->data['menu_lateral']);
        $ficheroENV=file_get_contents('.env');
        $ficheroENV=preg_replace("/Config\\\\VstPortal\.menuLateral\s*=\s*'.*'/","Config\\VstPortal.menuLateral = '".json_encode($menu)."'", $ficheroENV);
        file_put_contents('.env',$ficheroENV);
        $respuesta['exito']=true;
        return json_encode($respuesta);
    }
    public function ayuda(){
        $parsedown=new \Parsedown();
        $this->data['texto']=$parsedown->text(file_get_contents('README.md'));
        return view('Modulos\Vpconfig\Views\vista_ayuda',$this->data);
    }   
    
    
    //Auxiliares
    private function leePaginasDeRouter(){
        $paginas=[];
        $ficheroRoutes=file_get_contents('modulos/pagina/Config/Routes.php');
        preg_match_all('/^\s*\$routes->(get|post)\((?:\'|\")(.*?)(?:\'|\"), *(?:\'|\")(.*?)::(.*?)(?:\'|\")\); *(\/\/.*?)\n/im', $ficheroRoutes, $matches, PREG_PATTERN_ORDER);
        if (count($matches)==6){
            for ($i=0; $i < count($matches[0]); $i++) { 
                $verbo=$matches[1][$i]=='get'?'g':'p';
                $controlador=$matches[2][$i];
                $metodo=$matches[4][$i];
                $nombre=substr($controlador,1);
                $estructura='';
                $permisos='';
                $comentario=$matches[5][$i];
                preg_match('/\/\/Vpconf: \[\'(.+?)\',\'(.+?)\',\'(.*?)\'/i',$comentario,$parte);
                if (count($parte)==4){
                    $nombre=$parte[1];
                    $estructura=$parte[2];
                    $permisos=$parte[3];
                }
                $estaba=false;
                foreach($paginas as $j=>$otraPagina){
                    if ($otraPagina[2]==$controlador){
                        if ((($otraPagina[3]=='g')&&($verbo=='p'))||
                            (($otraPagina[3]=='p')&&($verbo=='g'))){
                                $paginas[$j][3]='g+p';
                                $estaba=true;
                                break;
                        }
                    }
                }
                if (!$estaba)
                    $paginas[]=[$nombre,$estructura,$controlador,$verbo,$permisos];
            }
        }
        return $paginas;
    }
    private function grabaRoute($nombre,$estructura,$controlador,$metodo,$verbos,$permisos){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado grabando route'];
        $lineaGet='';
        $lineaPost='';
        $ficheroRoutes=file_get_contents('modulos/pagina/Config/Routes.php');
        preg_match_all('/\$routes->(get|post)\((?:\'|\")(.*?)(?:\'|\"), *(?:\'|\")(.*?)::(.*?)(?:\'|\")\); *(\/\/.*?)?\n/im', $ficheroRoutes, $matches, PREG_PATTERN_ORDER);
        if (count($matches)==6){
            for ($i=0; $i < count($matches[0]); $i++) { 
                if ($matches[2][$i]=='/'.($controlador=='inicio'?'':$controlador).($metodo!='index'?'/'.$metodo:'')){
                    if ($matches[1][$i]=='get'){
                        $lineaGet=$matches[0][$i];
                    }
                    if ($matches[1][$i]=='post'){
                        $lineaPost=$matches[0][$i];
                    }
                }
            }
        }
        preg_match("/<\?php((?:.|\n)*)(?:\?>)/i", $ficheroRoutes, $matches); 
        if (count($matches)>0){
            $contenido=$matches[1];
            $nuevoGet="\$routes->get('/".($controlador!='inicio'?$controlador:'').($metodo!='index'?'/'.$metodo:'')."', '\\Modulos\\Pagina\\Controllers\\".ucfirst($controlador)."::".$metodo."'); //Vpconf: ['$nombre','$estructura','$permisos']";
            if ($lineaGet!=''){
                $contenido=str_replace($lineaGet,$nuevoGet,$contenido);
            }
            else{
                $contenido.=$nuevoGet."\n";
            }
            if ($verbos=='g+p'){
                $nuevoPost=str_replace('->get(','->post(',$nuevoGet);
                if ($lineaPost!=''){
                    $contenido=str_replace($lineaPost,$nuevoPost,$contenido);
                }
                else{
                    $contenido.=$nuevoPost."\n";
                }
            }
            else{
                if ($lineaPost!='') str_replace($lineaPost,'',$contenido);
            }
            file_put_contents('modulos/pagina/Config/Routes.php',"<?php".$contenido."\n?>");

            $respuesta['mensaje']='';
            $respuesta['exito']=true;
        }
        else{
            $respuesta['mensaje']='Hay un problema con el fichero "modulos/pagina/Config/Routes.php"';    
        }
        return $respuesta;
    }
    private function creaControlador($nombre,$estructura,$controlador,$metodo,$verbos,$permisos){
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado creando el controlador'];
        $Controlador=ucfirst($controlador);
        $ficheroControlador='modulos/pagina/Controllers/'.$Controlador.'.php';
        $arPermisos=$permisos;
        if ($arPermisos=='')
            $arPermisos=[0];
        else
            $arPermisos=explode(',',$permisos);
        $txPermisos='['.implode(",",$arPermisos).']';
        $funcion=
<<<PHP
        public function $metodo()
        {
            //Vpconf> permiso $metodo
            //Vpconf<
    
PHP;
        if ($verbos=='g+p'){
            $funcion.=
<<<PHP
            if (strtolower(\$this->request->getMethod()) !== 'post') {
    
            }
            else{
    
            }
    
PHP;
        } 
        $funcion.=
<<<PHP
                \$this->data['VPConf']=config('VstPortal');
                return view('\Modulos\Pagina\\vista_$nombre',\$this->data);
        }
PHP;
        $contenido='';
        if (file_exists($ficheroControlador)){
            $contenido=file_get_contents($ficheroControlador);
        }
        else{
            $contenido.=
<<<PHP
<?php
namespace Modulos\Pagina\Controllers;
use App\Controllers\BaseController;

class $Controlador extends BaseController
{
    protected \$helpers=['autorizaciones','enlaces'];
    
    //Vpconf> declaraciones
    private \$data;    
    //Vpconf<

    public function initController(
        \CodeIgniter\HTTP\RequestInterface \$request,
        \CodeIgniter\HTTP\ResponseInterface \$response,
        \Psr\Log\LoggerInterface \$logger
    ) {
        parent::initController(\$request, \$response, \$logger);
        
        \$this->data['enlaces']=[];
        enlaces(\$this->helpers,\$this->data['enlaces']);
        if (!(\$this->data['usuario']=datos_usuario()))
            return redirect('login');
        
        
    }
$funcion
}
?>
PHP;
        }
        preg_match_all('/m|l|e|E|u|p|P/',$estructura,$matches);
        if (count($matches[0])>0){
            $contenido=$this->anade_helpers(['Modulos\Vpbasicos\navegacion'],$contenido);
        }
        $sustituto=
<<<PHP
//Vpconf> permiso $metodo
        if (!tienePermiso($txPermisos)) return view('no_autorizado');
//Vpconf<

PHP;
        if (!preg_match('/public function '.$metodo.'\(\)(\s*){(.*)\}/s',$contenido)){
            $contenido=preg_replace('/\}([^\}]*)\?>/s','',$contenido);
            $contenido.=$funcion."\n}\n?>";   
        }
        $contenido=preg_replace('/\/\/Vpconf> permiso '.$metodo.'((.|\n)+?)\/\/Vpconf</im',$sustituto,$contenido);
        file_put_contents($ficheroControlador,$contenido);
        chmod($ficheroControlador, 0664);
        chgrp($ficheroControlador, 'ubuntu');
        $respuesta['exito']=true;
        $respuesta['mensaje']='';
        return $respuesta;
    }
    private function creaVista($nombre,$estructura){
        
        //Estructura
        //   m: menu lateral
        //   e: encabezado (logo)
        //   b: barra superior
        //   B: barra superior fixed
        //   u: cuadro usuario en encabezado
        //   c: menu configuracion
        //   p: pie
        //   P: pie fixed
        
        $respuesta=['exito'=>false, 'mensaje'=>'Error indeterminado creando la vista'];
        $ficheroVista='modulos/pagina/Views/vista_'.$nombre.'.php';
        $contenido='';
        if (file_exists($ficheroVista)){
            $contenido=file_get_contents($ficheroVista);
        }
        else{
            $sidebar=strpos($estructura,'m')!==false?'sidebar-mini':'layout-top-nav';
            $contenido.=
<<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= \$VPConf->tituloWeb ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('public/assets/imagenes','https') ?>/confFavicon.png">
    <?= inserta_enlaces(\$enlaces) ?>
<style>
    .imagenConfig:hover{
        cursor: pointer;
        box-shadow: 0px 0px 15px yellow;
    }
</style>
</head>
<body class="hold-transition $sidebar layout-fixed text-<?= \$VPConf->tamanoTexto ?> <?= \$VPConf->tonalidad ?>">
 <div class="wrapper">
<!-- Vpconf> barra (Zona sujeta a cambios automáticos)-->
<!-- Vpconf< barra -->
HTML;
            if (strpos($estructura,'m')!==false){
                $contenido.=
<<<HTML
<!-- Vpconf> aside (Zona sujeta a cambios automáticos)-->
    <aside class="main-sidebar sidebar-<?= \$VPConf->lateralDark ?>-<?= \$VPConf->lateralDestacado ?> elevation-4">
    </aside>
<!-- Vpconf< aside -->
HTML;
            }
            $contenido.=
<<<HTML
    <div class="content-wrapper">
        <div class="content-header">
        </div>
        <section class="content">
            <div class="container-fluid">
            </div>
        </section>
    </div>
<!-- Vpconf> pie (Zona sujeta a cambios automáticos)-->
<!-- Vpconf< pie -->
 </div>
</body>
</html>
HTML;
        }

        //Inserto logo y menu lateral
        if ((strpos($estructura,'m')!==false)||(strpos($estructura,'e')!==false)){
            $sustituto=
<<<HTML
<!-- Vpconf> aside (Zona sujeta a cambios auutomáticos)-->
    <aside class="main-sidebar sidebar-<?= \$VPConf->lateralDark ?>-<?= \$VPConf->lateralDark ?> elevation-4">

HTML;
            if (strpos($estructura,'e')!==false){
                $sustituto.=
<<<HTML
                <?= encabezado(base_url(''),base_url('public/assets/imagenes').'/logotipo'.(\$VPConf->UAT?"UAT":"").'.png',\$VPConf->nombreCliente) ?>

HTML;
            }
            if (strpos($estructura,'m')!==false){
                $sustituto.=
<<<HTML
                <?= sidebar(json_decode(\$VPConf->menuLateral,true)) ?>

HTML;
            }
            $sustituto.=
<<<HTML

    </aside>
<!-- Vpconf< aside -->

HTML;
            $contenido=preg_replace('/<!-- Vpconf> aside((.|\n)+)<!-- Vpconf< aside -->/im',$sustituto,$contenido);
        }
       
        //Inserto pie
        if ((strpos($estructura,'p')!==false)||(strpos($estructura,'P')!==false)){
            $fijo=(strpos($estructura,'P')!==false)?'true':'false';
            $sustituto=
<<<HTML
<!-- Vpconf> pie (Zona sujeta a cambios automáticos)-->
    <?= pie(\$VPConf->contenidoPie,'',$fijo) ?>
<!-- Vpconf< pie -->
HTML;
            $contenido=preg_replace('/<!-- Vpconf> pie((.|\n)+)<!-- Vpconf< pie -->/im',$sustituto,$contenido);
        }

        //Inserto encabezado
        if ((strpos($estructura,'b')!==false)||(strpos($estructura,'B')!==false)){
            $fijo=(strpos($estructura,'B')!==false)?'true':'false';
            $componentes=[];
            if (strpos($estructura,'u')!==false){
                $componentes[]="['tipo'=>'usuario']";
            }
            if (strpos($estructura,'c')!==false){
                $componentes[]="['tipo'=>'configuracion','titulo'=>'Configuracion', 'menu'=>\$VPConf->menuConfig]";
            }
            $componentes=implode(',',$componentes);
            $esquina=(strpos($estructura,'m')!==false)?"'menu'":
                                                    'encabezado(base_url(""),base_url("public/assets/imagenes")."/logotipo".(\$VPConf->UAT?"UAT":"").".png",\$VPConf->nombreCliente)';
            $sustituto=
<<<HTML
<!-- Vpconf> barra (Zona sujeta a cambios automáticos)-->
    <?= barraNavegacion(json_decode(\$VPConf->menuSuperior,true),[$componentes],'',$esquina,$fijo) ?>
<!-- Vpconf< barra -->
HTML;
            $contenido=preg_replace('/<!-- Vpconf> barra((.|\n)+)<!-- Vpconf< barra -->/im',$sustituto,$contenido);
        }

        file_put_contents($ficheroVista,$contenido);
        chmod($ficheroVista, 0664);
        chgrp($ficheroVista, 'ubuntu');
        $respuesta['exito']=true;
        $respuesta['mensaje']='';
        return $respuesta;
    }
    private function anade_helpers($lista,$contenido){
        preg_match('/\$helpers\s*=\s*\[(.*)\]/i',$contenido,$matches);
        if (count($matches)>0){
            $actual=explode(",",$matches[1]);
            $anadir=$contenido;
            foreach($actual as $i=>$unActual){
                $actual[$i]=trim(str_replace("'",'',str_replace('"','',$unActual)));
            }
            foreach($lista as $unoNuevo){
                if (!in_array($unoNuevo,$actual)){
                    $actual[]=$unoNuevo;
                }
            }
            return str_replace($matches[0],'$helpers=['.(count($actual)>0?'\''.implode("', '",$actual).'\'':'').']',$contenido);
        }
        else
            return $contenido;
    }

    private function menu_a_lista($menu,$padre='',$profundidad=0){
        $lista=[];
        if ($profundidad<10){
            $orden=0;
            foreach($menu as $id=>$unItem){
                $apunte[MENU_COL_NOMBRE]=$id;
                $apunte[MENU_COL_ORDEN]=$orden++;
                $apunte[MENU_COL_ICONO]=$unItem['icono'];
                $apunte[MENU_COL_ETIQUETA]=$unItem['texto'];
                $apunte[MENU_COL_ENLACE]=$unItem['href'];
                $apunte[MENU_COL_PADRE]=$padre;
                $apunte[MENU_COL_AUT]=$unItem['aut'];
                array_push($lista,$apunte);
                if (isset($unItem['menu'])){
                    $lista=array_merge($lista,$this->menu_a_lista($unItem['menu'],$id,$profundidad+1));
                }
            }
        }
        return $lista;
    }
    private function lista_a_menu($lista){
        $menu=[];
        $slista=$lista;
        log_message('debug',print_r($lista,true));
        usort($slista, function ($a,$b){
            if ($a[MENU_COL_PADRE]??''==''){
                if ($b[MENU_COL_PADRE]??''==''){
                    if ($a[MENU_COL_ORDEN]==$b[MENU_COL_ORDEN]){
                        return 0;
                    }
                    else{
                        if ($a[MENU_COL_ORDEN]<$b[MENU_COL_ORDEN]){
                            return -1;
                        }
                        else{
                            return 1;
                        }
                    }
                }
                else{
                  return 1;  
                }
            }
            else{
                //$a tiene padre
                if ($b[MENU_COL_PADRE]??''==''){
                    return -1;
                }
                else{
                    if ($a[MENU_COL_PADRE]==$b[MENU_COL_PADRE]){
                        if ($a[MENU_COL_ORDEN]==$b[MENU_COL_ORDEN]){
                            return 0;
                        }
                        else{
                            if ($a[MENU_COL_ORDEN]<$b[MENU_COL_ORDEN]){
                                return -1;
                            }
                            else{
                                return 1;
                            }
                        }
                    }
                    else{
                        if ($a[MENU_COL_PADRE]<$b[MENU_COL_PADRE]){
                            return -1;
                        }
                        else{
                            return 1;
                        }
                    }
                }
            }
        });
        log_message('debug',print_r($slista,true));
        foreach($slista as $unApunte){
            $item=[
                'texto'=>$unApunte[MENU_COL_ETIQUETA],
                'icono'=>$unApunte[MENU_COL_ICONO],
                'href'=>$unApunte[MENU_COL_ENLACE],
                'aut'=>$unApunte[MENU_COL_AUT]
            ];
            if ($unApunte[MENU_COL_PADRE]==''){
                $menu[$unApunte[MENU_COL_NOMBRE]]=$item;
            }
            else{
                $this->coloca_en_menu($unApunte[MENU_COL_PADRE],$menu,$unApunte[MENU_COL_NOMBRE],$item);
                
            }
        }
        return $menu;
    }
    private function coloca_en_menu($id,&$menu,$clave,$item,$profundidad=0){
        if ($profundidad<10){
            foreach($menu as $idPadre=>$unItem){
                if ($idPadre==$id){
                    if (!isset($menu[$id]['menu'])){
                        $menu[$id]['menu']=[];
                    };
                    $menu[$id]['menu'][$clave]=$item;
                    return true;
                }
                else{
                    if (isset($unItem['menu'])){
                        if (count($unItem['menu'])>0){
                            if ($this->coloca_en_menu($id,$unItem['menu'],$clave,$item,$profundidad+1)){
                                return true;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }
}
