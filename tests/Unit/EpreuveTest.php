<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\Epreuve;
use App\Entity\Competition;

class EpreuveTest extends TestCase
{
    public function testCompetitionRelation(): void
    {
        $competition = new Competition();
        $epreuve = new Epreuve();

        $epreuve->setCompetition($competition);

        $this->assertSame($competition, $epreuve->getCompetition());
    }
}
