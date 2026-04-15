<?php
require_once 'functions.php';
if (isset($_POST['submit'])) {
    $m1 = $_POST['m1'];
    $n1 = $_POST['n1'];
    $m2 = $_POST['m2'];
    $n2 = $_POST['n2'];

    if (empty($m1) || empty($n1) || empty($m2) || empty($n2)) {
        echo "<div class='error'>Không được để trống m hoặc n</div>";
    } elseif ($m1 <= 0 || $n1 <= 0 || $m2 <= 0 || $n2 <= 0) {
        echo "<div class='error'>Số hàng và số cột phải lớn hơn 0</div>";
    } elseif (!is_numeric($m1) || !is_numeric($n1) || !is_numeric($m2) || !is_numeric($n2)) {
        echo "<div class='error'>Số hàng và số cột phải là số</div>";
    } elseif ($m1 > 100 || $n1 > 100 || $m2 > 100 || $n2 > 100) {
        echo "<div class='error'>Số hàng và số cột phải nhỏ hơn hoặc bằng 100</div>";
    } else {
        echo "<div class='success'>Kích thước ma trận hợp lệ: m1 = $m1, n1 = $n1, m2 = $m2, n2 = $n2</div>";
    }
}

if (isset($_POST['submit_matrix'])) {
    $matrix1 = $_POST['matrix1'];
    $matrix2 = $_POST['matrix2'];
    $m1 = $_POST['m1'];
    $n1 = $_POST['n1'];
    $m2 = $_POST['m2'];
    $n2 = $_POST['n2'];

    echo "<div class='card'>";
    echo "<div class='success'>Hai ma trận đã được lưu thành công</div>";
    echo "<div class='info'>Ma trận thứ nhất kích thước $m1 x $n1</div>";
    echo "<div class='info'>Ma trận thứ hai kích thước $m2 x $n2</div>";
    echo "</div>";

    echo "<h3 class='center'>Ma trận thứ nhất</h3>";
    echo printMatrix($matrix1, $m1, $n1);
    echo "<h3 class='center'>Ma trận thứ hai</h3>";
    echo printMatrix($matrix2, $m2, $n2);

    if ($m1 == $m2 && $n1 == $n2) {
        echo "<h3 class='center'>Kết quả phép cộng hai ma trận</h3>";
        $C = [];
        for ($i = 0; $i < $m1; $i++) {
            for ($j = 0; $j < $n1; $j++) {
                $C[$i][$j] = $matrix1[$i][$j] + $matrix2[$i][$j];
            }
        }
        echo printMatrix($C, $m1, $n1);


        echo "<h3 class='center'>Kết quả phép trừ hai ma trận</h3>";
        $E = [];
        for ($i = 0; $i < $m1; $i++) {
            for ($j = 0; $j < $n1; $j++) {
                $E[$i][$j] = $matrix1[$i][$j] - $matrix2[$i][$j];
            }
        }
        echo printMatrix($E, $m1, $n1);
    } else {
        echo "<div class='error'>Hai ma trận không cùng kích thước, không thể thực hiện các phép toán ma trận</div>";
    }
    if ($n1 = $m2) {
        echo "<h3 class='center'>Kết quả phép nhân hai ma trận</h3>";
        $D = [];
        for ($i = 0; $i < $m1; $i++) {
            for ($j = 0; $j < $n1; $j++) {
                $D[$i][$j] = 0;
                for ($k = 0; $k < $n1; $k++) {
                    $D[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
                }
            }
        }
        echo printMatrix($D, $m1, $n2);
    }
    else {
        echo "<div class='error'>Số cột của ma trận thứ nhất phải bằng số hàng của ma trận thứ hai để thực hiện phép nhân</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bài toán ma trận</title>
</head>

<body>
    <div class="container">
        <h2>Bài toán ma trận</h2>
        <form method="post" class="center">
            <!-- Nhập số hàng và cột của 2 ma trận  -->
            <!-- Ma trận thứ nhất -->
            <h3>Ma trận thứ nhất</h3>
            <div class="form-group">
                <label>Số hàng (m):</label>
                <input type="number" name="m1" required>
            </div>
            <div class="form-group">
                <label>Số cột (n):</label>
                <input type="number" name="n1" required>
            </div>
            <!-- Ma trận thứ hai -->
            <h3>Ma trận thứ hai</h3>
            <div class="form-group">
                <label>Số hàng (m):</label>
                <input type="number" name="m2" required>
            </div>
            <div class="form-group">
                <label>Số cột (n):</label>
                <input type="number" name="n2" required>
            </div>
            <input type="submit" name="submit" value="Tạo ma trận">
        </form>

        <?php if (isset($_POST['submit']) && !empty($m1) && !empty($n1) && !empty($m2) && !empty($n2) && $m1 > 0 && $n1 > 0 && $m2 > 0 && $n2 > 0 && is_numeric($m1) && is_numeric($n1) && is_numeric($m2) && is_numeric($n2) && $m1 <= 100 && $n1 <= 100 && $m2 <= 100 && $n2 <= 100) { ?>

            <h3 class="center">Nhập giá trị cho hai ma trận</h3>

            <form method="post" class="center">
                <input type="hidden" name="m1" value="<?php echo $m1; ?>">
                <input type="hidden" name="n1" value="<?php echo $n1; ?>">
                <input type="hidden" name="m2" value="<?php echo $m2; ?>">
                <input type="hidden" name="n2" value="<?php echo $n2; ?>">

                <!-- Nhập giá trị cho ma trận thứ nhất -->

                <table>
                    <?php
                    for ($i = 0; $i < $m1; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < $n1; $j++) {
                            echo "<td>
                        <input type='number' name='matrix1[$i][$j]' required>
                    </td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
                <!-- Nhập giá trị cho ma trận thứ hai -->
                <table>
                    <?php
                    for ($i = 0; $i < $m2; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < $n2; $j++) {
                            echo "<td>
                        <input type='number' name='matrix2[$i][$j]' required>
                    </td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
                <input type="submit" name="submit_matrix" value="Tạo ma trận">
            </form>
        <?php } ?>

    </div>
</body>

</html>