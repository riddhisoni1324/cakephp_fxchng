<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Jay Jalaram Mukhwas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
</html>
<style>
    body{
        font-family:"Arial, Helvetica, sans-serif";
    }
    table{
        border-collapse: collapse;
    }
    a{
        outline:0;
    }
    .logo{
        font-size:8px;
        color:#FFF;
        outline:0;

        padding:8px;
        padding-left:15px;
        padding-right:15px;
        width:100%;
        height:34px;
        text-align: center;
    }
    .main-menu{
        height:53px;
        border-bottom:3px #CCC solid;
        border-collapse: collapse
    }
    .menu-item{
        font-size:9px;
        color:#666666;
        height:53px;
        font-weight: bold;
        text-transform: uppercase;
        padding-left:10px;
        padding-right:5px;
    }
    .menu-item a{
        color:#777777;
        text-decoration:none;
    }
    .menu-item a:hover{
        color:#333333;
        cursor: pointer;
    }
    .main-container{
        margin:15px;
        margin-left:5px;
        margin-right:5px;
        display:block;
        border-radius:5px;
        box-shadow:0 0 5px #CCC;

        padding-top:5px;
    }
    .main-content{
        padding: 10px;
    }
    .main-table{
        margin-bottom:15px;
    }
    .footer-content{
        font-family:Arial,Helvetica,sans-serif;font-size:10px;line-height:170%;color:#888;padding:12px;
        padding-top:0px;
        margin-top:-15px;
    }
    .footer-social{
        padding-right:15px;
        padding-top:10px;
    }

</style>
<body style="margin: 0; padding: 0;">
<table border="0" bgcolor="#F8F8F8" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <table style="border-collapse: collapse;" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td>
                        <table width="100%" style="border-collapse: collapse;border-right:2px #CCC solid;border-left:2px #CCC solid;" cellpadding="0" cellspacing="0" >
                            <tr width="100%" bgcolor="#dddddd" >
                                <td  width="20%" >
                                    <a href="http://www.jayjalarammukhwas.com" style="border:0;outline:0;"><img alt="jayjalarammukhwas.com" height="42" width="150" style="height:42px; width:150px; font-size:8px; color:#FFF; outline:0; padding:8px; padding-left:15px; padding-right:15px; text-align: center;" class="logo" src="http://jayjalarammukhwas.com/img/main_logo.png" align="center" /></a>
                                </td>
                                    <!-- <td width="80%" style="color:#FFFFFF;font-weight:bold;text-align:right;font-size:15px;padding-right:15px;">Happiness Delivered @ your Doorstep!</td> -->
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br/>
                        <table style="margin-bottom:15px;margin-top:-20px;" cellpadding="0" cellspacing="0" width="100%"  >
                            <tr bgcolor="white" class="main-container"  style="border-collapse: collapse;margin-left:5px;margin-right:5px;display:block;border-width:1px;border-color:#DDD;border-style:solid;border-radius:5px;-moz-box-shadow:0 0 5px #CCC;-webkit-box-shadow:0 0 5px #CCC; box-shadow:0 0 5px #CCC; padding-top:5px;">
                                <td bgcolor="white" class="main-content" style="padding: 10px;display:Block;">
                                      <?php echo $this->fetch('content'); ?>
                                </td>
                            </tr>
                            <tr>
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="text-align:center;">
                                    <tr >
                                        <td>
                                            <p class="footer-content" style="font-family:Arial,Helvetica,sans-serif;font-size:10px;line-height:170%;color:#888;padding:12px; padding-top:0px; margin-top:-15px;">

                                               <!--  <span style="color:#c1493b;font-size: 14px;font-weight:bold;">
                                                    Happiness Develivered @ your Doorstep!
                                                </span> -->
                                                <br/>

                                                You received this email because you are subscribed to Jay Jalaram Mukhwas<br>To unsubscribe from e-mails, please <a style="color:#1176BD;text-decoration:none;" href="http://jayjalarammukhwas.com/pages/contact_us" style="color:#999999;text-decoration:underline;white-space:nowrap" target="_blank">contact</a>  us.
                                                <br/>
                                                <br/>

                                                &copy; 2013 Jay Jalaram Mukhwas. All rights reserved.<br/>

                                                <a href="http://jayjalarammukhwas.com/"  style="color:#1176BD;text-decoration:none;" target="_blank">www.jayjalarammukhwas.com</a>

                                                <br/>



                                            </p>
                                        </td>

                                    </tr>
                                </table>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>