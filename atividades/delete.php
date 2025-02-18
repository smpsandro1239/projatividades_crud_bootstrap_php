<?php
require_once('functions.php');

// Inicia a sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se foi fornecido um ID válido
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($id === false) {
        $_SESSION['message'] = "ID inválido.";
        $_SESSION['type'] = 'danger';
        header('location: index.php');
        exit();
    }

    try {
        $database = open_database();

        // Primeiro verifica se a atividade existe
        $check_sql = "SELECT id FROM atividades WHERE id = ?";
        $check_stmt = $database->prepare($check_sql);
        $check_stmt->bind_param("i", $id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Atividade não encontrada.");
        }

        // Se existe, procede com a exclusão
        $delete_sql = "DELETE FROM atividades WHERE id = ?";
        $delete_stmt = $database->prepare($delete_sql);
        $delete_stmt->bind_param("i", $id);

        if ($delete_stmt->execute()) {
            $_SESSION['message'] = 'Atividade excluída com sucesso.';
            $_SESSION['type'] = 'success';
        } else {
            throw new Exception('Erro ao excluir atividade.');
        }

        $check_stmt->close();
        $delete_stmt->close();
        close_database($database);
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
} else {
    $_SESSION['message'] = "ID não fornecido.";
    $_SESSION['type'] = 'danger';
}

// Redireciona de volta para a página principal
header('location: index.php');
exit();
