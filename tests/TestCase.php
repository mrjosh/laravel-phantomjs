<?php

namespace Tests;

use Josh\Component\PhantomJs\PhantomJs;
use PHPUnit\Framework\TestCase as BaseTest;

class TestCase extends BaseTest
{
    protected $phantomjs;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->phantomjs = new PhantomJs;
        $this->phantomjs->setBinaryPath(env('PHANTOMJS_BINARY_PATH', '/usr/local/bin/phantomjs'));
    }
}