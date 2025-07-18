<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vestigia Portal - Configuracion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="<?= base_url('public/assets/css','https') ?>/adminlte.conf.css" rel="stylesheet" >
</head>
<body class="bg-dark">
    <div class="card w-50 mx-auto mt-5 text-dark">
        <img src="<?= base_url('public/assets/imagenes','https') ?>/logo_vst.png" class="card-img-top" style="width:5em;margin:auto" alt="...">
        <div class="card-body">
            <h4 class=" text-center"> Configuracion inicial de Vestigia Portal</h4>
            <form class="p-4 mt-2" action="vpconf/inicializar" method="post">
                <div class="mb-3">
                    <label for="ipURL" class="form-label">URL Base</label>
                    <input type="text" class="form-control" id="ipURL" name="URL" value="">
                </div>
                <div class="mb-3">
                    <label for="ipBD" class="form-label">Nombre de la base de datos</label>
                    <input type="text" class="form-control" id="ipBD" name="BD">
                </div>
                <div class="mb-3">
                    <label for="ipSuper" class="form-label">Superusuario</label>
                    <input type="text" class="form-control" id="ipSuper" name="Super">
                </div>
                <div class="mb-3">
                    <label for="ipClave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="ipClave" name="Clave">
                </div>
                <button id="btInicializar" class="btn btn-primary">Inicializar</button>    
            </form>
        </div>
    </div>
<script>
    document.getElementById('btInicializar').disabled=true;
    document.getElementById('ipURL').value=window.location.href.replace("/index.php/vpconf","").replace("/index.php","");
    document.getElementById('ipURL').addEventListener('change', habilitarBoton, false);
    document.getElementById('ipBD').addEventListener('change', habilitarBoton, false);
    document.getElementById('ipSuper').addEventListener('change', habilitarBoton, false);
    document.getElementById('ipClave').addEventListener('change', habilitarBoton, false);
    function habilitarBoton(){
        const URL=document.getElementById('ipURL').value;
        const BD=document.getElementById('ipBD').value;
        const Super=document.getElementById('ipSuper').value;
        const Clave=document.getElementById('ipClave').value;
        document.getElementById('btInicializar').disabled= !(
            /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/.test(URL) &&
            /^\S+$/.test(BD) &&
            /^\S+$/.test(Super) &&
            /^\S+$/.test(Clave) 
        );  
            
    }
</script>


</body>
</html>
