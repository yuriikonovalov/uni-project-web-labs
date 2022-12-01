<!DOCTYPE html>
<html lang="uk">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Лабораторна робота 5</title>
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
          <a href="../lab2/lab2.php" class="nav-link">
            Лабораторна робота <i class="bi bi-2-circle"></i>
          </a>
        </il>
        <il class="nav-item">
          <a href="../lab5/lab5.php" class="nav-link active">
            Лабораторна робота <i class="bi bi-5-circle-fill"></i>
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
  <section class="p-5">
    <?php
    require "library.php";

    $weather = request_weather('https://www.gismeteo.ua/ua/weather-kyiv-4944/');
    echo "<p> $weather->city </p>";
    echo "<p> $weather->date </p>";
    echo "<br>";
    echo "<p> Схід сонця: $weather->sunrise </p>";
    echo "<p> Захід сонця: $weather->sunset </p>";
    echo "<p> Тривалість дня: $weather->day_time </p>";
    echo "<br>";
    echo "<div>
     <div class=\"temperature\"> Температура протягом дня:</div>";
    foreach ($weather->temperatures as &$temp) {
      echo "<div class=\"temperature\">$temp->hour г: $temp->degree &deg;</div>";
    }
    echo " </div> ";
    ?>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>