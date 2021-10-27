<?php

class Plugins
{


    public function loadPlugins($plugindir)
    {
        $plugindir = 'sysfrm/plugins/'.$plugindir;
        if(file_exists($plugindir))
        {
            $files = glob($plugindir . '/*.{plugin.php}', GLOB_BRACE);
            if(count($files) != 0)
            {
                foreach ($files as $file) {
                    require_once($file);
                }
            } else {
                trigger_error("No plugins found in plugin directory '$plugindir'!", E_USER_NOTICE);
            }
        } else {
            trigger_error("Plugin directory '$plugindir' does not exists!", E_USER_WARNING);
        }
    }
}