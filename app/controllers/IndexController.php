<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 20:42
 */

namespace app\controllers;

use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class IndexController extends \vendor\ControllerBase {

    public function index()
    {
        $helper = new \Facebook\FacebookRedirectLoginHelper(FACEACHE_REDIRECT_URL);
        $loginUrl = $helper->getLoginUrl();
        $this->render('index', array('fbloginurl' => $loginUrl));
    }

    public function user()
    {
        $session = $this->getFaceacheSession();

        if (!$session) {
            $this->redirect('index', 'index');
        }

        try {

            $user_profile = (new FacebookRequest(
                                                    $session,
                                                    'GET',
                                                    '/me'
                            )
            )->execute()->getGraphObject(GraphUser::className());

            $this->render('user', array('usersname' => $user_profile->getName()));

        } catch(FacebookRequestException $e) {
            $this->error($e->getMessage());
        }
    }
}