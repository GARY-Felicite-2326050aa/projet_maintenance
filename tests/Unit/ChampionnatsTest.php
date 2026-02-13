<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\Championnats;
use App\Entity\Sport;

class ChampionnatsTest extends TestCase
{
    public function testRelationSport()
    {
        $sport = new Sport();
        $sport->setNom('Tennis');

        $championnat = new Championnats();
        $championnat->setNom('Roland Garros');
        $championnat->setSport($sport);

        $this->assertEquals($sport, $championnat->getSport());
    }
}
