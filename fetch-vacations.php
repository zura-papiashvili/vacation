<?php include 'inc/header.php'; ?>

<?php
$sql = 'SELECT * FROM vacation';
$result = mysqli_query($conn, $sql);
$vacations = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<h2>Vacation requests</h2>

<?php if (empty($vacations)) : ?>
<p class="lead mt-3">There is no Vacation Requests</p>
<?php endif; ?>

<?php foreach ($vacations as $vacation) : ?>
<div class="card my-3 w-75">
    <div class="card-body text-center">
        <?php echo "Employee Name:  " . $vacation['fullname']; ?>
        <div class="text-secondary mt-2">
            From
            <?php
            echo date_format(date_create($vacation['startDate']), ' jS F Y');
          ?>
            To
            <?php
            echo date_format(date_create($vacation['endDate']), ' jS F Y');
          ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php include 'inc/footer.php'; ?>