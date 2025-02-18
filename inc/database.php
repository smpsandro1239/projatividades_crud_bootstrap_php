<?php
mysqli_report(MYSQLI_REPORT_STRICT);

function open_database()
{
    try {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($connection->connect_error) {
            throw new Exception("Falha na conexão: " . $connection->connect_error);
        }
        return $connection;
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}

function close_database($conn)
{
    try {
        mysqli_close($conn);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/*
* Pesquisa um registo pelo ID numa Tabela
*/
function find($table = null, $id = null)
{
    $database = open_database();
    $found = null;
    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);
            if ($result->num_rows > 0) {
                $found = $result->fetch_assoc();
            }
        } else {
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);
            if ($result->num_rows > 0) {
                $found = $result->fetch_all(MYSQLI_ASSOC);
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
    return $found;
}

function save($table = null, $data = null)
{
    $database = open_database();
    $columns = null;
    $values = null;

    if (!is_array($data) || empty($data)) {
        $_SESSION['message'] = 'Dados inválidos.';
        $_SESSION['type'] = 'danger';
        return;
    }

    foreach ($data as $key => $value) {
        $columns .= trim($key, "'") . ",";
        $values .= "'" . mysqli_real_escape_string($database, $value) . "',";
    }

    $columns = rtrim($columns, ',');
    $values = rtrim($values, ',');
    $sql = "INSERT INTO " . $table . " ($columns) VALUES ($values);";
    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registo inserido com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação. ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
}

/**
 * Atualiza um registo numa tabela, por ID
 */
function update($table = null, $id = 0, $data = null)
{
    $database = open_database();
    $items = null;
    foreach ($data as $key => $value) {
        $items .= trim($key, "'") . "='$value',";
    }
    // remove a ultima virgula
    $items = rtrim($items, ',');
    $sql = "UPDATE " . $table;
    $sql .= " SET $items";
    $sql .= " WHERE id=" . $id . ";";
    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registo atualizado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operacao.';
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}

/*
* Remove uma linha de uma tabela pelo ID do registo
*/
function remove($table = null, $id = null)
{
    $database = open_database();
    try {
        if ($id) {
            $sql = "DELETE FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);
            if ($result = $database->query($sql)) {
                $_SESSION['message'] = "Registo eliminado com sucesso!";
                $_SESSION['type'] = 'success';
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}
