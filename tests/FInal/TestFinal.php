<?php

namespace App\Tests\Final;

use App\Entity\Sport;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestFinal extends WebTestCase
{
    public function testFullCrudSport(): void
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/sport/new');

        $form = $crawler->selectButton('Save')->form([
            'sport[nom]' => 'Rugby',
            'sport[type]' => 'Collectif', // valeur simple
        ]);

        $client->submit($form);

        $sport = static::getContainer()->get('doctrine')
            ->getRepository(Sport::class)
            ->findOneBy(['nom' => 'Rugby']);

        $this->assertNotNull($sport);
        $this->assertSame('Collectif', $sport->getType());
    }
}
