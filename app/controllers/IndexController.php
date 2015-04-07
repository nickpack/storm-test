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

            $user = new \app\models\User();

            $user->setName($user_profile->getName())
                 ->setFbId($user_profile->getId())
                 ->save();

            //$dbms = \vendor\DBConnector::getInstance();
            //$other_idiots = $dbms->query('SELECT * FROM `users` ORDER BY LoginTimestamp ASC')->setFetchMode(PDO::FETCH_ASSOC);
            // @todo Process other idiots and display them - wanky templating has bitten me and I'm out of time.

            $this->render('user', array(
                'usersname' => $user_profile->getName()
            ));

        } catch(FacebookRequestException $e) {
            $this->error($e->getMessage());
        }
    }
}