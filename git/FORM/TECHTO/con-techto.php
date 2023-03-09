<?php

    $username = "SYSDBA"; // Usuário padrão do Firebird
    $password = "masterkey"; // Senha padrão do Firebird
    $dsn = 'firebird:dbname=192.168.5.1:D:\Cybersul\DataBases\dadosadm.fdb';
    $conn = null;
    try {
    $conn = new PDO($dsn, 
                    $username, 
                    $password
                    );
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
?>