<?php
require_once 'header.php';
?>
  <style>
    body {
      background-color: #f8f9fa;
      text-align: center;
      padding: 5%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .error-code {
      font-size: 8rem;
      font-weight: bold;
      color: #dc3545;
    }
    .error-text {
      font-size: 2rem;
      color: #6c757d;
    }
    .error-icon {
      font-size: 5rem;
      color: #ffc107;
    }
    a.btn-home {
      margin-top: 2rem;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="error-icon mb-4">
      🚫
    </div>
    <div class="error-code">404</div>
    <div class="error-text mb-4">Lo sentimos, la página que buscas no existe.</div>
    <a href="home.php" class="btn btn-primary btn-home">
      Volver al inicio
    </a>
  </div>


<?php
require_once 'footer.php';
?>
