<?php

use ApiClient\Client;
use ApiClient\Resource\Producer;
use PHPUnit\Framework\TestCase;


class ProducerTest extends TestCase
{
    protected $producer;
    protected $client;

    public function setClient()
    {
        $this->client = new Client("http://grzegorz.demos.i-sklep.pl/rest_api/");
    }

    public function setProducer()
    {
        $this->setClient();
        $this->client->authorize("rest", "vKTUeyrt1!");
        $this->producer = new Producer($this->client);
    }

    public function testGetAll(){
        $this->setProducer();
        $this->assertEquals(true, is_array($this->producer->getAll()));
    }

    public function testCreateOne(){
        $this->setProducer();
        $respond = $this->producer->createOne("producent testowy", "pt.pl", "pt.jpg");
        $this->assertEquals(true, $respond->isSuccess());
    }

    public function testCreateOneNoName(){
        $this->setProducer();
        $respond = $this->producer->createOne("", "pt.pl", "pt.jpg");
        $this->assertEquals(false, $respond->isSuccess());
        $this->assertEquals("Nazwa musi mieć min 1 znak", $respond->getErrorMessages());
    }
}