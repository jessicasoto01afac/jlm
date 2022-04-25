<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>JLM Y CIA</title>

    <!-- vendor css -->
    <link href="../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="./views/template/css/index.css" rel="stylesheet">

      <!-- Bracket CSS -->
      <link rel="stylesheet" href="../app/views/template/css/bracket.css">

</head>

<body>
  <div class="container">
    <div class="forms-container">

      <div class="signin-signup">
              <div class="flex-flex flex-justifyContent--center">
                    <!-- <h1><a href="http://blog.stackfindover.com/" rel="dofollow">Stackfindover</a></h1> -->

                    <img src="../jlm/views/template/img/logo.png" width="225" height="75.3" alt="">

                </div>
                
        <form action="controller/session.php" method="POST" id="stripe-login" id="formtec" class="sign-in-form">
          <h2 class="title">Iniciar sesión</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <!-- <input type="text" placeholder="Usuario" name="Usuario" id="Usuario" /> -->
            <input type="text" placeholder="Ingrese su usuario" name="usuario" id="Usuario" pattern="[A-Z,a-z,0-9,_-,ñ,Ñ]{1,50}" required>
          </div>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <!-- <input type="text" placeholder="contraseña" name="Usuario" id="Usuario" /> -->
            <input type="password" placeholder="Ingrese su contraseña" name="password">
          </div>
          <!-- <input type="button" value="Iniciar Sesión" class="btn solid" /> -->
          <input type="submit" value="Iniciar Sesion" class="btn solid botton">
          
        </form>
        <form action="#" class="sign-up-form">
          <h2 class="title">Regístrate</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Usuario" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Contraseña" />
          </div>
          <input type="submit" class="btn" value="Regístrate" />
          <br>
                <br>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
        <h2 style="color:white">JLM PROGRAMA DE PRODUCCIÓN</h2>
        <br>
          <h3 style="color:white">¿Olvidate tu contraseña?</h3>
          <p style="color:white">
            Has clik al siguiente botón para recuperar tu acceso !
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Recuperación
          </button>
        </div>
        <!-- <img src="https://i.pinimg.com/originals/72/82/fe/7282fee6a0641482ab4391b9638ee46c.png" class="image" alt="" /> -->
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>¿Ya tienes una Cuenta?</h3>
          <p>
          Inicie sesión
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Iniciar Sesión
          </button>
        </div>
        <!-- <img src="https://i.pinimg.com/originals/77/29/f4/7729f497f9d0188fa35d41db45232cca.png" class="image" alt="" /> -->
      </div>
    </div>
  </div>

</body>

<script src="../lib/jquery/jquery.js"></script>
<script src="../lib/popper.js/popper.js"></script>
<script src="../lib/bootstrap/bootstrap.js"></script>
<script src="./controller/validation.js"></script>


<script>
   const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

</script>

</html>