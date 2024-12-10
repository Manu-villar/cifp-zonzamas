<?php
    class ProductosCRUD extends ProgramaBase
    {
       
        const LIMITE_SCROLL=5;

        function __construct()
        {
            $this->producto=new Productos();

            parent::__construct($this->producto);


        }

        function inicializar()
        {
            $paso        = new Hidden('paso'); 
            $paso->value = 1;

            $oper        = new Hidden('oper'); 
            $id          = new Hidden('id');        

            $nombre          = new Input   ('nombre'        ,['placeholder' => 'Nombre del producto...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $descripcion     = new Textarea('descripcion'   ,['placeholder' => 'escribe tu producto...'     , 'validar' => True ]);
            $precio          = new Input   ('precio'        ,['placeholder' => 'precio del producto...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $disponibilidad  = new Input   ('disponibilidad',['placeholder' => 'disponibilidad del producto...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $accion          = new Input   ('accion'        ,['placeholder' => 'accion del producto...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);


            $this->form->cargar($paso);
            $this->form->cargar($oper);
            $this->form->cargar($id);
            $this->form->cargar($nombre);
            $this->form->cargar($descripcion);
            $this->form->cargar($precio);
            $this->form->cargar($disponibilidad);
            $this->form->cargar($accion);
        }

        function recuperar()
        {

            $this->producto->recuperar($this->form->val['id']);

            $this->form->elementos['nombre']->value         = $this->producto->nombre;
            $this->form->elementos['descripcion']->value    = $this->producto->descripcion;
            $this->form->elementos['precio']->value         = $this->producto->precio;
            $this->form->elementos['disponibilidad']->value = $this->producto->disponibilidad;
            $this->form->elementos['accion']->value         = $this->producto->accion;
        }
        function existe($id='')
        {

            $cantidad = 0;
            if (   !empty($this->form->val['nombre']) 
                && !empty($this->form->val['descripcion'])
                && !empty($this->form->val['precio'])
                && !empty($this->form->val['disponibilidad'])
                && !empty($this->form->val['accion'])

            )
            {   

                $cantidad = $this->producto->existeProducto(
                    $this->form->val['nombre']
                    ,$this->form->val['descripcion']
                    ,$this->form->val['precio']
                    ,$this->form->val['disponibilidad']
                    ,$this->form->val['accion']
                    ,$this->form->val['id']
                );
            }

            return $cantidad;
        }


        function resultados_busqueda()
        {
            $salida='';
            $salida .= $this->cargar_productos();
            $salida .= "<div class=\"alta\">". enlace("/{$this->seccion}/alta/", "Nuevo producto",['class' => 'btn btn-success mt-2']) ."</div>";
            return $salida;

        }


        function cargar_productos()
        {
            $html_productos = '
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Disponibilidad</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
            
            ';

            $lista_productos = $this->producto->cargar() ;

            foreach($lista_productos as $fila)
            {
                $html_productos .= "

                            <tr>
                                <th scope=\"row\">
                                    ". enlace("/{$this->seccion}/actualizar/{$fila['id']}",'Actualizar',['class' => 'btn btn-primary']) ."
                                    ". enlace("#",'Eliminar',['class' => 'btn btn-danger','onclick' => "if(confirm('Cuidado, estás tratando de elimnar el mensaje')) location.href = '/{$this->seccion}//eliminar/{$fila['id']}';"]) ."
                                </th>
                                <td>{$fila['nombre']}</td>
                                <td>{$fila['descripcion']}</td>
                                <td>{$fila['precio']}€</td>
                                <td>{$fila['disponibilidad']}</td>
                                <td>{$fila['accion']}</td>
                            </tr>
                ";
            }

            $html_productos .= "
                    </tbody>
                </table>
            ";
            
            return $html_productos;
        }







    }


?>