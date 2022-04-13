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
    <div class="login-root">
        <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
            <div class="loginbackground box-background--white padding-top--64">
                <div class="loginbackground-gridContainer">
                    <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
                        <div class="box-root"
                            style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
                        <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
                        <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
                        <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
                        <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
                        <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
                        <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
                        <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;">
                        </div>
                    </div>
                    <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
                        <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
                <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
                    <!-- <h1><a href="http://blog.stackfindover.com/" rel="dofollow">Stackfindover</a></h1> -->

                    <img src="../jlm/views/template/img/logo.png" width="337.5" height="113" alt="">

                </div>
                <div class="formbg-outer">
                    <div class="formbg">
                        <div class="formbg-inner padding-horizontal--48">
                            <span class="padding-bottom--15">Iniciar sesion</span>
                            <form id="stripe-login" id="formtec">
                                <div class="field padding-bottom--24">
                                    <label for="text">Usuario</label>
                                    <input type="text" name="tecn" pattern="[A-Z,a-z,0-9,_-,ñ,Ñ]{1,50}" required>
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="field padding-bottom--24">
                                    <div class="grid--50-50">
                                        <label for="password" name="pass" class="form-control"
                                            pattern="[A-Z,a-z,0-9,_-ñÑ]{1,50}" required>Contraseña</label>
                                        <div class="reset-pass">
                                            <a href="#">Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>
                                    <input type="password" name="password">
                                </div>
                                <!-- <div class="field field-checkbox padding-bottom--24 flex-flex align-center">
                  <label for="checkbox">
                    <input type="checkbox" name="checkbox"> Stay signed in for a week
                  </label>
                </div> -->
                                <div class="field padding-bottom--24">
                                    <input type="submit" class="botton" value="Iniciar Sesion">
                                </div>
                                <!-- <div class="field">
                  <a class="ssolink" href="#">Use single sign-on (Google) instead</a>
                </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="footer-link padding-top--24">
                        <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
                            <span><a href="http://www.jlmycia.com.mx">© JLM</a></span>
                            <span><a href="#">Contact</a></span>
                            <span><a href="#">Privacy & terms</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../lib/jquery/jquery.js"></script>
<script src="../lib/popper.js/popper.js"></script>
<script src="../lib/bootstrap/bootstrap.js"></script>
<script src="./controller/validation.js"></script>

<script>
$(document).ready(function() {
    $(".sign-up").click(function() {
        $(".reg").toggleClass("regopen");
    });
    $(".login1").click(function() {
        $(".reg").removeClass("regopen");
    });
});
</script>

</html>