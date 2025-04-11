<?php

namespace App\Tests\Controller\Authentification;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegister(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Inscription');
        $this->assertCount(10, $crawler->filter('label'), 'Le nombre de label dans le formulaire est mauvais');
        $this->assertCount(11, $crawler->filter('input'), 'Le nombre d\'input dans le formulaire est mauvais');
    }
}
