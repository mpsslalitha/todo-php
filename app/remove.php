<?php

if (isset($_POST['id'])) {
    require '../db_conn.php';

    $id = $_POST['id'];

    if (empty($id)) {
        echo 0;
    } else {
        $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
        $res = $stmt->execute([$id]);

        if ($res) {
            header("Location: ../index.php?mess=success");
        } else {
            header("Location: ../index.php?mess=error");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}
