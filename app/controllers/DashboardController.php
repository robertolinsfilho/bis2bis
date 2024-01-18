<?php

session_start();

class DashboardController extends RenderView
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

        $user = new UserModel();
        $user = $user->fetchUserById(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0);
        $permission = new UserModel();
        $permissao = $permission->permission($user['email']);


        $auth = $this->authenticated;


        $this->loadView('pages/dashboard', [
            'user' => $user,
        ]);

    }

}