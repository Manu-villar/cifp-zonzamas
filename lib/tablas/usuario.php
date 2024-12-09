<?php


    class Usuario extends Tabla
    {
        const TABLA = 'personas';


        function __construct()
        {
            parent::__construct(self::TABLA);

        }

        function cargar($tipo_usuario)
        {
           
            $lista_usuarios = [];

            $opt = [];

            $opt['select']['p.id']      = '';

            $opt['select']['nombre']      = '';
            $opt['select']['apellido_1']  = '';
            $opt['select']['apellido_2']  = '';
            $opt['select']['nif']         = '';

            $opt['from'] = "personas AS p, {$tipo_usuario} AS p2";
            $opt['where_sc']['p.id']   = 'p2.id_persona';

            $resultado = $this->seleccionar($opt);

            if ($resultado->num_rows > 0)
            {
                while ($fila = $resultado->fetch_assoc())
                {
                    $lista_usuarios[] = $fila;
                }
            }
            return $lista_usuarios;
        }

        function existeUsuario($nombre,$apellido_1,$apellido_2,$nif,$id='')
        {
            $opt = [];
            
            $opt['select']['nombre']    = '';
            $opt['where']['nombre']     = $nombre;
            $opt['where']['apellido_1'] = $apellido_1;
            $opt['where']['apellido_2'] = $apellido_2;
            $opt['where']['nif']        = $nif;

            if(!empty($id))
                $opt['notwhere']['id'] = $id;
      
        
        
            $resultado = $this->seleccionar($opt);

            return $resultado->num_rows;
            
        }

        function eliminar()
        {
            $sql1 = "
                DELETE FROM {$this->select}
                WHERE id_persona = {$this->id};
            ";

            BBDD::query($sql1);

            $sql2 = "
                DELETE FROM {$this->tabla}
                WHERE id = {$this->id};
            ";
            
            
            
            BBDD::query($sql2);
        }

        function insertar()
        {
            $_pre_insert;
            $_pos_insert;

            foreach($this->elementos_tabla as $atributo => $valor)
            {
                if ($atributo != 'id')
                {
                    $_pre_insert .= ",{$atributo}";
                    $_pos_insert .= ",'{$this->$atributo}'";
                }
            }




            $sql = "
                INSERT INTO {$this->tabla}
                (
                    ip_alta


                    {$_pre_insert}
                )
                VALUES
                (   
                    '". $_SERVER['REMOTE_ADDR'] ."'


                    {$_pos_insert}
                )
                ;
            ";

            $resultado = BBDD::query($sql);
            
            $sql1 = "SELECT LAST_INSERT_ID() AS id; ";

            
            $resultado = BBDD::query($sql1);

            if ($resultado->num_rows > 0) 
            {
            $fila = $resultado->fetch_assoc();

            $this->id = $fila['id'];
            $this->elementos_tabla['id'] = $this->id;
            }

            $sql2 = "
                INSERT INTO {$this->select}
                (
                    ip_alta

                    ,id_persona
                )
                VALUES
                (   
                    '". $_SERVER['REMOTE_ADDR'] ."'


                    ,{$this->id}
                );
                
            ";
            $resultado = BBDD::query($sql2);
        }

    }
?>