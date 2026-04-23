<?php

// Hàm tính định thức của ma trận vuông có kích thước lớn hơn 2x2
function detLonHon2($matrix, $n)
{
    if ($n == 1) {
        return $matrix[0][0];
    }

    if ($n == 2) {
        return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
    }
    $det = 0;

    for ($j = 0; $j < $n; $j++) {
        $subMatrix = [];

        // tạo ma trận con
        for ($i = 1; $i < $n; $i++) {
            $row = [];
            for ($k = 0; $k < $n; $k++) {
                if ($k != $j) {
                    $row[] = $matrix[$i][$k];
                }
            }
            $subMatrix[] = $row;
        }

        // gọi lại chính nó (đệ quy)
        $det += pow(-1, $j) * $matrix[0][$j] * detLonHon2($subMatrix, $n - 1);
    }

    return $det;
}


// Hàm sắp xếp ma trận theo thứ tự giảm dần

function sapXepGiamDan($matrix, $m, $n)
{
    $arr = [];

    // chuyển ma trận thành mảng 1 chiều
    for($i = 0; $i <$m ;$i++){
        for($j = 0;$j < $n ;$j++){
            $arr[] = $matrix[$i][$j];
        }
    }

    rsort($arr); // sắp xếp mảng theo thứ tự giảm dần

    // chuyển mảng 1 chiều trở lại ma trận

    $index = 0;
    for($i = 0; $i < $m ; $i++){
        for($j = 0; $j < $n; $j++){
            $matrix[$i][$j] = $arr[$index];
            $index++;        
        }
    }
    //  tra về ma trận đã được sắp xếp
    return $matrix;  
}


// Hàm kiểm tra ma phương

function kiemtraMaPhuong($matrix, $m, $n){
    $tongmau = 0;

    // tính tổng của hàng đầu tiên trong ma trận

    for($i = 0 ; $i < $n ; $i++){
        $tongmau = $matrix[0][$i] + $tongmau;
    }

    // tinh tổng của các hàng còn lại và so sánh với tổng mẫu
    for($i = 1; $i < $m ; $i++){
        $tonghang = 0;
        for($j = 0; $j < $n ; $j++){
            $tonghang = $matrix[$i][$j] + $tonghang;
        }
        if($tonghang != $tongmau){
            return false; // nếu có hàng nào có tổng khác tổng mẫu thì không phải ma phương
        }
    }
    // tính tổng của các cột và so sánh với tổng mẫu
    for($j = 0; $j < $n ; $j++){
        $tongcot = 0;
        for($i = 0; $i < $m ; $i++){
            $tongcot = $matrix[$i][$j] + $tongcot;
        }
        if($tongcot != $tongmau){
            return false; // nếu có cột nào có tổng khác tổng mẫu thì không phải ma phương
        }
    }
    // tính tổng của đường chéo chính và so sánh với tổng mẫu
    $tongcheochinh = 0;
    for($i = 0; $i < $m ; $i++){
        $tongcheochinh = $matrix[$i][$i] + $tongcheochinh;
    }
    if($tongcheochinh != $tongmau){
        return false; // nếu tổng đường chéo chính khác tổng mẫu thì không phải ma phương
    }
    // tính tổng của đường chéo phụ và so sánh với tổng mẫu
    $tongcheophu = 0;
    for($i = 0; $i < $m ; $i++){
        $tongcheophu = $matrix[$i][$n - 1 - $i] + $tongcheophu;
    }
    if($tongcheophu != $tongmau){
        return false; // nếu tổng đường chéo phụ khác tổng mẫu thì không phải ma phương
    }
    return true; // nếu tất cả các tổng đều bằng tổng mẫu thì đây là ma phương
}

// Hàm tạo ma phương bậc n (đối với n lẻ)

function taoMaPhuong($n) {
    $magic = array_fill(0, $n, array_fill(0, $n, 0));

    $num = 1;
    $i = 0;
    $j = intval($n / 2);

    while ($num <= $n * $n) {
        $magic[$i][$j] = $num;

        $num++;
        $newi = ($i - 1 + $n) % $n;
        $newj = ($j + 1) % $n;

        if ($magic[$newi][$newj] != 0) {
            $i = ($i + 1) % $n;
        } else {
            $i = $newi;
            $j = $newj;
        }
    }

    return $magic;
}

// Hàm in ma trận

function printmatrix($matrix , $m , $n) {
    echo "<table class='matrix-table'>";
    foreach ($matrix as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}