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

<div class="row justify-content-center mt-5 pb-3">
  <div class="col-4" style="background-color: #9acdd5">
    <form action='/store' method="post">
      <div class="form-group">
        <label for="email">email address</label>
        <input type="email" class="form-control" name="mail" aria-describedby="emailHelp"
               placeholder="Enter email" required>
      </div>
      <div class="form-group">
        <label for="amount">amount</label>
        <input type="text" class="form-control" name="amount" placeholder="Amount" required>
      </div>
      <div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>

        <div>
          <a href="/getData">Show records</a>
        </div>
      </div>
    </form>
  </div>
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

      <?php
      if (isset($variables)):?>
        <p class="text-danger">
            <?php echo implode($variables);?>
        </p>
      <?php endif;?>
  </div>
</div>

<script src="../../js/jquery-3.3.1.min.js"></script>
<script src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>

</body>
</html>