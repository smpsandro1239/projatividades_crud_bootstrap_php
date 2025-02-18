<?php
require_once('functions.php');

// Inicia a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se foi fornecido um ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $database = open_database();

        // Verifica se a atividade existe
        $check_sql = "SELECT id FROM atividades WHERE id = ?";
        $check_stmt = $database->prepare($check_sql);
        $check_stmt->bind_param("i", $id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows === 0) {
            $_SESSION['message'] = "Atividade não encontrada.";
            $_SESSION['type'] = 'danger';
        } else {
            // Procede com a eliminação
            $delete_sql = "DELETE FROM atividades WHERE id = ?";
            $delete_stmt = $database->prepare($delete_sql);
            $delete_stmt->bind_param("i", $id);

            if ($delete_stmt->execute()) {
                $_SESSION['message'] = "Atividade eliminada com sucesso.";
                $_SESSION['type'] = 'success';
            } else {
                throw new Exception("Erro ao eliminar atividade.");
            }
            $delete_stmt->close();
        }
        $check_stmt->close();
        close_database($database);
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
} else {
    $_SESSION['message'] = "ID não fornecido.";
    $_SESSION['type'] = 'danger';
}

header('location: index.php');
exit();
