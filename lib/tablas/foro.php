<?php

    class Foro extends Tabla
    {
        const TABLA = 'foro';


        function __construct()
        {
            parent::__construct(self::TABLA);

        }


        function cargar()
        {
            $lista_mensajes = [];

            $opt = [];
            
            $opt['select']['id'] = '';
            $opt['select']['nombre'] = '';
            $opt['select']['mensaje'] = '';

            $resultado = $this->seleccionar($opt);

            if ($resultado->num_rows > 0)
            {
                while ($fila = $resultado->fetch_assoc())
                {
                    $lista_mensajes[] = $fila;
                }
            }
            return $lista_mensajes;

        }
        function existeMensaje($nombre,$mensaje,$id='')
        {
            $opt = [];
            $opt['select']['nombre']    = '';
            $opt['select']['mensaje']   = '';
            $opt['where']['nombre']     = $nombre;
            $opt['where']['mensaje']    = $mensaje;

            if(!empty($id))
            {
                $opt['notwhere']['id'] = $id;
            }
            
            $resultado = $this->seleccionar($opt);

            return $resultado->num_rows;
        }

    }

?>