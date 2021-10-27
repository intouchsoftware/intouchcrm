<?php
// *************************************************************************
// *                                                                       *
// * InTouch Software CRM                              *
// * Copyright (c) InTouch Software (Pty) Ltd. All Rights Reserved                      *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@intouchsoft.co.za                                                *
// * Website: https://www.intouchsoft.co.za                                  *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                       *
// *                                                                       *
// *************************************************************************

Class Schema{

    public $build_query;
    public $table;

    public function __construct($table)
    {
        $this->table = $table;
        $this->build_query = 'CREATE TABLE IF NOT EXISTS '.$table.' (
id int(11) NOT NULL AUTO_INCREMENT,
';
    }

    public function add($name,$type='text',$length='',$default='')
    {
//Apply logic to create order
        $l = '';

        if($length != ''){
            $l = '('.$length.')';
        }
        if($default != ''){
            $d = ' NOT NULL DEFAULT \''.$default.'\'';
        }
        else{
        $d = '';
        }
        $this->build_query .= $name.' ' . $type. '' . $l. $d.',
';
        return $this;
    }

    public function save(){

        $this->build_query .= 'PRIMARY KEY ( id )
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';

        try {
            $d = ORM::execute($this->build_query);
            return $d;

        } catch (Exception $e) {
            return $e->getMessage();
        }


    }

    public function drop(){

        try {
            $d = ORM::execute('DROP TABLE '.$this->table);
            return $d;

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}

