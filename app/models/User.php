<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 22:01
 */

namespace app\models;


class User {

    protected $_dbms;
    protected $_name;
    protected $_logintimestamp;
    protected $_avatarUrl;
    protected $_fbId;

    public function __construct()
    {
        $this->_dbms = \vendor\DBConnector::getInstance();
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getLogintimestamp()
    {
        return $this->_logintimestamp;
    }

    public function setLogintimestamp($logintimestamp)
    {
        $this->_logintimestamp = $logintimestamp;
        return $this;
    }

    public function getAvatarUrl()
    {
        return $this->_avatarUrl;
    }

    public function setAvatarUrl($avatarUrl)
    {
        $this->_avatarUrl = $avatarUrl;
        return $this;
    }

    public function getFbId()
    {
        return $this->_fbId;
    }

    public function setFbId($fbId)
    {
        $this->_fbId = $fbId;
        return $this;
    }

    public function save()
    {
        $prepared_insert = $this->_dbms->connection->prepare("INSERT INTO `users` VALUES(0, :name, NOW(), :avatar, :fbid");

        // Pass by reference avoidance
        $name = $this->getName();
        $avatar = $this->getAvatarUrl();
        $fbid = $this->getfbId();

        $prepared_insert->bindParam(':name', $name);
        $prepared_insert->bindParam(':avatar', $avatar);
        $prepared_insert->bindParam(':fbid', $fbid);
        $prepared_insert->execute();
    }
}