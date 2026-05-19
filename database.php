<?php

$pdo = new PDO("sqlite:erp.db");

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

$pdo->exec(

    "CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        price REAL,
        stock INTEGER,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )"
);
