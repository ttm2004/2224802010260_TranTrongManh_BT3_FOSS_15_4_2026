<?php
require_once 'functions.php';
$m = $n = 0;
$matrix = [];

if (isset($_POST['submit'])) {
    $m = $_POST['m'];
    $n = $_POST['n'];
    if(empty($m) || empty($n)){
        echo "<h3> Không được để trống m hoặc n</h3>";
    }
    else if ($m <= 0 || $n <= 0) {
        echo "<h3> Số hàng và số cột phải lớn hơn 0</h3><br>";
    }
    else if(!is_numeric($m) || !is_numeric($n)){
        echo "<h3> Số hàng và số cột phải là số </h3><br>";
    }
    else if ($m > 100 || $n > 100) {
        echo "<h3> Số hàng và số cột phải nhỏ hơn hoặc bằng 100</h3>";
    }
    else {
        echo "<h3> Kích thước ma trận hợp lệ: m = $m, n = $n</h3>";
    }
}

if (isset($_POST['save'])) {
    $m = $_POST['m'];
    $n = $_POST['n'];
    // $op = $_POST['op'];
    $matrix = $_POST['matrix'];

    $isValid = true;
    
    for($i = 0; $i < $m ; $i++){
        for($j = 0 ; $j < $n ; $j++){
            if($matrix[$i][$j] === ""){
                echo "<h3> Giá trị tại vị trí ($i, $j) không được để trống</h3>";
                $isValid = false;
            }
            else if(!is_numeric($matrix[$i][$j])){
                echo "<h3> Giá trị tại vị trí ($i, $j) phải là số</h3>";
                $isValid = false;
            }
        }
    }
    
    if($isValid){
        echo "<h3> Ma trận đã được lưu thành công</h3>";
        if($m == $n ){
            echo "<h3> Ma trận vuông </h3>";
            $det = 0;
            if($m == 1){
                echo "<h3> Ma trận 1x1 có định thức là giá trị duy nhất: " . $matrix[0][0] . "</h3>";
            }
            if($m == 2) {
                $det = $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
                echo "<h3> Ma trận 2x2 có định thức: " . $det . "</h3>";
            }
            else if($m > 2){
                // gọi hàm tính định thức cho ma trận có kích thước lớn hơn 2x2
                $det = detLonHon2($matrix, $m);
                echo "<h3> Ma trận " . $m . "x" . $n . " có định thức: " . $det . "</h3>";
            }
        }
        else {
            echo "<h3> Ma trận không vuông </h3>";
        }

        // Hiển thị ma trận sau khi sắp xếp giảm dần
        $sortedMatrix = sapXepGiamDan($matrix, $m, $n);
        echo "<h3> Ma trận sau khi sắp xếp giảm dần: </h3>";
        echo "<table border='1'>";
        for ($i = 0; $i < $m; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $n; $j++) {
                echo "<td>" . $sortedMatrix[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nhập ma trận</title>
</head>
<body>
<!-- - Cho phép người dùng nhập vào một ma trận có kích thước mxn -->
<h2>Nhập kích thước ma trận</h2>
<form method="post">
    <label for="m">Số hàng (m):</label>
    <input type="number" name="m" required><br><br>
    <label for="n">Số cột (n):</label>
    <input type="number" name="n" required><br><br>
    <input type="submit" name="submit" value="Tạo ma trận">
</form>
<!-- - Kiểm tra tính hợp lệ của dữ liệu nhập vào. Nếu dữ liệu không hợp lệ, hiển thị thông báo lỗi và yêu cầu người dùng nhập lại. -->
<?php if ($m > 0 && $n > 0 && isset($_POST['submit'])) { ?>

    <h3>Nhập giá trị cho ma trận</h3>
    <form method="post">
        <input type="hidden" name="m" value="<?php echo $m; ?>">
        <input type="hidden" name="n" value="<?php echo $n; ?>">

        <table border="1">
            <?php
            for ($i = 0; $i < $m; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $n; $j++) {
                    echo "<td>
                        <input type='number' name='matrix[$i][$j]' required>
                    </td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
        <br>
        <input type="submit" name="save" value="Lưu ma trận">
    </form>

<?php } ?>




</body>
</html>