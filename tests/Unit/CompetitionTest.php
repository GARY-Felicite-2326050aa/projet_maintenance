<?php

namespace App\Tests\Unit;


use PHPUnit\Framework\TestCase;
use App\Entity\Competition;
use App\Entity\Championnats;

class CompetitionTest extends TestCase
{
    public function testChampionnatRelation(): void
    {
        $champ = new Championnats();
        $competition = new Competition();

        $competition->setChampionnat($champ);

        $this->assertSame($champ, $competition->getChampionnat());
    }
}

