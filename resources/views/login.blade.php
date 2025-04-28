<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
  body {
    background: url('assets/img/restauran.jpg') no-repeat center center fixed;

    background-size: cover;
  }
  
  .background-overlay {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
  }
</style>

</head>
<body>

<main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">


            <div class="card background-overlay">
              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login To Your Account</h5>
                  <p class="text-center small">Enter your email & password to login</p>
                </div>

                <form class="row g-3 needs-validation" novalidate action="/action-login" method="post">
                  @csrf

                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter your email.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <label for="yourRole" class="form-label">
                      Role <span class="text-danger small">*</span>
                    </label>
                    <select name="role" class="form-select" id="yourRole" required>
                      <option value="" disabled selected>Select Role</option>
                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">Please select your role.</div>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">
                        Remember me
                      </label>
                    </div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>

                </form>

              </div>
            </div>

            <div class="credits text-center">
              Designed by <a style="color: crimson;" href="https://bootstrapmade.com/">Rakapratama</a>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
