<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PermisosModel;
use App\Models\RolesModel;
use App\Models\MenusModel;

class Roles extends BaseController{

    protected $clase;
    protected $permisos;
    protected $reglas;

    public function __construct(){
        $this->permisos = new PermisosModel();
        $this->roles = new RolesModel();
        $this->menus = new MenusModel();

        $router = \Config\Services::router();
        $_method = $router->methodName();
        $_controller = $router->controllerName();         
        $controlador = explode('\\', $_controller) ;
        $this->clase = $controlador[max(array_keys($controlador))] ;
    }
    public function index($activo = 1){
        if($this->session->has('id_usuario') === false) { 
            return redirect()->to(base_url()); 
        }
        $permisos = $this->permisos->where('activo',$activo)->findAll();
        $menus = $this->menus->where('activo',$activo)->findAll();
        $roles = $this->roles->where('activo',$activo)->findAll();
        $data = [ 
            'titulo'   => $this->clase,
            'menus'    => $menus,
            'roles'    => $roles,
            'permisos' => $permisos,
        ];
		echo view('header');
		echo view('roles/roles', $data);
		echo view('footer');
		//echo view('dashboard');
    }
    public function eliminados($activo = 0)
    {
        $roles = $this->roles->where('activo',$activo)->findAll();
        $data = [ 
            'titulo' => 'Roles eliminadas',
            'datos'  => $roles
        ];
		echo view('header');
		echo view('roles/eliminadas', $data);
		echo view('footer');
		//echo view('dashboard');
	}
    public function nuevo(){		

        $roles = $this->roles->where('activo', 1 )->findAll();

        $data = [ 
            'titulo'     => 'Agregar permiso',
            'roles'   => $roles,
            ];

        echo view('header');
		echo view('roles/nuevo', $data);
		echo view('footer');
    }

    public function validoReglasRecargaPermisos(){
        $msgToast = [
            's2Titulo' => $this->clase, 
            's2Texto' => 'Datos insertados',
            's2Icono' => 'success',
            's2Toast' => 'true'
        ];

        //$permisos = $this->permisos->where('activo',1)->findAll();
        $roles = $this->roles->where('activo', 1 )->findAll();
        // $categorias = $this->categorias->where('activo', 1)->findAll();

        $data = [ 
            'titulo' => $this->clase,
            'datos' => $roles,
            'roles'   => $roles,
        ];
        echo view('header');
        echo view('sweetalert2', $msgToast);            
        echo view('roles/roles', $data);
        echo view('footer');
    }
    public function novalidoReglasRecargaPermisos(){
        $roles = $this->roles->where('activo', 1 )->findAll();
//        $categorias = $this->categorias->where('activo', 1)->findAll();

        $data = [ 
            'titulo'     => $this->clase,
            'roles'   => $roles,
  //          'categorias' => $categorias,
            'validation' => $this->validator 
            ];        
            $msgToast = [
                's2Titulo' => $this->clase, 
                's2Texto' => 'No se validaron las reglas.',
                's2Icono' => 'warning',
                's2Toast' => 'true'
            ];
            echo view('header');
            echo view('sweetalert2', $msgToast);                    
            echo view('roles/nuevo', $data);
            echo view('footer');
    }
    public function insertar(){
        if($this->request->getMethod() == "post"){
            // Valido las Reglas
            $this->roles->save(
            ['menu_id' => $this->request->getPost('menu_id'),
            'rol'=> $this->request->getPost('rol_id'),
            'rol_id'=> $this->request->getPost('read'),
            'read'=> $this->request->getPost('read'),
            'insert'=> $this->request->getPost('insert'),
            'update'=> $this->request->getPost('update'),
            'delete'=> $this->request->getPost('delete'),
            ]);   

            $this->validoReglasRecargaPermisos();
        }else{
            $this->novalidoReglasRecargaPermisos();
        }        
    }
    public function editar($id){
        
        $roles = $this->roles->where('id',$id)->where('activo', 1)->first();

        $roles = $this->roles->where('activo', 1 )->findAll();
        $menus = $this->menus->where('activo', 1)->findAll();       

        $id = $roles['id'];
    
        $data = [
            'titulo' => 'Editar ' . $this->clase,   
            'menu_id' => $roles['menu_id'],
            'rol_id'  => $roles['rol_id'],
            'insert'  => $roles['insert'],
            'update'  => $roles['update'],
            'delete'  => $roles['delete'],
            ];
        echo view('header');
        //echo view('sweetalert2', $msgToast);                    
		echo view('roles/editar', $data);
		echo view('footer');
    }
    public function actualizar(){
        $this->roles->update($this->request->getPost('id'),
            ['menu_id' => $this->request->getPost('menu_id'),
            'rol'=> $this->request->getPost('rol_id'),
            'rol_id'=> $this->request->getPost('read'),
            'read'=> $this->request->getPost('read'),
            'insert'=> $this->request->getPost('insert'),
            'update'=> $this->request->getPost('update'),
            'delete'=> $this->request->getPost('delete'),
            ]);   

            $msgToast = [
                's2Titulo' => $this->clase, 
                's2Texto' => 'Actualizado',
                's2Icono' => 'success',
                's2Toast' => 'true'
            ];
            $roles = $this->roles->where('activo', 1 )->findAll();
            $data = [ 
                'titulo' => $this->clase,
                'datos' => $roles
            ];
            echo view('header');
            echo view('sweetalert2', $msgToast);            
            echo view($this->clase . '/'. $this->clase, $data);
            echo view('footer');
    }
    public function eliminar($id){
        $this->roles->update($id,
            [
               'activo' => 0
            ]);   
            $msgToast = [
                's2Titulo' => $this->clase, 
                's2Texto' => 'Eliminado',
                's2Icono' => 'success',
                's2Toast' => 'true'
            ];
            $roles = $this->roles->where('activo', 1 )->findAll();
            $data = [ 
                'titulo' => 'Roles',
                'datos' => $roles
            ];
            echo view('header');
            echo view('sweetalert2', $msgToast);            
            echo view('roles/roles', $data);
            echo view('footer');        
    }
    public function reingresar($id){
        $this->roles->update($id,
            [
               'activo' => 1
            ]);   
        return redirect()->to(base_url().'/'.$this->clase);
    }
    public function buscarPorCodigo($codigo){
        $this->roles->select('*');
        $this->roles->where('codigo', $codigo);
        $this->roles->where('activo', '1');
        $datos = $this->roles->get()->getRow();

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';
        $error = '';
        if($datos){
            $res['datos'] = $datos;
            $res['existe'] = true;
        }else{
            $res['error']  = 'No existe el Rol';
            $res['existe'] = false;
        }
        echo json_encode($res);
    }
}


