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
            <div class="img-holder mx-auto">
                <figure><img src="/HospitalManagementSystem/Assets/Images/signin.jpg" class="img signin-img" alt="sign up image"></figure>
            </div>
            <form class="form px-5 w-50 signin-form" method="post" action="registeruser.php">
            <a class="navbar-brand" href="/HospitalManagementSystem/index.php"><img src="/HospitalManagementSystem/Assets/Images/LOGO.png" alt="" width="50"> <span class="logo-text text-primary font-weight-bold">CIMS</span></a>
<h3 > Sign Up</h3>
<p>Already have an account ? <a href="signin.php">Sign In.</a></p>
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="row mb-2 w-100 ">
      <div class="col">
        <div class="form-outline">
          <input type="text" id="first_name" class="form-control" name="first_name" required />
          <label class="form-label" for="first_name">First name</label>
        </div>
      </div>
      <div class="col">
        <div class="form-outline">
          <input type="text" id="last_name" class="form-control" name="last_name" required />
          <label class="form-label" for="last_name">Last name</label>
        </div>
      </div>
    </div>

   <!-- Username input -->
<div class="mb-2 w-100">
  <label class="form-label" for="username">Username</label>
  <input type="text" id="username" class="form-control" name="username" required />
</div>

    <!-- Date of Birth input -->
    <div class="mb-2 w-100">
      <label class="form-label" for="birthDate">Date of Birth</label>
      <input type="date" id="birthDate" class="form-control" name="birthDate" required />
    </div>

    <!-- Phone number input -->
    <div class="mb-2 w-100">
      <label class="form-label" for="phone">Phone</label>
      <input type="text" id="phone" class="form-control" name="phone" required />
    </div>

    <!-- Email input -->
    <div class="mb-2 w-100">
      <label class="form-label" for="email">Email</label>
      <input type="email" id="email" class="form-control" name="email" required />
    </div>

    <!-- Password input -->
    <div class="mb-2 w-100">
      <label class="form-label" for="password">Password</label>
      <input type="password" id="password" class="form-control" name="password" required />
    </div>

    <!-- Confirm Password input -->
    <div class="mb-2 w-100">
      <label class="form-label" for="confirm_password">Confirm Password</label>
      <input type="password" id="confirm_password" class="form-control" name="confirm_password" required />
    </div>
    <div class="mb-2 w-100">
      <label class="form-label">Gender</label><br />
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" required />
        <label class="form-check-label" for="gender_male">Male</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" required />
        <label class="form-check-label" for="gender_female">Female</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="gender_other" value="other" required />
        <label class="form-check-label" for="gender_other">Other</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="gender_unknown" value="unknown" required />
        <label class="form-check-label" for="gender_unknown">Unknown</label>
      </div>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary mt-4 btn-block" onclick="this.disabled=true;this.form.submit();">Sign Up</button>
    
    <a href="/HospitalManagementSystem/index.php" class="link mx-auto mt-3 mb-5">Go to Landing Page</a>
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
                },
                confirm_password: {
                    required: true,
                    minlength: 3,
                    equalTo: "#password"
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
                },
                confirm_password: {
                    required: 'Please confirm your password.',
                    minlength: 'Password must be at least 3 characters long.',
                    equalTo: 'Passwords do not match.'
                }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>
</body>
</html>
