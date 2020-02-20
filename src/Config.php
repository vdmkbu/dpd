<?php

namespace Vdmkbu\Dpd;


class Config
{
    protected $options = [];

    public function __construct($config = [])
    {
        $this->init($config);
    }

    public function get($option, $defaultValue = null)
    {

        if (isset($this->options[$option])) {
            return $this->options[$option];
        }

        return $defaultValue;
    }

    public function set($option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    protected function init($config =[])
    {
        $this->options = array_merge($this->options, $config);
    }
}