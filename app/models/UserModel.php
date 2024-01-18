<?php

class UserModel extends Database
{
  private $pdo;

  public function __construct()
  {
    $conn = $this->getConnection();
    $mysqli = $this->getConnectionMysqli();
    $this->pdo = $conn;
    $this->mysqli = $mysqli;
  }

  public function login($email, $passwd)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
      $stm->execute([$email]);

      if ($stm->rowCount() > 0) {
        $user = $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }

      if (password_verify($passwd, $user['passwd'])) {
        return $user['id'];
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

    public function permission($email)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stm->execute([$email]);

            if ($stm->rowCount() > 0) {
                $user = $stm->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }

            if ($user['id_permissao']  == 1) {
                return 'admin';
            } else {
                return 'not_admin';
            }
        } catch (PDOException $e) {
            return false;
        }
    }

  public function fetchUserById($id)
  {
    try {
      $stm = $this->pdo->prepare("SELECT username, email, avatar FROM users WHERE id = ?");
      $stm->execute([$id]);

      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC);
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

  public function update($data)
  {
    try {
      $stm = $this->pdo->prepare("UPDATE users SET username = ?, passwd = ?, avatar = ? WHERE id = ?");
      $stm->execute([
        $data['username'], $data['passwd'], $data['avatar'], $data['id']
      ]);

      if ($stm->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

  public function dump()
  {

      try {
          $tables = false;
          $this->mysqli->select_db('bis2bis');
          $this->mysqli->query("SET NAMES 'utf8'");
          $queryTables = $this->mysqli->query('SHOW TABLES');
          while ($row = $queryTables->fetch_row()) {
              $target_tables[] = $row[0];
          }
          if ($tables !== false) {
              $target_tables = array_intersect($target_tables, $tables);
          }
          foreach ($target_tables as $table) {
              $result = $this->mysqli->query('SELECT * FROM ' . $table);
              $fields_amount = $result->field_count;
              $rows_num = $this->mysqli->affected_rows;
              $res = $this->mysqli->query('SHOW CREATE TABLE ' . $table);
              $TableMLine = $res->fetch_row();
              $content = (!isset($content) ? '' : $content) . "\n\n" . $TableMLine[1] . ";\n\n";
              for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                  while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                      if ($st_counter % 100 == 0 || $st_counter == 0) {
                          $content .= "\nINSERT INTO " . $table . " VALUES";
                      }
                      $content .= "\n(";
                      for ($j = 0; $j < $fields_amount; $j++) {
                          $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                          if (isset($row[$j])) {
                              $content .= '"' . $row[$j] . '"';
                          } else {
                              $content .= '""';
                          }
                          if ($j < ($fields_amount - 1)) {
                              $content .= ',';
                          }
                      }
                      $content .= ")";
                      if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                          $content .= ";";
                      } else {
                          $content .= ",";
                      }
                      $st_counter = $st_counter + 1;
                  }
              }
              $content .= "\n\n\n";
          }

          $backup_name = "dump.sql";
          header('Content-Type: application/octet-stream');
          header("Content-Transfer-Encoding: Binary");
          header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");

            return true;
      }catch(PDOException $e) {
              return false;
          }
  }
}