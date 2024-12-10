<?php

    class Productos extends Tabla
    {
        const TABLA = 'productos';


        function __construct()
        {
            parent::__construct(self::TABLA);

        }


        function cargar()
        {
            $lista_productos = [];

            $opt = [];
            
            $opt['select']['id'] = '';
            $opt['select']['nombre'] = '';
            $opt['select']['descripcion'] = '';
            $opt['select']['precio'] = '';
            $opt['select']['disponibilidad'] = '';
            $opt['select']['accion'] = '';

            $resultado = $this->seleccionar($opt);

            if ($resultado->num_rows > 0)
            {
                while ($fila = $resultado->fetch_assoc())
                {
                    $lista_productos[] = $fila;
                }
            }
            return $lista_productos;

        }
        function existeProducto($nombre,$descripcion,$precio,$disponibilidad,$accion,$id='')
        {
            $opt = [];
            $opt['select']['nombre']         = '';
            $opt['select']['descripcion']    = '';
            $opt['select']['precio']         = '';
            $opt['select']['disponibilidad'] = '';
            $opt['select']['accion']         = '';
            $opt['where']['nombre']          = $nombre;
            $opt['where']['descripcion']     = $descripcion;
            $opt['where']['precio']          = $precio;
            $opt['where']['disponibilidad']  = $disponibilidad;
            $opt['where']['accion']          = $accion;

            if(!empty($id))
            {
                $opt['notwhere']['id'] = $id;
            }
            
            $resultado = $this->seleccionar($opt);

            return $resultado->num_rows;
        }

    }

?>