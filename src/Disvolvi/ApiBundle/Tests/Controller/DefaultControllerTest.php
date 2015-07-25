<?php

namespace Disvolvi\ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndexIsOnline()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('h1:contains("PHP - StackOverflow")')->count() == 1);
    }

    public function testDocsIsOnline()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stack_moblee/docs');

        $this->assertTrue($crawler->filter('h1:contains("API documentation")')->count() == 1);
    }
}
