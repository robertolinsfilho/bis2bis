<?php

class NoticiasModel extends Database
{
  private $pdo;

  public function __construct()
  {
    $conn = $this->getConnection();
    $this->pdo = $conn;
  }

  public function create($name, $texto, $image)
  {

    try {
      $stm = $this->pdo->prepare("INSERT INTO noticias (name, texto, image) VALUES (?, ?, ?)");
      $stm->execute([$name, $texto, $image]);

      if ($this->pdo->lastInsertId() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }

  public function getTotalNoticias()
  {
    try {
      $stm = $this->pdo->query("SELECT COUNT(*) as total FROM noticias");
      if ($stm->rowCount() > 0) {
        return $stm->fetch(PDO::FETCH_ASSOC)['total'];
      } else {
        return [];
      }
    } catch (PDOException $e) {
      return [];
    }
  }

  public function allNoticias($offset, $limit)
  {
    try {
      $stm = $this->pdo->query("SELECT * FROM noticias LIMIT $offset, $limit");
      if ($stm->rowCount() > 0) {
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      } else {
        return [];
      }
    } catch (PDOException $err) {
      return [];
    }
  }

  public function fetchNoticias($id)
  {
    try {
      $stm = $this->pdo->prepare("SELECT * FROM noticias WHERE id = ?");
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

  public function update($name, $texto, $image, $id)
  {
    try {
      $stm = $this->pdo->prepare("UPDATE noticias SET name = ?, texto = ?, image = ? WHERE id = ?");
      $stm->execute([$name, $texto, $image, $id]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function delete($id)
  {
    try {
      $stm = $this->pdo->prepare("DELETE FROM noticias WHERE id = ?");
      $stm->execute([$id]);
      if ($stm->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }
}