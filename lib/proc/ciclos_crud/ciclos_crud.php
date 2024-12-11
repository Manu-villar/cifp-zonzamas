<?php
    class CiclosCRUD extends ProgramaBase
    {
       
        const LIMITE_SCROLL=5;

        function __construct()
        {
            $this->curso=new Ciclo();

            parent::__construct($this->curso);


        }

        function inicializar()
        {
            $paso        = new Hidden('paso'); 
            $paso->value = 1;

            $oper        = new Hidden('oper'); 
            $id          = new Hidden('id');        

            $nombre     = new Input  ('nombre'       ,['placeholder' => 'Nombre del ciclo...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $siglas     = new Input  ('siglas'       ,['placeholder' => 'Nombre del ciclo...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $curso      = new Input   ('curso'       ,['placeholder' => 'Nombre del ciclo...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $letra      = new Input   ('letra'       ,['placeholder' => 'Nombre del ciclo...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);



            $this->form->cargar($paso);
            $this->form->cargar($oper);
            $this->form->cargar($id);
            $this->form->cargar($nombre);
            $this->form->cargar($siglas);
            $this->form->cargar($curso);
            $this->form->cargar($letra);
        }

        function recuperar()
        {

            $this->curso->recuperar($this->form->val['id']);

            $this->form->elementos['nombre']->value   = $this->curso->nombre;
            $this->form->elementos['siglas']->value  = $this->curso->siglas;
            $this->form->elementos['curso']->value  = $this->curso->curso;
            $this->form->elementos['letra']->value  = $this->curso->letra;
        }
        function existe($id='')
        {

            $cantidad = 0;
            if (   !empty($this->form->val['nombre']) 
                && !empty($this->form->val['siglas'])
                && !empty($this->form->val['curso'])
                && !empty($this->form->val['letra'])
            )
            {   

                $cantidad = $this->curso->existeCiclo(
                $this->form->val['nombre']
                ,$this->form->val['siglas']
                ,$this->form->val['curso']
                ,$this->form->val['letra']
                ,$this->form->val['id']
                );
            }

            return $cantidad;
        }


        function resultados_busqueda()
        {
            $salida='';
            $salida .= $this->cargar_ciclos();
            $salida .= "<div class=\"alta\">". enlace("/{$this->seccion}/alta/", "Nuevo mensaje",['class' => 'btn btn-success mt-2']) ."</div>";
            return $salida;

        }


        function cargar_ciclos()
        {
            $html_ciclo = '
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Siglas</th>
                        <th scope="col">Curso</th>
                        <th scope="col">Letra</th>
                    </tr>
                </thead>
                <tbody>
            
            ';

            $lista_ciclos = $this->curso->cargar() ;

            foreach($lista_ciclos as $fila)
            {
                $html_ciclo .= "

                            <tr>
                                <th scope=\"row\">
                                    ". enlace("/{$this->seccion}/actualizar/{$fila['id']}",'Actualizar',['class' => 'btn btn-primary']) ."
                                    ". enlace("#",'Eliminar',['class' => 'btn btn-danger','onclick' => "if(confirm('Cuidado, estás tratando de elimnar el mensaje')) location.href = '/{$this->seccion}//eliminar/{$fila['id']}';"]) ."
                                </th>
                                <td>{$fila['nombre']}</td>
                                <td>{$fila['siglas']}</td>
                                <td>{$fila['curso']}€</td>
                                <td>{$fila['letra']}</td>
                            </tr>
                ";
            }

            $html_ciclo .= "
                    </tbody>
                </table>
            ";

            
            
            return $html_ciclo;
        }







    }


?>