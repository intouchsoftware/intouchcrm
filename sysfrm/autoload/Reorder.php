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
Class Reorder
{
    public static function js($i)
    {
        return '


    $(function() {
        $("#sorder").sortable({ opacity: 0.6, cursor: \'move\', update: function() {
            var order = $(this).sortable("serialize") + \'&action=' . $i . '\';
            $("#resp").html(\'Saving...\');
            $.post("index.php?_route=reorder/reorder-post", order, function(theResponse){
                $("#resp").html(theResponse);
            });
        }
        });
    });


';
    }
}
