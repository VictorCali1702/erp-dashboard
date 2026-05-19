<?php
    require "database.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "INSERT INTO products (name, price, stock) VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST["name"],
            $_POST["price"],
            $_POST["stock"]
        ]);

        header("Location: index.php");
        exit;
    }

    $query = $pdo->query(
        "SELECT * from products ORDER BY id desc"
    );

    $products = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="pl">
    
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ERP Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            margin-bottom: 30px;
            color: #222;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        input {
            padding: 12px;
            border: 1px sold #ddd;
            border-radius: 8px;
            min-width: 200px;
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            background: black;
            color: white;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f1f1f1;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-box {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            margin-top: 10px;
        }

    </style>

</head>

<body>

<div class="container">
    <h1>ERP Dashboard</h1>

    <div class="stats">
        <div class="stat-box">
            <p>Liczba produktów</p>
            <div class="stat-number">
                <?php echo count($products); ?>
            </div>
        </div>    
    </div>

    <div class="card">
        <h2>Dodaj produkt</h2>

        <form method="POST">

        <input type="text" name="name" placeholder="Nazwa produktu" required>
        <input type="number" name="price" placeholder="Cena" required>
        <input type="number" name="stock" placeholder="Stan magazynowy" required>
        <button type="submit">Dodaj produkt</button>

        </form>
    
    </div>
    
    <div class="card">
        <h2>Lista produktów</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Cena</th>
                <th>Stan</th>
            </tr>

            <?php foreach($products as $product): ?>

                <tr>
                    
                    <td>
                        <?php echo $product["id"]; ?>
                    </td>

                    <td>
                        <?php echo $product["name"]; ?>
                    </td>

                    <td>
                        <?php echo $product["price"]; ?> zł
                    </td>

                    <td>
                        <?php echo $product["stock"]; ?>
                    </td>
                
                </tr>

            <?php endforeach; ?>
        
        </table>
    
    </div>

</body>    

</html>