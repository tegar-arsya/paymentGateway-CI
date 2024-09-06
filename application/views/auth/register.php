<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
</head>

<body>
    <div class="text-left">
        <a href="<?= base_url() ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-home"></i>
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 left">
                <h1>Register</h1>
                <form action="<?= base_url('auth/daftar') ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="email">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor">No Hp</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="Alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="passowrd">Password</label>
                            <input type="password" name="password1" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="passowrd">Confirm Password</label>
                            <input type="password" name="password2" class="form-control" required>
                            <br>
                            <span>
                                Sudah Punya akun? &nbsp;
                                <a href="<?= base_url('auth') ?>" class="">Silahkan Login</a>
                            </span>
                            <br>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" style="background-color: #b7a490;">Register</button>
                        </div><br>
                        <div class="separator mb-4"></div>
                    </fieldset>
                </form>
            </div>
            <div class="col-md-6 right"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>



<!-- <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?> ">

<div class="left">
    <h1>Register</h1>
    <form action="<?= base_url('auth/daftar') ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="email">Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label for="nomor">No Hp</label>
            <input type="text" name="no_hp" required>

            <label for="email">Email</label>
            <input type="text" name="email" required>
            <label for="Alamat">Alamat</label>
            <input type="text" name="alamat" required>

            <label for="passowrd">Password</label>
            <input type="password" name="password1" required>

            <label for="passowrd">Confirm Password</label>
            <input type="confirm_password" name="password2" required>
            <a href="<?= base_url('auth') ?>">Sudah punya akun? Silahkan Login</a>
            <button type="submit" class="primaryBtn">Register</button>
            <div class="separator"></div>
        </fieldset>
    </form>
</div>
<div class="right"></div> -->