<?php
namespace Modulos\Pagina\Controllers;
use App\Controllers\BaseController;

class Campo extends BaseController
{
    protected $helpers=['autorizaciones', 'enlaces', 'Modulos\Vpbasicos\navegacion'];
    
    //Vpconf> declaraciones
    private $data;    
    //Vpconf<

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        
        $this->data['enlaces']=[];
        enlaces($this->helpers,$this->data['enlaces']);
        if (!($this->data['usuario']=datos_usuario()))
            return redirect('login');
        
        
    }
        public function modificar()
        {
            //Vpconf> permiso modificar
        if (!tienePermiso([2])) return view('no_autorizado');
//Vpconf<







                if (strtolower($this->request->getMethod()) !== 'post') {
    
            }
            else{
    
            }
                    $this->data['VPConf']=config('VstPortal');
                return view('\Modulos\Pagina\vista_CampoModificar',$this->data);
        }
}
?>