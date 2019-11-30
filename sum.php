<?php
    require_once 'init.php';
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }
//xử lí logi ở đây
?>

<?php include 'Header.php';?>
    <h1>Tính tổng hai số</h1>
<?php if(isset($_POST['number1'])&&isset($_POST['number2'])): ?>
<?php
    $number1 =$_POST['number1'];
    $number2 =$_POST['number2'];
    $sum=sum($number1,$number2);
?>
<div class="alert alert-primary"role="alert">
    kết quả tổng hai số <?php echo $number1;?> va <?php echo $number2;?> la <?php echo $sum?>
</div>
<?php else: ?>
    <form action="sum.php"method ="POST">
        <div class="form-group">
            <label for="number1">số thứ nhất</label>
            <input type="text"class="form-control"id="number1"name="number1">
        </div>
        <div class="form-group">
            <label for="number1">số thứ 2</label>
            <input type="text"class="form-control"id="number2"name="number2">
        </div>
        <button type="submit"class="btn btn-primary">Tính Tổng</button>
    </form>
    <?php endif; ?>
<?php include 'Footer.php';?>