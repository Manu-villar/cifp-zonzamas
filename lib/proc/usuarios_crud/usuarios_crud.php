<?php
    class UsuariosCRUD extends ProgramaBase
    {
        const LIMITE_SCROLL = 5;

        function __construct()
        {
            $this->usuario=new Usuario();
            parent::__construct($this->usuario);
        }
        function inicializar()
        {
            $paso        = new Hidden('paso'); 
            $paso->value = 1;

            $oper        = new Hidden('oper'); 
            $id          = new Hidden('id');         

            $nombre      = new Input   ('nombre'      ,['placeholder' => 'Nombre...'         , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $apellido_1  = new Input   ('apellido_1'  ,['placeholder' => 'primer apellido'             , 'validar' => True, 'ereg' => EREG_TEXTO_150_OBLIGATORIO  ]);
            $apellido_2  = new Input   ('apellido_2'  ,['placeholder' => 'segundo apellido'            , 'validar' => True, 'ereg' => EREG_TEXTO_150_OBLIGATORIO  ]);
            $nif         = new Input   ('nif'         ,['placeholder' => 'documento de identificación' , 'validar' => True, 'ereg' => EREG_TEXTO_150_OBLIGATORIO  ]);

            $this->form->cargar($paso);
            $this->form->cargar($oper);
            $this->form->cargar($id);
            $this->form->cargar($nombre);
            $this->form->cargar($apellido_1);
            $this->form->cargar($apellido_2);
            $this->form->cargar($nif);
        }
        function recuperar()
        {

            $this->usuario->recuperar($this->form->val['id']);

            $this->form->elementos['nombre']->value      = $this->usuario->nombre;
            $this->form->elementos['apellido_1']->value  = $this->usuario->apellido_1;
            $this->form->elementos['apellido_2']->value  = $this->usuario->apellido_2;
            $this->form->elementos['nif']->value         = $this->usuario->nif;
        }

        function resultados_busqueda()
        {
            $salida = '';

            $opciones = ['profesores' => 'Profesores', 'alumnos' => 'Alumnos' ];

            $select_usuarios   = new Select('select_usuarios', $opciones);

            $this->form->cargar($select_usuarios);

            $salida .= $this->form->pintar(['no_pintar_boton' => true]);

            $tipo_usuario = $this->form->val['tipo_usuario'];//asi está en htacces
            
            if(isset($tipo_usuario) || !empty($tipo_usuario))
            {
                $salida .= $this->cargar_usuario($tipo_usuario);
                $salida .= "<div class=\"alta\">". enlace("/{$this->seccion}/{$this->form->val['tipo_usuario']}/alta/", "Alta de {$tipo_usuario}",['class' => 'btn btn-success']) ."</div>";
                
            }
            
            $salida .= $this->javascript();

            

            return $salida;
        }


        function javascript()
        {
            return "
                <script type=\"text/javascript\">
                    
                    idselect_usuarios.addEventListener('click', function(e) {
                        
                        if (e.target.value != '')
                        {
                            location.href = '/usuarios/' + e.target.value  + '/';
                        }

                    });
                            
                </script>
            ";

        }


        function cargar_usuario($tipo_usuario)
        {
            $html_usuario = '';

            $usuario = new Usuario();

            $lista_usuarios =  $usuario->cargar($tipo_usuario);

            $html_usuario = '
                <table class="table">
                    <thead>
                        <tr>
                            <<th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Primer apellido</th>
                            <th scope="col">Segundo apellido</th>
                            <th scope="col">NIF</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
            
            foreach($lista_usuarios as $usuario_unico)
            {
                /* 
                en el httacces se declara la variable tipo_usuario que luego se puede coger con $this->form->val['tipo_usuario']
                con ello accedes al elemento de la url,en el boton eliminar lo envio a la url /usuarios/$this->form->val['tipo_usuario']/eliminar/y el id
                    y ya puedo coger la url la tabla 
                    es decir si quiero eliminar un profesor le inserto $this->form->val['tipo_usuario'] que es lo que me llega por la URL
                */
                $html_usuario .= "
                        <tr>
                            <th scope=\"row\">
                                ". enlace("/{$this->seccion}/actualizar/{$usuario_unico['id']}",'Actualizar',['class' => 'btn btn-primary']) ."
                                ". enlace("#",'Eliminar',['class' => 'btn btn-danger','onclick' => "if(confirm('Cuidado, estás tratando de eliminar a : {$usuario_unico['nombre']} {$usuario_unico['apellido_1']} {$usuario_unico['apellido_2']}')) location.href = '/{$this->seccion}/{$this->form->val['tipo_usuario']}/eliminar/{$usuario_unico['id']}';"]) ."
                            </th>
                            <td>{$usuario_unico['nombre']}</td>
                            <td>{$usuario_unico['apellido_1']}</td>
                            <td>{$usuario_unico['apellido_2']}</td>
                            <td>{$usuario_unico['nif']}</td>
                        </tr>
                    ";

            }
                
            $html_usuario .= '
                    </tbody>
                </table>
            ';

                
            return $html_usuario;
        }
        function existe($id='')
        {

            $cantidad = 0;
            if (   !empty($this->form->val['nombre']) 
                && !empty($this->form->val['apellido_1'])
                && !empty($this->form->val['apellido_1'])
                && !empty($this->form->val['nif'])
            )
            {   

                $cantidad = $this->usuario->existeUsuario(
                    $this->form->val['nombre']
                ,$this->form->val['apellido_1']
                ,$this->form->val['apellido_2']
                ,$this->form->val['nif']
                ,$this->form->val['id']
                );
            }

            return $cantidad;
        }

        
    }
?>

