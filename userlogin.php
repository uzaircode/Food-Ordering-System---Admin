<?php
error_reporting(E_ALL);
session_start();
// phpinfo(); // Works correctly
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include('server.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <link rel="icon" type="image/x-icon" href="images/pizza_icon.png">
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>" />
</head>

<body>
    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h1>Take a Slice Out of Hunger</h1>
                <p>All natural, fresh ingredients, housemade by chefs.</p>
            </section>
        </div>
        <div class="right">
            <form method="post" action="server.php">
                <section class="copy">
                    <h1>Sign In</h1>
                    <br>
                </section>
                <div class="input-container email">
                    <label for="email">Email</label>
                    <input id="email" name="customer_email" value="<?php echo $customer_email; ?>" type="email"
                        placeholder="Email Address" />
                </div>
                <div class="input-container password">
                    <label for="password">Password</label>
                    <input id="password" name="customer_password" value="<?php echo $password; ?>"
                        placeholder="Password" type="password" />
                </div>
                <button class="button-login" input type="submit" name="customerLogin">
                    Log In
                </button>
                <section class="copy legal">
                    <p>
                        Don't have an account?
                        <strong> <a href="userRegister.php" style="color: orange;">Sign up for free</a> </strong>
                    </p>
                </section>
            </form>
        </div>
    </div>

    <script src="" async defer></script>
</body>

</html>