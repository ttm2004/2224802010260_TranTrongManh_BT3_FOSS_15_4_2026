<?php
require_once 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ma phương</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="number"] {
            padding: 8px 10px;
            width: 120px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
        }

        input[type="number"]:focus {
            border-color: #007bff;
        }

        button {
            padding: 8px 16px;
            margin-left: 10px;
            border: none;
            border-radius: 6px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            margin: 20px auto 0;
        }

        td {
            border: 1px solid #ddd;
            padding: 12px;
            width: 45px;
            text-align: center;
            font-weight: bold;
            background: #fafafa;
        }

        tr:nth-child(even) td {
            background: #f1f1f1;
        }

        td:hover {
            background: #e0f0ff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tạo ma phương bậc n</h2>

    <form method="post">
        <label>Nhập n (số lẻ ≥ 3): </label><br><br>
        <input type="number" name="n" required>
        <button type="submit">Tạo</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = intval($_POST["n"]);

        if ($n % 2 == 0 || $n < 3) {
            echo "<p class='error'>Chỉ nhập số lẻ ≥ 3</p>";
        } 
        else if($n > 100) {
            echo "<p class='error'>Vui lòng nhập n ≤ 100</p>";
        }
        else {
            $matrix = taoMaPhuong($n);
            echo "<h3>Ma phương bậc $n:</h3>";
            printmatrix($matrix, $n, $n);
        }
    }
    ?>
</div>

</body>
</html>