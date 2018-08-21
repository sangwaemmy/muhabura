<?php

    class dbconnection {

        function openconnection() {
            $db = new PDO('mysql:host=localhost;dbname=muhabura;charset=utf8mb4', 'root', 'Adm1n@50b');
            return $db;
        }

    }
    