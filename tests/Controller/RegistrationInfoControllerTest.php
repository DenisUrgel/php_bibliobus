<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationInfoControllerTest extends WebTestCase
{
    public function testRegistrationInfo(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register-info');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', '10€');
    }
}
