<?php

use ApiClient\Client;
use PHPUnit\Framework\TestCase;


class ClientTest extends TestCase
{

    protected $client;

    public function setClient()
    {
        $this->client = new Client("http://grzegorz.demos.i-sklep.pl/rest_api/");
    }

    public function testAuthorization(){
        $this->setClient();
    	$this->client->authorize("rest", "vKTUeyrt1!");
        $this->assertEquals($this->client->getHeaders()['authorization'], 'Basic cmVzdDp2S1RVZXlydDEh');
    }

    public function setWrongUrlClient(){
        $this->client = new Client("http://test.demos.i-sklep.pl/rest_api/");
    }

    public function testWrongUrlRequest(){
        $this->setWrongUrlClient();
        $this->client->authorize("rest", "vKTUeyrt1!");
        $this->expectException(\Exception::class);
        $this->client->get('/shop_api/v1/producers');
    }

}