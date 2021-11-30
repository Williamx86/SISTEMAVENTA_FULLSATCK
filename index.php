<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Sistema de ventas</title>
  </head>
  <body>
    
    <div class="login">
        <div class="login__cuadro shadow-lg">
            <img class="login__img" src="img/usuario.svg">
            <h3>Inicio de sesión</h3>
            <hr class="login__img__borde">

            <form class="login__formulario" action="backend/login_process.php" method="POST">
                <p>Usuario</p>
                <div class="login__input">
                    <img src="img/usuario.svg">
                    <input type="text" name="usuario">
                </div>
                <p>Contraseña</p>
                <div class="login__input">
                    <img src="img/llave.svg">
                    <input type="password" name="clave">
                </div>
                <hr class="login__img__borde">
                <button type="submit" class="login__btn tres"><span>Iniciar sesión</span></button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  </body>
</html>