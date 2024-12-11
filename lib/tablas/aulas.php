<?php

    class Aulas extends Tabla
    {
        const TABLA = 'aulas';
        const LETRA = ['D' => 'Lomo Derecho del centro', 'I' => ' Lomo Izquierdo'];
        const PLANTA = [1 => 'Primera', 2 => 'Segunda', 3  => 'Tercera'];

        function __construct()
        {
            parent::__construct(self::TABLA);

        }


        function cargar()
        {
            $lista_aulas = [];

            $opt = [];
            
            $opt['select']['id']     = '';
            $opt['select']['nombre'] = '';
            $opt['select']['letra']  = '';
            $opt['select']['numero'] = '';
            $opt['select']['planta'] = '';

            $resultado = $this->seleccionar($opt);

            if ($resultado->num_rows > 0)
            {
                while ($fila = $resultado->fetch_assoc())
                {
                    $lista_aulas[] = $fila;
                }
            }
            return $lista_aulas;

        }
        function existeAula($nombre,$letra,$numero,$planta,$id='')
        {
            $opt = [];
            $opt['select']['nombre'] = '';
            $opt['where']['numero']  = $numero;


            if(!empty($id))
            {
                $opt['notwhere']['id'] = $id;
            }
            
            $resultado = $this->seleccionar($opt);

            return $resultado->num_rows;
        }

    }

?>