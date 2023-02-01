<?php
session_start();
include('server.php');

if(isset($_SESSION["admin_name"])) {
    echo "The session for admin_name is set: " . $_SESSION["admin_name"];
} else {
    echo "The session for admin_name is not set.";
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sign up</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <main>
      <section class="padding-block-1000">
        <div class="container-login">
          <div class="even-columns">
            <!-- <img src="images/svg-login.svg" class="signup-svg" /> -->
            <div class="content-right">
              <h1 class="fs-200 text-neutral-400">Sign Up</h1>
              <p class="fs-150 text-neutral-200 fw-thin">
                Lorem ipsum dolor sit amet elit. Sapiente sit aut eos
                consectetur adipisicing.
              </p>
              <br />
              <div class="container-login">
                <form method="post" action="server.php">
                  <!-- display validation errors here -->
                  <?php include ('errors.php'); ?>
                  <div class="form-group">
                    <input
                    required
                    name="admin_name"
                    type="text"
                    value="<?php echo $username; ?>"
                    placeholder="Full Name"
                    />
                  </div>
                  <br />
                  <div class="form-group">
                    <input
                    required
                    name="admin_email"
                    type="email"
                    value="<?php echo $email; ?>"
                    placeholder="Email"
                    />
                  </div>
                  <br />
                  <div class="form-group">
                    <input
                    required
                    name="admin_password"
                    type="password"
                    value="<?php echo $password; ?>"
                    placeholder="Password"
                    />
                  </div>
                  <br />
                  <div style="display: flex; justify-content: space-between">
                    <a
                      href=""
                      class="text-neutral-300"
                      style="text-decoration: none"
                      ><span class="fs-100"
                        >I agree all statements in Terms of service</span
                      ></a
                    >
                  </div>
                  <br />
                  <div>
                    <button
                      class="button-login"
                      input
                      type="submit"
                      name="register"
                    >
                      Sign Up
                    </button>
                  </div>
                  <br />
                  <span class="fs-100 text-neutral-300"
                    >Already have an account?</span
                  ><a href="login.php" class="fs-100 text-neutral-300"> Sign in</a>
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
