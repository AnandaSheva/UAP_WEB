<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoGroceries - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- icon -->
    <link rel="icon" href="Assets/img/icons.png">
    <style>
        .container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            display: flex;
            width: 80%;
            max-width: 900px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-image {
            width: 50%;
            background: url('assets/img/gc.jpeg') no-repeat center center;
            background-size: cover;
        }
        .login-form {
            width: 50%;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="login-image"></div>
            <div class="login-form">
                <h1 class="mb-4">Selamat Datang di Groceries</h1>
                <form action="conn/login-session.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan nama pengguna anda" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class='bx bx-lock'></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi anda" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">MASUK</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
