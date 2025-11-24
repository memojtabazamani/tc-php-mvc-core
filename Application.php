<?php

namespace crazyprogrammer\phpmvc;

use app\controllers\Controller;
use crazyprogrammer\phpmvc\db\Database;
use crazyprogrammer\phpmvc\db\DbModel;
use app\models\User;

/**
 * @property  view
 */
class Application
{
    /**
     * @var mixed
     */
    public static string $ROOT_DIR;
    public $router;
    public $request;
    public $response;
    public static $APP;
    public $controller;
    public $db;
    public $session;
    public $user;
    public string $userClass;
    public string $layout = 'main';
    public View $view;
    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$APP = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->userClass = $config['userClass'];
        $this->view = new View();
        $pV = $this->session->get('user');
        if($pV) {
            $pK = $this->userClass::pK();
            $this->user = $this->userClass::findOne([$pK => $pV]);
        }
    }

    public static function isGuest()
    {
        return !self::$APP->user;
    }

    public function run() {
        try {
            echo $this->router->resolve();
        }catch(\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'ex' => $e
            ]);
        }

    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $pK = $user->pK();
        $pV = $user->{$pK};
        $this->session->set('user', $pV);

        return true;
    }

    public function logOut()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}