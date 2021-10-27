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
class Template
{
    protected $contents;
    protected $values = array();

    public function __construct($contents)
    {
        $this->contents = $contents;
    }

    public function set($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function output()
    {

        $output = $this->contents;

        foreach ($this->values as $key => $value) {
            $tagToReplace = '{{' . $key . '}}';
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }
}
