<?php

    $products = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $name = $_POST["name"];

        $products[] = $name;
    }
?>

<!DOCTYPE html>
<html lang="pl">
    
<head>
    <meta charset="UTF-8">
    <title>ERP System</title>
</head>

<body>

    <h1>Dodaj produkt</h1>
    
    <form method="POST">

        <input type="text" name="name" placeholder="Nazwa produktu">
        <button type="submit">Dodaj</button>

    </form>

    <hr>
    
    <h2>Produkty</h2>

    <?php foreach($products as $product): ?>

            <p>
                <?php echo $product; ?>
            </p>    
            
    <?php endforeach; ?>

</body>    

</html>