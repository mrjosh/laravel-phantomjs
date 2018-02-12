<?php

namespace Tests;

class LaravelPhantomJsTest extends TestCase
{
    /**
     * Test request from phantomjs
     *
     * @throws \Exception
     */
    public function testRequest()
    {
        $response = $this->phantomjs->get('https://google.com');
        $this->assertEquals('https://google.com/', $response->getUrl());
    }
}