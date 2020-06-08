<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Altero</title>
  <link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../style.css" rel="stylesheet">
</head>
<body>

<div class="mt-5">
    <?php
    if (isset($variables)) {
        foreach ($variables as $deal): ?>
          <form action="/changeStatus/<?php
          echo $deal['client_id'] ?>" method="get">
            <div class="row justify-content-center pb-2">
              <div class="d-flex col-4 justify-content-between" style="background-color: #9acdd5">
                <div>
                    <?php
                    echo $deal['partner_mail'] . PHP_EOL;
                    ?>
                </div>
                <div>
                    <?php
                    echo $deal['status'];
                    ?>
                </div>
                <div>
                  <button class="btn btn-success">Change status</button>
                </div>
              </div>
            </div>
          </form>
        <?php
        endforeach;
    } ?>
</div>

<div class="row justify-content-center">
  <div>
      <?php
      if (isset($_GET['message'])):?>
        <p class="text-success font-weight-bold">
            <?php
            echo $_GET['message']; ?>
        </p>
      <?php
      endif; ?>
  </div>
</div>

<div class="row justify-content-center pb-2">
  <div class="d-flex col-4 justify-content-between">
    <div>
      <a href="/">Home</a>
    </div>
  </div>
</div>

<script src="../../js/jquery-3.3.1.min.js"></script>
<script src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>

</body>
</html>