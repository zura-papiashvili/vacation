<?php include 'inc/header.php'; ?>

<?php
// Set vars to empty values
// $fullname = $startDate = $endDate = '';
// $nameErr = $emailErr = $bodyErr = '';

// Form submit
if (isset($_POST['submit'])) {
  // Validate name
  if (empty($_POST['fullname'])) {
    $nameErr = 'Name is required';
  } else {
    $fullname = filter_input(
      INPUT_POST,
      'fullname',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  // Validate startDate
  if (empty($_POST['startDate'])) {
    $startDateErr = 'start date is required';
  } else {
    $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  // Validate endDate
  if (empty($_POST['endDate'])) {
    $endDateErr = 'End Date is required';
  } else {
    $endDate = filter_input(
      INPUT_POST,
      'endDate',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  if (empty($nameErr) && empty($startDateErr) && empty($endDateErr)) {
    echo $fullname;
    // add to database
    $sql = "INSERT INTO vacation (fullname, startDate, endDate) VALUES ('$fullname', '$startDate', '$endDate')";
    if (mysqli_query($conn, $sql)) {
      // success
      header('Location: fetch-vacations.php');
    } else {
      // error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>

<img src="./img/logo.png" class="w-25 mb-3" alt="">
<h2>Vacation Form</h2>
<?php echo isset($name) ? $name : ''; ?>
<p class="lead text-center">Enjoy your vacation journey 🌴</p>

<form method="POST" action="<?php echo htmlspecialchars(
                              $_SERVER['PHP_SELF']
                            ); ?>" class="mt-4 w-75">
  <div class="mb-3">
    <label for="fullname" class="form-label">Name</label>
    <input type="text" class="form-control <?php echo !$nameErr ?:
                                              'is-invalid'; ?>" id="fullname" name="fullname" placeholder="Enter your name">
    <div id="validationServerVacation" class="invalid-vacation">
      Please provide a valid name.
    </div>
  </div>
  <div class="mb-3">
    <label for="start" class="form-label">Start date:</label>
    <input type="date" class="form-control" id="start" name="startDate" min="2018-01-01" max="2030-12-31">
  </div>
  <div class="mb-3">
    <label for="end" class="form-label">Start date:</label>
    <input type="date" class="form-control" id="end" name="endDate" min="2018-01-01" max="2030-12-31">
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
  </div>
</form>
<?php include 'inc/footer.php'; ?>