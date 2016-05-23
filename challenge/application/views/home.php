<!DOCTYPE html>
<html>
    <head>
        <title>Challenge</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('css/home.css') ?>" />
        <script src="http://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src='<?php echo base_url() ?>js/home.js'></script>
        <script type="text/javascript">
            var BASE = '<?php echo base_url() ?>';
            var SERVICE = '<?php echo base_url('amf/gateway/') ?>?contentType=application/json';
        </script>
    </head>
    <body>
        <div class="header">
            <div class="container">
                <h1><i class="glyphicon glyphicon-th-list
"></i> CUBE SUMMATION</h1>
                <div class="clerafix"></div>
            </div>

        </div>
        <div class="container">
             <div class="col-md-4 center">
            Cantidad Casos de Prueba:
            <input id='input_intents' data-validate="numbers" type='text' maxlength='2' />
            <br><br>
            <div class="clerafix"></div>

            <div class="col-md-12">
                 <div class="col-md-3 col-md-offset-4"><button id="btn_reset">Reiniciar</button></div>
                    <div class="col-md-3"><button id="btn_send">Enviar</button></div>
                    <div class="clerafix"></div>

            </div>
        
       <div class="clerafix"></div>
        
        <div id="example" style="display:none;">
            <div class='content_intent col-md-12 bg' data-id='#'>
                <div>Intento #:</div>
                <div>Tamaño y Consultas:
                    <input class='input_tam' type='text' data-validate='numbers' maxlength="7" />
                    <br><br>
                    <button class='btn_process_tam'>Enviar</button>
                    <br>
                    <div class="content_operation">
                        Operacion: <input class='input_operation' placeholder="CONSULTAR/ACTUALIZAR" />
                        <br><br>
                        <button class="btn_operation">Enviar</button>
                        <br>
                        <div>Operaciones restantes: <div class='count'>0</div></div>
                    </div>
                    <div class='content_aswer'></div>
                </div>
                <br><br>
            </div>

        </div>
        <div id='content_general'></div>
        
        </div>
    </body>
</html>