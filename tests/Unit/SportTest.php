<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\Sport;

class SportTest extends TestCase
{
    public function testNom()
    {
        $sport = new Sport();
        $sport->setNom('Football');

        $this->assertEquals('Football', $sport->getNom());
    }

    public function testType()
    {
        $sport = new Sport();
        $sport->setType(['Collectif']);

        $this->assertContains('Collectif', $sport->getType());
    }
}
