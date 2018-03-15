$query_C = "SELECT * FROM client WHERE username = '$userName'";
    $result_C = mysqli_query($connection, $query_C);
    $row_C = mysqli_fetch_assoc($result_C);
