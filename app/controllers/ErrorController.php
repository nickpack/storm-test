<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 20:44
 */

namespace app\controllers;


class ErrorController extends \vendor\ControllerBase {

    public function fivehundred($reason = 'Nick fails')
    {
        $this->render('fivehundred', array('reason' => $reason));
    }

    public function fourohfour()
    {
        print "File not found";
    }
}