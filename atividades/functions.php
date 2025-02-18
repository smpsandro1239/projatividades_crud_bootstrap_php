<?php
require_once('../config.php');
require_once(DBAPI);

/**
 * Função auxiliar para sanitização de strings
 */
function sanitize_string($str)
{
    $str = strip_tags($str);
    $str = htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $str = trim($str);
    return $str;
}

/**
 * Listagem de Atividades
 */
function index()
{
    $database = open_database();
    $found = null;

    try {
        $sql = "SELECT * FROM atividades ORDER BY data DESC";
        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            $found = array();
            while ($row = $result->fetch_assoc()) {
                array_push($found, $row);
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}

/**
 * Registo de Atividades
 */
function add()
{
    if (!empty($_POST['atividades'])) {
        try {
            $atividade = $_POST['atividades'];

            // Sanitização
            $atividade['nome'] = sanitize_string($atividade['nome']);
            $atividade['descricao'] = sanitize_string($atividade['descricao']);
            $atividade['modalidade'] = sanitize_string($atividade['modalidade']);
            $atividade['dinamizadores'] = sanitize_string($atividade['dinamizadores']);
            $atividade['local'] = sanitize_string($atividade['local']);
            $atividade['destinatarios'] = sanitize_string($atividade['destinatarios']);

            // Validação de campos numéricos
            $atividade['numero_participantes'] = filter_var($atividade['numero_participantes'], FILTER_VALIDATE_INT);
            $atividade['custo'] = filter_var($atividade['custo'], FILTER_VALIDATE_FLOAT);

            // Validação da data
            $date = DateTime::createFromFormat('Y-m-d', $atividade['data']);
            if (!$date || $date->format('Y-m-d') !== $atividade['data']) {
                throw new Exception('Data inválida');
            }

            $database = open_database();

            $sql = "INSERT INTO atividades (
                nome,
                descricao,
                modalidade,
                dinamizadores,
                data,
                local,
                destinatarios,
                numero_participantes,
                custo
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?
            )";

            $stmt = $database->prepare($sql);
            $stmt->bind_param(
                "sssssssid",
                $atividade['nome'],
                $atividade['descricao'],
                $atividade['modalidade'],
                $atividade['dinamizadores'],
                $atividade['data'],
                $atividade['local'],
                $atividade['destinatarios'],
                $atividade['numero_participantes'],
                $atividade['custo']
            );

            if ($stmt->execute()) {
                $_SESSION['message'] = 'Atividade cadastrada com sucesso.';
                $_SESSION['type'] = 'success';
            } else {
                throw new Exception('Erro ao cadastrar atividade.');
            }

            $stmt->close();
            close_database($database);
            header('location: index.php');
        } catch (Exception $e) {
            $_SESSION['message'] = 'Erro: ' . $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }
}

/**
 * Atualização/Edição de Atividades
 */
function edit()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($_POST['atividades'])) {
            try {
                $atividade = $_POST['atividades'];

                // Sanitização
                $atividade['nome'] = sanitize_string($atividade['nome']);
                $atividade['descricao'] = sanitize_string($atividade['descricao']);
                $atividade['modalidade'] = sanitize_string($atividade['modalidade']);
                $atividade['dinamizadores'] = sanitize_string($atividade['dinamizadores']);
                $atividade['local'] = sanitize_string($atividade['local']);
                $atividade['destinatarios'] = sanitize_string($atividade['destinatarios']);

                // Validação de campos numéricos
                $atividade['numero_participantes'] = filter_var($atividade['numero_participantes'], FILTER_VALIDATE_INT);
                $atividade['custo'] = filter_var($atividade['custo'], FILTER_VALIDATE_FLOAT);

                // Validação da data
                $date = DateTime::createFromFormat('Y-m-d', $atividade['data']);
                if (!$date || $date->format('Y-m-d') !== $atividade['data']) {
                    throw new Exception('Data inválida');
                }

                $database = open_database();

                $sql = "UPDATE atividades SET
                    nome = ?,
                    descricao = ?,
                    modalidade = ?,
                    dinamizadores = ?,
                    data = ?,
                    local = ?,
                    destinatarios = ?,
                    numero_participantes = ?,
                    custo = ?
                    WHERE id = ?";

                $stmt = $database->prepare($sql);
                $stmt->bind_param(
                    "ssssssssdi",
                    $atividade['nome'],
                    $atividade['descricao'],
                    $atividade['modalidade'],
                    $atividade['dinamizadores'],
                    $atividade['data'],
                    $atividade['local'],
                    $atividade['destinatarios'],
                    $atividade['numero_participantes'],
                    $atividade['custo'],
                    $id
                );

                if ($stmt->execute()) {
                    $_SESSION['message'] = 'Atividade atualizada com sucesso.';
                    $_SESSION['type'] = 'success';
                } else {
                    throw new Exception('Erro ao atualizar atividade.');
                }

                $stmt->close();
                close_database($database);
                header('location: index.php');
            } catch (Exception $e) {
                $_SESSION['message'] = 'Erro: ' . $e->getMessage();
                $_SESSION['type'] = 'danger';
            }
        } else {
            $database = open_database();
            $atividade = null;

            try {
                $sql = "SELECT * FROM atividades WHERE id = ?";
                $stmt = $database->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $atividade = $result->fetch_assoc();
                }

                $stmt->close();
            } catch (Exception $e) {
                $_SESSION['message'] = $e->getMessage();
                $_SESSION['type'] = 'danger';
            }

            close_database($database);
            return $atividade;
        }
    }
}

/**
 * Visualização de uma atividade
 */
function view($id)
{
    $database = open_database();
    $found = null;

    try {
        $sql = "SELECT * FROM atividades WHERE id = ?";
        $stmt = $database->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $found = $result->fetch_assoc();
        }

        $stmt->close();
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}

/**
 * Eliminar uma atividade
 */
function delete($id)
{
    try {
        $database = open_database();

        $sql = "DELETE FROM atividades WHERE id = ?";
        $stmt = $database->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Atividade excluída com sucesso.';
            $_SESSION['type'] = 'success';
        } else {
            throw new Exception('Erro ao excluir atividade.');
        }

        $stmt->close();
        close_database($database);
        header('location: index.php');
    } catch (Exception $e) {
        $_SESSION['message'] = 'Erro: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
}

/**
 * Limpa mensagens de sessão
 */
function clear_messages()
{
    if (isset($_SESSION['message'])) unset($_SESSION['message']);
    if (isset($_SESSION['type'])) unset($_SESSION['type']);
}
