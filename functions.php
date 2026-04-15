<?php

// Hàm tính định thức của ma trận vuông có kích thước lớn hơn 2x2
function detLonHon2($matrix, $n)
{
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