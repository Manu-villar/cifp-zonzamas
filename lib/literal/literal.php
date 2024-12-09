<?php

    class Literal
    {
        //instancia única
        private static $instance;


        public function __construct($idioma='ES')
        {

            switch($idioma)
            {
                case 'ES':
                    $this->lit = [
                         'nombre'             => 'Nombre'
                       , 'apellido_1'         => 'Primer apellido'
                       , 'apellido_2'         => 'Segundo apellido'
                       , 'nif'                => 'NIF'
                       , 'descripcion'        => 'Descripción'
                       , 'autor'              => 'Autor'
                       , 'editorial'          => 'Editorial'
                       , 'enviar'             => 'Enviar'
                       , 'error_gen'          => 'El campo es inválido'
                       , 'nuevo'              => 'Nuevo'
                       , 'editar'             => 'Editar'
                       , 'lista_ciclos'       => 'Listado de ciclos'
                       , 'select_usuarios'    => 'Listado de usuarios'
                       , 'mensaje_duplicados' => 'Hay un registro duplicado en BBDD'
                       , 'mensaje_exito'      => 'Operación realizada con éxito'
                       , 'mensaje'            => 'Mensaje'
 
                    ];

                break;
            }

        }


        static public function getInstance()
        {

            if (empty(self::$instance))
            {
                self::$instance = new self();
            }

            return self::$instance;
        }
    }