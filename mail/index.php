<?php if(isset($_REQUEST['array'])):
$host= $_SERVER['HTTP_HOST'];
$contenido=unserialize($_REQUEST['array']);
$to = $contenido->email;
$subject = $contenido->asunto;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers = "From: noreply@geekhack.net.ve" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$message ='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CashHack</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<style type="text/css">
        body {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
            -webkit-font-smoothing: antialiased !important;
        }
        
        .tableContent img {
            border: 0 !important;
            display: block !important;
            outline: none !important;
        }
        
        a {
            color: #382F2E;
        }
        
        p,
        h1 {
            color: #382F2E;
            margin: 0;
        }
        
        div,
        p,
        ul,
        h1 {
            margin: 0;
        }
        
        p {
            font-size: 13px;
            color: #99A1A6;
            line-height: 19px;
        }
        
        h2,
        h1 {
            color: #444444;
            font-weight: normal;
            font-size: 22px;
            margin: 0;
        }
        
        a.link2 {
            padding: 15px;
            font-size: 13px;
            text-decoration: none;
            background: #2D94DF;
            color: #ffffff;
            border-radius: 6px;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
        }
        
        .bgBody {
            background: #f6f6f6;
        }
        
        .bgItem {
            background: #2C94E0;
        }
        
        @media only screen and (max-width:480px) {
            table[class="MainContainer"],
            td[class="cell"] {
                width: 100% !important;
                height: auto !important;
            }
            td[class="specbundle"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
            }
            td[class="specbundle1"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
                padding-bottom: 20px !important;
            }
            td[class="specbundle2"] {
                width: 90% !important;
                float: left !important;
                font-size: 14px !important;
                line-height: 18px !important;
                display: block !important;
                padding-left: 5% !important;
                padding-right: 5% !important;
            }
            td[class="specbundle3"] {
                width: 90% !important;
                float: left !important;
                font-size: 14px !important;
                line-height: 18px !important;
                display: block !important;
                padding-left: 5% !important;
                padding-right: 5% !important;
                padding-bottom: 20px !important;
            }
            td[class="specbundle4"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
                padding-bottom: 20px !important;
                text-align: center !important;
            }
            td[class="spechide"] {
                display: none !important;
            }
            img[class="banner"] {
                width: 100% !important;
                height: auto !important;
            }
            td[class="left_pad"] {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }
        
        @media only screen and (max-width:540px) {
            table[class="MainContainer"],
            td[class="cell"] {
                width: 100% !important;
                height: auto !important;
            }
            td[class="specbundle"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
            }
            td[class="specbundle1"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
                padding-bottom: 20px !important;
            }
            td[class="specbundle2"] {
                width: 90% !important;
                float: left !important;
                font-size: 14px !important;
                line-height: 18px !important;
                display: block !important;
                padding-left: 5% !important;
                padding-right: 5% !important;
            }
            td[class="specbundle3"] {
                width: 90% !important;
                float: left !important;
                font-size: 14px !important;
                line-height: 18px !important;
                display: block !important;
                padding-left: 5% !important;
                padding-right: 5% !important;
                padding-bottom: 20px !important;
            }
            td[class="specbundle4"] {
                width: 100% !important;
                float: left !important;
                font-size: 13px !important;
                line-height: 17px !important;
                display: block !important;
                padding-bottom: 20px !important;
                text-align: center !important;
            }
            td[class="spechide"] {
                display: none !important;
            }
            img[class="banner"] {
                width: 100% !important;
                height: auto !important;
            }
            td[class="left_pad"] {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
            .font {
                font-size: 15px !important;
                line-height: 19px !important;
            }
        }
    </style>

    <script type="colorScheme" class="swatch active">
        { "name":"Default", "bgBody":"f6f6f6", "link":"ffffff", "color":"99A1A6", "bgItem":"2C94E0", "title":"444444" }
    </script>
</head>
<body paddingwidth="0" paddingheight="0" bgcolor="#d1d3d4" style=" margin-left:5px; margin-right:5px; margin-bottom:0px; margin-top:0px;padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;"
    offset="0" toppadding="0" leftpadding="0">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center" style="font-family:Helvetica, Arial,serif;">

        <!-- =============================== Header ====================================== -->

        <tr>
            <td class="movableContentContainer">
                <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                        <tr>
                            <td height="25" colspan="3"></td>
                        </tr>

                        <tr>
                            <td valign="top" colspan="3">
                                <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" valign="top" class="MainContainer">
                                    <tr>
                                        <td align="left" valign="middle" width="200">
                                            <div class="contentEditableContainer contentImageEditable">
                                                <div class="contentEditable">
                                                    <img src="http://'.$host.'/cashhack/assets/img/geekhack-logo.png" alt="Compagnie logo" data-default="placeholder" data-max-width="300" width="120" height="100" style="display: block;" /> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                        <tr>
                            <td>
                                <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" valign="top" class="MainContainer">
                                    <tr>
                                        <td colspan="3" height="25"></td>
                                    </tr>
                                    <tr>
                                        <td width="50"></td>
                                        <td width="500">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                                                <tr>
                                                    <td align="center">
                                                        <div class="contentEditableContainer contentTextEditable">
                                                            <div class="contentEditable">
                                                                <h1 style="font-size:32px;">Notificación  cashhack
                                                                </h1>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <div class="contentEditableContainer contentTextEditable">
                                                            <div class="contentEditable">
                                                                <h3><b>'.$contenido->titulo.'</b></h3>
                                                                <br>
                                                                <p> <b>'.$contenido->contenido.'</b>
                                                                    <br>
                                                                    <a href="'.$contenido->enlace.'" style="color: #000000;"> <b> <br> &nbsp Ir a cashHACK </b> </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="50"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" height="45"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                        <tr>
                            <td width="50"></td>
                        </tr>
                        <tr>
                            <td colspan="3" height="45"></td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>
    </div>
    <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
            <tr>
                <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="MainContainer">
                        <tr>
                            <td height="10">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:1px solid #DDDDDD"></td>
                        </tr>
                        <tr>
                            <td height="10">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
            <tr>
                <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" valign="top" class="MainContainer">
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" valign="top">
                                    <tr>
                                        <td valign="top" align="center">
                                            <div class="contentEditableContainer contentTextEditable">
                                                <div class="contentEditable">
                                                    <p style="font-weight:bold;font-size:13px;line-height: 30px;">Este correo electrónico se envió al [correo electrónico] cuando te registraste en <b>cashHACK</b>. <br> Agréganos a tus contactos para asegurarte de que los boletines lleguen a tu bandeja de entrada.</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="28">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center">
                                            <div class="contentEditableContainer contentTextEditable">
                                                <div class="contentEditable">
                                                    <p style="font-weight:bold;font-size:13px;line-height: 30px;"><b>© Copyright <a class="enlace" href="https://www.geekhack.net.ve/"> geekHACK</a> 2020.</b></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="28">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    </td>
    </tr>
    </table>

</body>
</html>';
		if(mail($to, $subject, $message, $headers)) {
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}
else:
	echo json_encode(-1) ;
endif;
?>
