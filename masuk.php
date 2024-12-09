<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuhito Books | Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div>
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                <img src="assets/Asset 7.png" alt="Logo" width="100" height="35" class="d-inline-block align-text-top">
                </a>
            </div>
        </nav>
    </div>
    <div class="d-flex vh-100 flex-column flex-md-row">
        <figure class="d-none d-md-block col bg-danger h-100 overflow-hidden">    
            <img src="assets/Asset 2.png" alt="logo" class="w-100">
        </figure>   

        <div class="col d-flex flex-column justify-content-center align-items-center">
          <form class="d-flex flex-column align-items-center w-75 py-3" method="POST" action="">
            <figure> 
              <img src="assets/Asset 4.png" alt="user-logo" width="120">
            </figure>

            <h2>Masuk</h2>

            <?php if (!empty($message)): ?>
              <div class="alert alert-info w-100 mt-3">
                <?php echo htmlspecialchars($message); ?>
              </div>
            <?php endif; ?>

            <div class="w-100 mt-3">

              <a href="login.php" class="btn btn-dark w-100 mt-3">Login</a>

              <a href="daftar_akun.php" class="btn btn-dark w-100 mt-3">Daftar</a>
              <div id="emailHelp" class="form-text">Lakukan daftar jika belum mempunyai akun</div>
              
            </div>
          </form> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>