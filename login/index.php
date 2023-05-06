<?php

ob_start();
session_start();
require '../connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortoring | login</title>
    <style>
        .card-login {
            background: #B2A4FF;
            box-shadow: 16px 16px 32px #c8c8c8,
                -16px -16px 32px #fefefe;
            border-radius: 8px;
        }

        .title-login {
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            font-weight: bold;
            font-size: x-large;
        }

        .inputBox {
            position: relative;
        }
        .inputBox input {
            width: 100%;
            padding: 10px;
            outline: none;
            border: none;
            color: #000;
            font-size: 1em;
            background: transparent;
            border-left: 2px solid #000;
            border-bottom: 2px solid #000;
            transition: 0.1s;
            border-bottom-left-radius: 8px;
        }

        .inputBox span {
            margin-top: 5px;
            position: absolute;
            left: 0;
            transform: translateY(-4px);
            margin-left: 10px;
            padding: 10px;
            pointer-events: none;
            font-size: 12px;
            color: #000;
            text-transform: uppercase;
            transition: 0.5s;
            letter-spacing: 3px;
            border-radius: 8px;
        }

        .inputBox input:valid~span,
        .inputBox input:focus~span {
            transform: translateX(50px) translateY(-17px);
            font-size: 0.5em;
            padding: 5px 10px;
            background: #000;
            letter-spacing: 0.2em;
            color: #fff;
            border: 2px;
        }

        .inputBox input:valid,
        .inputBox input:focus {
            border: 2px solid #000;
            border-radius: 8px;
        }

        .button-login {
            height: 45px;
            width: 100px;
            border-radius: 5px;
            border: 2px solid #000;
            cursor: pointer;
            background-color: transparent;
            transition: 0.5s;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 2px;
            margin-bottom: 1em;
        }

        .button-login:hover {
            background-color: rgb(0, 0, 0);
            color: white;
        }
    </style>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Font Awesome -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #e8e8e8;">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-xl-5 col-lg-7 col-md-8 col-sm-9 col-10 rounded p-2">
            <?php
            if (isset($_POST['loginBtn'])) {
                $username = htmlspecialchars($_POST['usernameLogin']);
                $password = md5(htmlspecialchars($_POST['passwordLogin']));
                $query = mysqli_query($conn, "SELECT * FROM account WHERE username='$username'");
                $data = mysqli_fetch_array($query);
                $countData = mysqli_num_rows($query);
                if ($countData > 0) {
                    if ($password == $data['password']) {
                        $_SESSION['id_admin'] = $data['id_account'];
                        $_SESSION['login'] = true;
                        header("location: ../?pagination=home");
                    } else {
            ?>
                        <div class="mb-3">
                            <div class="w-100 bg-warning rounded-top d-flex justify-content-center p-1" style="height: 30px;"><span class="text-muted">Username atau password salah</span></div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="mb-3">
                        <div class="w-100 bg-warning rounded-top d-flex justify-content-center p-1" style="height: 30px;"><span class="text-muted">Akun Tidak Tersedia</span></div>
                    </div>
            <?php
                }
            }
            ?>
            <form action="" class="card-login d-flex flex-column align-items-center" method="POST">
                <div class="text-center p-2 title-login">
                    <h3>LOGIN <span style="font-style: italic;"><span style="color: #2857FF;">FOR</span>TORING</span></h3>
                </div>
                <div class="inputBox mt-3" style="width: 85%;">
                    <input type="text" name="usernameLogin" required="required" />
                    <span class="user">Username</span>
                </div>
                <div class="inputBox mt-5" style="width: 85%;">
                    <input type="password" name="passwordLogin" id="passwordLogin" required="required" />
                    <span class="user">Password</span>
                </div>
                <div class="mt-3 me-5 d-flex justify-content-end w-100">
                    <button type="button" class="rounded-pill fas fa-eye border-0" onclick="togglePassword()" id="togglePass"> Show</button>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    <button type="submit" class="button-login" name="loginBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script>
        let togglePass = document.getElementById('togglePass');
        let pwd = document.getElementById("passwordLogin")
        let indexPass = true;

        function togglePassword() {
            if (indexPass == true) {
                indexPass = false;
                togglePass.classList.remove("fa-eye");
                togglePass.classList.add("fa-eye-slash");
                togglePass.textContent = " Hidden";
                pwd.type = "text";
            } else {
                indexPass = true;
                togglePass.classList.remove("fa-eye-slash");
                togglePass.classList.add("fa-eye");
                togglePass.textContent = " Show";
                pwd.type = "password";
            }
        }
    </script>
</body>
</html>
<?php
ob_end_flush();
?>