<?php

session_start();

class NoticiasController extends RenderView
{
  private $authenticated;
  public function __construct()
  {
    $this->authenticated = isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ? 1 : 0;
  }

  public function index()
  {
    if (!($_SESSION['user_id'] > 0)) {
      header("Location: " . BASE_URL . "login");
    }
      $this->loadView('pages/add-noticias', []);
    $this->loadView('pages/dashboard', []);


    $this->loadView('pages/partials/footer', []);
  }

  public function create()
  {
    if (($_SERVER['REQUEST_METHOD'] == 'GET') || (!isset($_SESSION['user_id']))) {
      header('Location: ' . BASE_URL . 'login');
    }

    $msg = [];

    $noticias = new NoticiasModel();

    if (!isset($_POST['name']) || empty($_POST['name'])) {
      $msg['error'] = "Preencha o campo Name!";
    } else if (!isset($_POST['texto']) || empty($_POST['texto'])) {
      $msg['error'] = "Preencha o campo texto!";
    } else if (!isset($_POST['image']) || empty($_POST['image'])) {
      $msg['error'] = "Preencha o campo Image!";
    } else {
      $name = $_POST['name'];
      $texto = $_POST['texto'];
      $image = $_POST['image'];

      if ($noticias->create($name, $texto, $image)) {
        $msg['success'] = "Noticia criada com sucesso!";
      } else {
        $msg['error'] = "Desculpa, algo deu errado, tente mais tarde!";
      }
    }

    echo json_encode($msg);
  }

  public function edit($id)
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: ' . BASE_URL . 'login');
    }

    $auth = $this->authenticated;

    $noticiasModel = new NoticiasModel();
    $noticias = $noticiasModel->fetchNoticias($id[0]);

    $user = new UserModel();
    $user = $user->fetchUserById($_SESSION['user_id']);
    $permission = new UserModel();
    $permissao = $permission->permission($user['email']);
    if (!$noticias) {
      header('Location: ' . BASE_URL . 'login');
    }

    $this->loadView('pages/partials/header', [
      "title" => "Update noticias",
      "isAuth" => $auth,
      'user' => $user,
      'permissao' => $permissao,
    ]);
    $this->loadView('pages/edit-noticias', [
      'noticias' => $noticias,
      'permissao' => $permissao,

    ]);

    $this->loadView('pages/partials/footer', []);
  }

  public function updateNoticias()
  {
    if (($_SERVER['REQUEST_METHOD'] == 'GET') || (!isset($_SESSION['user_id']))) {
      header('Location: ' . BASE_URL . 'login');
    }

    $msg = [];

    $noticias = new NoticiasModel();

    if (!isset($_POST['name']) || empty($_POST['name'])) {
      $msg['error'] = "Preencha o campo Name!";
    } else if (!isset($_POST['texto']) || empty($_POST['texto'])) {
      $msg['error'] = "Preencha o campo texto!";
    } else if (!isset($_POST['image']) || empty($_POST['image'])) {
      $msg['error'] = "Preencha o campo Image!";
    } else if (!isset($_POST['id']) || empty($_POST['id'])) {
      $msg['error'] = "Desculpa, algo deu errado, tente mais tarde!";
    } else {
      $name = $_POST['name'];
      $texto = $_POST['texto'];
      $image = $_POST['image'];
      $id = $_POST['id'];

      if ($noticias->update($name, $texto, $image, $id)) {
        $msg['success'] = "Noticia atualizada com sucesso!";
      } else {
        $msg['error'] = "Desculpa, algo deu errado, tente mais tarde!";
      }
    }

    echo json_encode($msg);
  }

  public function delete()
  {
    if (($_SERVER['REQUEST_METHOD'] == 'GET') || (!isset($_SESSION['user_id']))) {
      header('Location: ' . BASE_URL . 'login');
    }

      $noticias = new NoticiasModel();
    
    $msg = [];

    if ($noticias->delete($_POST['id'])) {
      $msg['success'] = "Noticia deletada com sucesso!";
    } else {
      $msg['error'] = "Erro ao deletar a noticia!";
    }

    echo json_encode($msg);
  }
}