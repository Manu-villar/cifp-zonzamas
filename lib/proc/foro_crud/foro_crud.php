<?php
    class ForoCRUD extends ProgramaBase
    {
       
        const LIMITE_SCROLL=5;

        function __construct()
        {
            $this->foro=new Foro();

            parent::__construct($this->foro);


        }

        function inicializar()
        {
            $paso        = new Hidden('paso'); 
            $paso->value = 1;

            $oper        = new Hidden('oper'); 
            $id          = new Hidden('id');        

            $nombre      = new Input   ('nombre'       ,['placeholder' => 'Nombre del usuario...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $mensaje     = new Textarea('mensaje'  ,['placeholder' => 'escribe tu mensaje...', 'validar' => True ]);


            $this->form->cargar($paso);
            $this->form->cargar($oper);
            $this->form->cargar($id);
            $this->form->cargar($nombre);
            $this->form->cargar($mensaje);
        }

        function recuperar()
        {

            $this->foro->recuperar($this->form->val['id']);

            $this->form->elementos['nombre']->value   = $this->foro->nombre;
            $this->form->elementos['mensaje']->value  = $this->foro->mensaje;
        }
        function existe($id='')
        {

            $cantidad = 0;
            if (   !empty($this->form->val['nombre']) 
                && !empty($this->form->val['mensaje'])
            )
            {   

                $cantidad = $this->foro->existeMensaje(
                    $this->form->val['nombre']
                ,$this->form->val['mensaje']
                ,$this->form->val['id']
                );
            }

            return $cantidad;
        }


        function resultados_busqueda()
        {
            $salida='';
            $salida .= $this->cargar_foro();
            $salida .= "<div class=\"alta\">". enlace("/{$this->seccion}/alta/", "Nuevo mensaje",['class' => 'btn btn-success mt-2']) ."</div>";
            return $salida;

        }


        function cargar_foro()
        {
            $html_foro = '';

            $lista_foro = $this->foro->cargar() ;

            foreach($lista_foro as $nombre_mensaje)
            {
                $html_foro .= "

                        <div class=\"bg-info rounded mt-2 container\">
                            <div class=\"d-flex justify-content-between align-items-start\">
                                <div>
                                    <p class=\"fw-bold mb-1\">{$nombre_mensaje['nombre']}
                                    <div class=\"mb-2\">{$nombre_mensaje['mensaje']}</div>
                                </div>
                                <div class=\"d-flex gap-2 mt-2\">
                                    ". enlace("/{$this->seccion}/actualizar/{$nombre_mensaje['id']}",'Actualizar',['class' => 'btn btn-primary']) ."
                                    ". enlace("#",'Eliminar',['class' => 'btn btn-danger','onclick' => "if(confirm('Cuidado, estás tratando de elimnar el mensaje')) location.href = '/{$this->seccion}//eliminar/{$nombre_mensaje['id']}';"]) ."
                                </div>
                            </div>
                        </div>
                ";
            }

            
            
            return $html_foro;
        }







    }


?>