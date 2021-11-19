<?php include('shared/head.php'); ?>

<style>
    body,html {
        font-family: "Montserrat", sans-serif;
        height: 100%;
    }

    .main-head {
        height: 150px;
        background: #FFF;
    }

    .sidenav {
        height: 100%;
        background: rgb(7,128,129);
        background: linear-gradient(266deg, rgba(7,128,129,1) 0%, rgba(40,137,159,1) 49%, rgba(0,211,255,1) 100%);
    }

    .sidenav, form{
        padding-top: 20px;
    }

    .main {
        padding: 0px 10px;
    }

    @media screen and (max-height: 450px) {
        .sidenav, form {
            padding-top: 15px;
        }

        .sidenav {
            height: 200px;
        }
    }

    @media screen and (max-width: 450px) {
        .login-form {
            margin-top: 10%;
        }

        .register-form {
            margin-top: 10%;
        }      .sidenav {
            height: 200px;
        }
    }

    .sidenav, form{
        padding-top: 20% !important;
    }

    .login-main-text {
        color: #fff;
    }

    .login-main-text h2 {
        font-weight: 300;
    }

    .btn-login {
        background-color: #0c8186 !important;
        color: #fff;
    }
</style>


<div class="row h-100">
    <div class="sidenav col-md-5 my-auto col-12 h-100">
        <div class="login-main-text">
        </div>
    </div>

    <div class="main col-12 col-md-7">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form action="index.php?page=login" method="POST">
                    <h5 class="text-left">Connexion</h5>
                    <div class="form-group">
                        <input name="email" type="text" class="form-control" placeholder="Votre email...">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" placeholder="Votre mot de passe...">
                    </div>
                    <?php if(isset($error)){ ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php } ?>
                    
                    <?php if(isset($message)){ ?>
                        <div class="alert alert-success">
                            <?= $message ?>
                        </div>
                    <?php } ?>
                    <input type="submit" class="btn btn-login float-right" name="loginForm" value="Connexion">
                    <br>
                    <br>
                    <div class="text-secondary float-right">
                        <a href="#">Inscription</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('shared/footer.php');?>