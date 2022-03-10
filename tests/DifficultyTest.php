<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Difficulty;

class DifficultyTest extends TestCase
{
    /** @test */
    public function testTitleGetSet(): void
    {
        $difficulty = new Difficulty();
        $difficulty->setTitle('Extreme');
        $this->assertEquals($difficulty->getTitle(), 'Extreme');
    }
    
    /** @test */
    public function testTitleIsString(): void
    {
        $difficulty = new Difficulty();
        $difficulty->setTitle('Extreme');
        $this->assertIsString($difficulty->getTitle());
    }
    
    /** @test */
    public function testTitleNotBlank(): void
    {
        $difficulty = new Difficulty();
        $difficulty->setTitle('E');
        $this->assertGreaterThan(0, strlen($difficulty->getTitle()));
    }
    
    /** @test */
    public function testTitleLengthGreaterThanEqualTo1(): void
    {
        $difficulty = new Difficulty();
        $difficulty->setTitle('E');
        $this->assertGreaterThanOrEqual(1, strlen($difficulty->getTitle()));
    }
    
    /** @test */
    public function testTitleLengthLessThanEqualTo255(): void
    {
        $difficulty = new Difficulty();
        $difficulty->setTitle('THIS STRING IS 255 CHARACTERS xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
        $this->assertLessThanOrEqual(255, strlen($difficulty->getTitle()));
    }   
}