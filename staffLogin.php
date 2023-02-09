<?php
session_start();
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
include('server.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="images/pizza_icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>" />
</head>

<body>
    <main>
        <section class="padding-block-1000">
            <div class="container-login">
                <div class="even-columns">
                    <img src="images/svg-login.svg" class="signup-svg" />
                    <div class="content-right">
                        <h1 class="fs-200 text-neutral-400">Sign In</h1>
                        <p class="fs-150 text-neutral-200 fw-thin">
                            Welcome to the staff login section of our website. Please enter your
                            login credentials to continue.
                        </p>
                        <br />
                        <div class="container-login">
                            <form method="post" action="server.php">
                                <div class="form-group">
                                    <input name="email" required type="email" value="<?php echo $email; ?>"
                                        placeholder="Email" />
                                </div>
                                <br />
                                <div class="form-group">
                                    <input required name="password" type="password" value="<?php echo $password; ?>"
                                        placeholder="Password" />
                                </div>
                                <br />
                                <!-- <div style="display: flex; justify-content: space-between">
                                    <a href="" class="text-neutral-300"><span class="fs-100">Forgot password?</span></a>
                                </div> -->
                                <br />
                                <div>
                                    <button class="button-login" input type="submit" name="staffLogin"
                                        onClick="location.href='index.php'">
                                        Log In
                                    </button>
                                </div>
                                <br />
                                <span class="fs-100 text-neutral-300">Don’t have an account?</span><a
                                    href="staffRegister.php" class="fs-100 text-neutral-300">
                                    Sign up</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script type="module" src="/main.js"></script>
</body>

</html>