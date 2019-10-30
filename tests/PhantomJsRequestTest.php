<?php

namespace Tests;

use Illuminate\Support\Str;

class PhantomJsRequestTest extends TestCase
{
    /**
     * Sample request test
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 12 Feb, 2018
     * @throws \Exception
     */
    public function testSimpleRequest()
    {
        $request = $this->phantomjs->get('https://www.google.com/');

        $response = $this->phantomjs->send($request);

        $this->assertEquals($response->getUrl(),'https://www.google.com/');
        $this->assertEquals($response->getStatus(),200);
    }

    /**
     * Test create pdf from request
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 12 Feb, 2018
     * @throws \Exception
     * @throws \JonnyW\PhantomJs\Exception\NotWritableException
     */
    public function testCreatePdf()
    {
        $request = $this->phantomjs->createPdf('http://phantomjs.org/');
        $request->setOutputFile($filename = Str::random(30) . '.pdf');
        $request->setFormat('A4');
        $request->setOrientation('landscape');
        $request->setMargin('1cm');

        $this->phantomjs->send($request);

        $this->assertFileExists($filename);
        unlink($filename);
    }

    /**
     * Test create image from request
     *
     * @author Alireza Josheghani <josheghani.dev@gmail.com>
     * @since 12 Feb, 2018
     * @throws \JonnyW\PhantomJs\Exception\NotWritableException
     * @throws \Exception
     */
    public function testCreateImage()
    {
        $request = $this->phantomjs->createImage('http://phantomjs.org/');
        $request->setOutputFile($filename = Str::random(30) . '.png');
        $request->setViewportSize(800, 600);
        $request->setCaptureDimensions(800, 600, 0, 0);

        $this->phantomjs->send($request);

        $this->assertFileExists($filename);
        unlink($filename);
    }
}