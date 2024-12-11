<?php
    class AulasCRUD extends ProgramaBase
    {
       
        const LIMITE_SCROLL=5;

        function __construct()
        {
            $this->aulas=new Aulas();

            parent::__construct($this->aulas);


        }

        function inicializar()
        {
            $paso        = new Hidden('paso'); 
            $paso->value = 1;

            $oper        = new Hidden('oper'); 
            $id          = new Hidden('id');        

            $nombre  = new Input   ('nombre'       ,['placeholder' => 'Nombre del aula...'        , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $letra   = new Select  ('letra'    ,Aulas::LETRA,['validar' => True]);
            $numero  = new Input   ('numero'       ,['placeholder' => 'numero del aula...'     , 'validar' => True, 'ereg' => EREG_TEXTO_100_OBLIGATORIO  ]);
            $planta  = new Select  ('planta'    ,Aulas::PLANTA,['validar' => True]);


            $this->form->cargar($paso);
            $this->form->cargar($oper);
            $this->form->cargar($id);
            $this->form->cargar($nombre);
            $this->form->cargar($letra);
            $this->form->cargar($numero);
            $this->form->cargar($planta);      
        }

        function recuperar()
        {

            $this->aulas->recuperar($this->form->val['id']);

            $this->form->elementos['nombre']->value   = $this->aulas->nombre;
            $this->form->elementos['letra']->value  = $this->aulas->letra;
            $this->form->elementos['numero']->value  = $this->aulas->numero;
            $this->form->elementos['planta']->value  = $this->aulas->planta;
        }
        function existe($id='')
        {

            $cantidad = 0;
            if (   !empty($this->form->val['nombre']) 
                && !empty($this->form->val['letra'])
                && !empty($this->form->val['numero'])
                && !empty($this->form->val['planta'])
            )
            {   

                $cantidad = $this->aulas->existeAula(
                 $this->form->val['nombre']
                ,$this->form->val['letra']
                ,$this->form->val['numero']
                ,$this->form->val['planta']
                ,$this->form->val['id']
                );
            }

            return $cantidad;
        }


        function resultados_busqueda()
        {
            $salida='';
            $salida .= $this->cargar_aula();
            $salida .= "<div class=\"alta\">". enlace("/{$this->seccion}/alta/", "Nueva aula",['class' => 'btn btn-success mt-2']) ."</div>";
            $salida .= var_dump( $this->form->val['accion']);
    
            return $salida;

        }


        function cargar_aula()
        {
            $html_aulas = '
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Letra</th>
                        <th scope="col">Número</th>
                        <th scope="col">Planta</th>
                    </tr>
                </thead>
                <tbody>
            
            ';

            $lista_aula = $this->aulas->cargar() ;

            foreach($lista_aula as $fila)
            {
                $html_aulas .= "

                       <tr>
                            <th scope=\"row\">
                                ". enlace("/{$this->seccion}/actualizar/{$fila['id']}",'Actualizar',['class' => 'btn btn-primary']) ."
                                ". enlace("/{$this->seccion}/leer/{$fila['id']}",'Leer',['class' => 'btn btn-primary']) ."
                                ". enlace("#",'Eliminar',['class' => 'btn btn-danger','onclick' => "if(confirm('Cuidado, estás tratando de eliminar el aula: {$fila['nombre']}')) location.href = '/aulas/eliminar/{$fila['id']}';"]) ."
                            </th>
                            <td>{$fila['nombre']}</td>
                            <td>". Aulas::LETRA[$fila['letra']] ."</td>
                            <td>{$fila['numero']}</td>
                            <td>". Aulas::PLANTA[$fila['planta']] ."</td>
                        </tr>
                ";
            }

            $html_aulas .='
                    </tbody>
                </table>
            ';


            
            
            return $html_aulas;
        }







    }


?>