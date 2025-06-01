<?php

function get_connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "neosantara";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}

function query($sql, $fetch = false)
{
    $conn = get_connection();
    $result = $conn->query($sql);

    if ($fetch) {
        return $result->fetch_assoc();
    }

    return $result;
}
