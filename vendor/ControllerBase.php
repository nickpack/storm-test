<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 20:35
 */

namespace vendor;

// Quick and dirty - would def not use in production!

class ControllerBase {

    protected $_template_file;
    protected $_template_dir;
    protected $_template_path;

    public function __construct()
    {
        $this->_template_path = realpath(dirname(__FILE__) . '/../app/views');
        $class_parts = explode('\\', get_class($this));
        $dir_name = strtolower(str_replace('Controller', '', end($class_parts)));

        $this->setTemplateDir($dir_name);
    }

    public function getTemplateFile()
    {
        return $this->_template_file;
    }

    protected function setTemplateFile($template_file)
    {
        $this->_template_file = $template_file;
        return $this;
    }

    public function getTemplateDir()
    {
        return $this->_template_dir;
    }

    protected function setTemplateDir($template_dir)
    {

        if (file_exists($this->_template_path . '/' . $this->getTemplateDir())) {
            $this->_template_dir = $template_dir;
        }

        return $this;
    }

    public function render($template_file, $values = array())
    {
        $template_file = sprintf('%s/%s/%s.html', $this->_template_path, $this->getTemplateDir(), $template_file);
        if (!file_exists($template_file)) {
            print $template_file;
            throw new \vendor\exception\TemplateException('Template file not found');
        }

        $template = file_get_contents($template_file);
        foreach ($values as $key => $value) {
            $needle = strtoupper($key);

            $template = str_replace(sprintf('{{%s}}', $needle), $value, $template);

            echo $template;
            exit;
        }
    }
}