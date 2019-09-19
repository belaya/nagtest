<?php
//шаблон страниц
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->title ?></title>
    <!-- Подключаем Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

  <div class="site">
    <!-- ========== HEADER ========== -->
      <div id="header">
        <hr class="m-4 border">
      </div>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN ========== -->
    <section class="p-4">
      <?php include 'views/'.$content_view; ?>
    </section>
    <!-- ========== END MAIN ========== -->


    <!-- ========== FOOTER ========== -->
      <div id="footer">
        <hr class="m-4 border">
      </div>
    <!-- ========== END FOOTER ========== -->

  </div>

  <!-- Подключаем jQuery -->
  <script src="js/jquery-3.4.1.min.js" type="text/javascript"></script>

  <!-- Подключаем плагин Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <!-- Подключаем Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" ></script>

  <script src="js/report.js" type="text/javascript"></script>

</body>
</html>