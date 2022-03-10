<?php

namespace App\Tests;

use App\Entity\Difficulty;
use PHPUnit\Framework\TestCase;
use App\Entity\Hiscore;
use App\Entity\User;

class HiscoreTest extends TestCase
{
    /** @test */
    public function testScoreGetSet(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setScore(1337);
        $this->assertEquals($hiscore->getScore(), 1337);
    }

    /** @test */
    public function testScoreIsInt(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setScore(1337);
        $this->assertIsInt($hiscore->getScore());
    }
    
    /** @test */
    public function testScoreGreaterThanEqualTo0(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setScore(0);
        $this->assertGreaterThanOrEqual(0, $hiscore->getScore());
    }
    
    /** @test */
    public function testScoreLessThanEqualTo99999(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setScore(99999);
        $this->assertLessThanOrEqual(99999, strlen($hiscore->getScore()));
    }   

    /** @test */
    public function testModeratedGetSet(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setModerated(true);
        $this->assertEquals($hiscore->getModerated(), true);
    }
    /** @test */
    public function testModeratedIsBoolean(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setModerated(true);
        $this->assertIsBool($hiscore->getModerated());
    }

    /** @test */
    public function testDeletedGetSet(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setDeleted(true);
        $this->assertEquals($hiscore->getDeleted(), true);
    }
    /** @test */
    public function testDeletedIsBoolean(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setDeleted(true);
        $this->assertIsBool($hiscore->getDeleted());
    }



    /** @test */
    public function testCreateHiscore(): void
    {
        $hiscore = new Hiscore();
        $hiscore->setModerated(true);
        $hiscore->setDeleted(false);
        $user = new User();
        $difficulty = new Difficulty();
        $hiscore->setUser($user);
        $hiscore->setDifficulty($difficulty);

        $this->assertIsBool($hiscore->getDeleted());
        $this->assertIsBool($hiscore->getModerated());
        $this->assertEquals($hiscore->getUser(), $user);
        $this->assertEquals($hiscore->getDifficulty(), $difficulty);
    }
}