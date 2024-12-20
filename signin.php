
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->

<!-- MDB -->
<!-- <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css"
  rel="stylesheet"
/> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/HospitalManagementSystem/Assets/css/main.css">
</head>
<body>
<section class="signin">
   
        <div class="signin-content">
            <div class="img-holder">
                <figure><img src="/HospitalManagementSystem/Assets/Images/signin.jpg" class="img signin-img" alt="sign up image"></figure>
            </div>

            <form id="loginForm" class="signin-form" method="post" action="login.php">
                <!-- Username input -->
                <a class="navbar-brand" href="/HospitalManagementSystem/index.php"><img src="/HospitalManagementSystem/Assets/Images/LOGO.png" alt="" width="50"> <span class="logo-text text-primary font-weight-bold">CIMS</span></a>
                <h3 > Sign In</h3>
                <p>Don't have an account ? <a href="signup.php">Sign Up Now.</a></p>
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" required />
                    <label class="form-label" for="username">Username</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Remember me and Forgot password -->
                <div class="row mb-4 w-100">
                    <div class="col d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" checked />
                            <label class="form-check-label" for="rememberMe"> Remember me </label>
                        </div>
                    </div>
                    <div class="col">
                        <a href="forget_password.php">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                <a href="/HospitalManagementSystem/index.php" class="link mx-auto">Go to Landing Page</a>
            </form>

        </div>
    
</section>

<script>
    $(document).ready(function () {
        $('#loginForm').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                username: {
                    required: 'Please enter your username.',
                    minlength: 'Username must be at least 3 characters long.'
                },
                password: {
                    required: 'Please enter your password.',
                    minlength: 'Password must be at least 3 characters long.'
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
