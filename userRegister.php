<?php
session_start();
// phpinfo(); // Works correctly
error_reporting(E_ALL);

ini_set('display_errors', 1);
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
                    <h1>Sign Up</h1>
                    <div class="login-container">
                        <p>Already have an account? <a href="userlogin.php">Log In</a></p>
                    </div>
                </section>
                <div class="input-container name" style="color: white;">
                    <label for="fname">Full Name</label>
                    <input id="fname" name="customer_name" type="text" placeholder="Full Name"
                        value="<?php echo $customer_username; ?>" />
                </div>
                <div class="input-container email" style="color: white;">
                    <label for="email">Email</label>
                    <input id="email" name="customer_email" type="email" placeholder="Email Address"
                        value="<?php echo $email; ?>" />
                </div>
                <div class="input-container password" style="color: white;">
                    <label for="password">Password</label>
                    <input id="password" name="customer_password" value="<?php echo $password; ?>"
                        placeholder="Must be at least 6 characters" type="password" />
                </div>
                <div class="input-container cta">
                    <label class="checkbox-container">
                        <input type="checkbox" />
                        <span class="checkmark"> </span>
                        Sign Up for email updates.
                    </label>
                </div>
                <button class="signup-btn" input type="submit" name="customerRegister">Sign Up</button>
                <section class="copy legal">
                    <p>
                        <span class="small">By continuing, you agree to accept our <br />
                            <a href="#">Privacy Policy</a> &amp;
                            <a href="#">Terms of Service</a>.</span>
                    </p>
                </section>
            </form>
        </div>
    </div>
    <script src="" async defer></script>
</body>

</html>