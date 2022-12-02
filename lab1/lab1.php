<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Лабораторна робота 2</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="icon" href="../icon.png" />

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Righteous:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <!-- Bootstrap Font Icon CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
</head>

<body class="body">
  <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand brand-title" href="../index.html">YK</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ms-auto">
        <il class="nav-item">
          <a href="../lab1/lab1.php" class="nav-link active">
            Лабораторна робота <i class="bi bi-1-circle-fill"></i>
          </a>
        </il>
        <il class="nav-item">
          <a href="../lab2/lab2.php" class="nav-link">
            Лабораторна робота <i class="bi bi-2-circle"></i>
          </a>
        </il>
        <il class="nav-item">
          <a href="../lab5/lab5.php" class="nav-link">
            Лабораторна робота <i class="bi bi-5-circle"></i>
          </a>
        </il>
        <il class="nav-item">
          <a href="../lab8/lab8.html" class="nav-link">
            Лабораторна робота <i class="bi bi-8-circle"></i>
          </a>
        </il>
      </ul>
    </div>
  </nav>

  <?php
  if (!empty($_POST)) {
    $email_to = $_POST['address'];
    $message = $_POST['message'];
    $email_subject = 'PHP Email';
    $headers = 'From: webkonovalov@lab.com';
    $success = mail($email_to, $email_subject, $message, $headers);
    if ($success) {
      echo "<p style=\"text-align: center; margin-top: 50px;\">Повідомлення відправлено</p>";
    } else {
      echo "<p style=\"text-align: center; margin-top: 50px;\">Сталася помилка. Спробуйте ще раз</p>";
    }
  }
  ?>


  <div class="d-flex justify-content-center">
    <div class="email-form">
      <form id="form" method="post">
        <div class="mb-3">
          <label for="address" class="form-label">Email адреса</label>
          <input type="email" class="form-control" id="address" name="address" placeholder="name@example.com" />
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Повідомлення</label>
          <textarea class="form-control" name="message" id="message" rows="4"></textarea>
        </div>
        <div class="d-flex justify-content-center">
          <button class="btn btn-primary" type="submit">
            Відправити повідомлення
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>