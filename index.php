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
            background: #f4f7fb;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #111827;
            color: white;
            padding: 30px 20px;
            position: fixed;
        }

        .logo {
            font-size:28px;
            font-weight: bold;
            margin-bottom:40px;
        }

        .menu {
            list-style:none;
        }

        .menu li {
            color: #d1d5db;
            text-decoration:none;
            font-size:18px;
            transition: 0.2s;
        }

        .menu a:hover{
            color: white;
        }

        /* MAIN */

        .main {
            margin-left:250px;
            width:100px;
            padding:30px;
        }

        /* TOPBAR */

        .topbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .tobar h1{
            font-size:34px;
        }

        .user-box{
            background:white;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* STATS */

        .stats {
            display: grid;
            grid-templates-columns:repeat(3,1fr);
            gap: 20px;
            margin-bottom:30px;
        }

        .stat-card h3 {
            color: gray;
            margin-bottom:10px;
        }

        .stat-number{
            font-size:34px;
            font-weight:bold;
        }

        /* CARD */

        .card{
            background:white;
            padding: 25px;
            border-radius:16px;
            margin-bottom:30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card h2 {
            margin-bottom:20px;
        }

        /* FORM */
        form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        input{
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            min-width:200px;
        }

        button {
            padding: 14px 22px;
            border:none;
            border-radius:10px;
            background: #111827;
            color: white;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover{
            opacity: 0.9;
        }

        /* TABLE */
        table {
            width:100%;
            border-collapse:collapse;
        }

        th{
            background: #f3f4f6;
            padding: 18px;
            text-align:left;
        }

        td{
            padding: 18px;
            border-bottom:1px solid #eee;
        }

        .low-stock{
            color:red;
            font-weight:bold;
        }

        /* MOBILE */
        @media(max-width:900px){
            .sidebar{
                display:none;
            }

            .main{
                margin-left:0;
            }

            .stats{
                grid-template-columns:1fr;
            }

        }

    </style>

</head>

<body>

<div class="sidebar">
    
    <div class="logo">
        ERP PRO
    </div>

    <ul class="menu">
        <li>
            <a href="#">Dashboard</a>
        </li>
        <li>
            <a href="#">Produkty</a>
        </li>
        <li>
            <a href="#">Zamówienia</a>
        </li>
        <li>
            <a href="#">Klienci</a>
        </li>
        <li>
            <a href="#">Statystyki</a>
        </li>
    </u>

</div>

<div class="main">

    <div class="topbar">
        <h1>ERP Dashboard</h1>
        <div class="user-box">
            Admin
        </div>
    </div>

    <div class="stats">
        <div class="stat-card">
            <h3>Produkty</h3>
            <div class="stat-number">
                <?php echo count($products); ?>
            </div>
        </div>
        <div class="stat-card">
            <h3>Low Stock</h3>
            <div class="stat-number">
                2
            </div>
        </div>
        <div class="stat-card">
            <h3>Zamówienia</h3>
            <div class="stat-number">
                14
            </div>
        </div>
    </div>

    <div class="card">
        <h2>Dodaj produkt</h2>

        <form method="POST">
            <input type="text" name="name" placeholder="Nazwa Produktu" required>
            <input type="number" name="price" placeholder="Cena" required>
            <input type="number" name="stock" placeholder="Stan" required>
            <button type="submit">Dodaj</button>
        </form>
    </div>

    <div class="card">
        <h2>Produkty</h2>

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
                        <?php
                        if($product["stock"] < 10){
                            echo "<span class='low-stock'>".$product["stock"]."</span>";
                        }else {
                            echo $product["stock"];
                        }

                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    
</body>    

</html>