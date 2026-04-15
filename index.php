<?php
require_once 'functions.php';
$m = $n = 0;
$matrix = [];

if (isset($_POST['submit'])) {
    $m = $_POST['m'];
    $n = $_POST['n'];

    if (empty($m) || empty($n)) {
        echo "<div class='error'>Không được để trống m hoặc n</div>";
    } elseif ($m <= 0 || $n <= 0) {
        echo "<div class='error'>Số hàng và số cột phải lớn hơn 0</div>";
    } elseif (!is_numeric($m) || !is_numeric($n)) {
        echo "<div class='error'>Số hàng và số cột phải là số</div>";
    } elseif ($m > 100 || $n > 100) {
        echo "<div class='error'>Số hàng và số cột phải nhỏ hơn hoặc bằng 100</div>";
    } else {
        echo "<div class='success'>Kích thước ma trận hợp lệ: m = $m, n = $n</div>";
    }
}

if (isset($_POST['save'])) {
    $m = $_POST['m'];
    $n = $_POST['n'];
    $matrix = $_POST['matrix'];

    $isValid = true;

    for ($i = 0; $i < $m; $i++) {
        for ($j = 0; $j < $n; $j++) {
            if ($matrix[$i][$j] === "") {
                echo "<div class='error'>Giá trị tại vị trí ($i, $j) không được để trống</div>";
                $isValid = false;
            } elseif (!is_numeric($matrix[$i][$j])) {
                echo "<div class='error'>Giá trị tại vị trí ($i, $j) phải là số</div>";
                $isValid = false;
            }
        }
    }

    if ($isValid) {
        echo "<div class='card'>";
        echo "<div class='success'>Ma trận đã được lưu thành công</div>";
        echo "<div class='info'>Ma trận kích thước $m x $n</div>";

        if ($m == $n) {
            echo "<div class='success'>Đây là ma trận vuông</div>";

            // $det = 0;
            if ($m == 1) {
                echo "<div class='info'>Ma trận 1x1 có định thức là giá trị duy nhất: " . $matrix[0][0] . "</div>";
            } elseif ($m == 2) {
                $det = $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
                echo "<div class='info'>Ma trận 2x2 có định thức: $det</div>";
            } elseif ($m > 2) {
                $det = detLonHon2($matrix, $m);
                echo "<div class='info'>Ma trận " . $m . "x" . $n . " có định thức: $det</div>";
            }
        } else {
            echo "<div class='error'>Đây không phải ma trận vuông nên không tính được định thức</div>";
        }

        echo "<h3 class='section-title'>Ma trận trước khi sắp xếp</h3>";
        echo "<table class='matrix-table'>";
        for ($i = 0; $i < $m; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $n; $j++) {
                echo "<td>" . $matrix[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        $sortedMatrix = sapXepGiamDan($matrix, $m, $n);

        echo "<h3 class='section-title'>Ma trận sau khi sắp xếp giảm dần</h3>";
        echo "<table class='matrix-table'>";
        for ($i = 0; $i < $m; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $n; $j++) {
                echo "<td>" . $sortedMatrix[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Nhập ma trận</title>
</head>

<body>
    <div class="container">

        <h2> Nhập kích thước ma trận</h2>

        <form method="post" class="center">
            <div class="form-group">
                <label>Số hàng (m):</label><br>
                <input type="number" name="m" required>
            </div>

            <div class="form-group">
                <label>Số cột (n):</label><br>
                <input type="number" name="n" required>
            </div>

            <input type="submit" name="submit" value="Tạo ma trận">
        </form>

        <?php if ($m > 0 && $n > 0 && isset($_POST['submit'])) { ?>

            <h3 class="center">Nhập giá trị cho ma trận</h3>

            <form method="post" class="center">
                <input type="hidden" name="m" value="<?php echo $m; ?>">
                <input type="hidden" name="n" value="<?php echo $n; ?>">

                <table>
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

                <input type="submit" name="save" value="Lưu ma trận">
            </form>

        <?php } ?>

    </div>
</body>

</html>