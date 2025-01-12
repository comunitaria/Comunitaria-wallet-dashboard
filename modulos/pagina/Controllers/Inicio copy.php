<?php

namespace Modulos\Pagina\Controllers;
use App\Controllers\BaseController;
use Modulos\Pagina\Models\Cls_peticiones;

class Inicio extends BaseController
{
    protected $helpers=['autorizaciones','enlaces', 'Modulos\Vpbasicos\navegacion', 'Modulos\Vpbasicos\tabla_helper'];
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
            ],
            'menuNav'=>[
                ['texto'=>'Página inicio', 'href'=>base_url(), 'aut'=>'1']
            ],
            'componentesNav'=>[
                ['tipo'=>'usuario']
            ],

        ];
        $this->data=array_merge($this->data,$this->comunesPagina);

        //Enlaces de helpers visuales:
        $this->data['enlaces']=[];
        enlaces_navegacion($this->data['enlaces']);

        // $this->Cls_peticiones = new Peticiones();
    }

    public function index()
    {
        /* INICIADOR  
            Aquí vemos si se ha iniciado ya el framework, en cuyo caso vamos a la página de bienvenida.
            Si no, vamos a la zona de configuración con la orden de inicializar
        */
        if ($_ENV['database.default.database']==''){
        //Valor por defecto: ir a inicialización   
            return $this->vpconf();
        }
        else{
        //Ya está configurado, mostramos pantalla de login o bienvenida:
            if (!($this->data['usuario']=datos_usuario()))
                return redirect()->to('login');

            $this->data['VPConf']=config('VstPortal');

            $datosUser = $this->data['usuario']=datos_usuario();
            $datos = $this->consultarPeticiones($datosUser);
            var_dump($datos); //datos del usuario de aqui debo coger el id

            $departamento = "Comercial";
            // $model = new Cls_peticiones();

            $MPeticiones=model('Modulos\Pagina\Models\Cls_peticiones');
            $this->data['peticiones']=$MPeticiones->get()->getResult();//->where('propietario',$departamento)->get()->getResult();
            return view('\Modulos\Pagina\bienvenida.php',$this->data);
        }
    }

    public function consultarPeticiones($datosUser){

        //tenemos que, segun el user, coger el perfil que tiene el usuario y a raiz de eso, recuperar las peticiones
        //que coincidan con el mismo id de perfil
        $idUser = $datosUser['idUsuario']; //de aqui debemos sacar el id para ver el perfil y recuperar las peticiones que tengan ese perfil
        // queremos recuperar lo siguiente: 
        // de la tabla de usuario el nombre_usr y además el id_usr correspondiente, de usrperfiles el id_usr y el id_prf y por ultimo el id_prf y el desc_perf
        // dónde el id del usuario es el del usuario logueado
        $cadenaSQL = "SELECT id_usr, id_prf, perfiles.desc_perf, usuarios.nombre_usr FROM usrperfiles
                      LEFT JOIN usuarios ON usuarios.id_usr = usr_perfiles.id_usr
                      RIGHT JOIN perfiles ON perfiles.id_prf = usr_perfiles.id_prf
                      WHERE usuarios.id_usr = " . $idUser;
        return $cadenaSQL;
    }

}
