<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
    /** @test */
    public function testFirstNameGetSet(): void
    {
        $user = new User();
        $user->setNameFirst('John');
        $this->assertEquals($user->getNameFirst(), 'John');
    }
    
    /** @test */
    public function testFirstNameIsString(): void
    {
        $user = new User();
        $user->setNameFirst('John');
        $this->assertIsString($user->getNameFirst());
    }
    
    /** @test */
    public function testFirstNameNotBlank(): void
    {
        $user = new User();
        $user->setNameFirst('J');
        $this->assertGreaterThan(0, strlen($user->getNameFirst()));
    }
    
    /** @test */
    public function testFirstNameLengthGreaterThanEqualTo2(): void
    {
        $user = new User();
        $user->setNameFirst('Jo');
        $this->assertGreaterThanOrEqual(2, strlen($user->getNameFirst()));
    }
    
    /** @test */
    public function testFirstNameLengthLessThanEqualTo255(): void
    {
        $user = new User();
        $user->setNameFirst('THIS STRING IS 255 CHARACTERS xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
        $this->assertLessThanOrEqual(255, strlen($user->getNameFirst()));
    }

    /** @test */
    public function testLastNameGetSet(): void
    {
        $user = new User();
        $user->setNameLast('Johnson');
        $this->assertEquals($user->getNameLast(), 'Johnson');
    }

    /** @test */
    public function testLastNameIsString(): void
    {
        $user = new User();
        $user->setNameLast('Johnson');
        $this->assertIsString($user->getNameLast());
    }    

    /** @test */
    public function testLastNameNotBlank(): void
    {
        $user = new User();
        $user->setNameLast('J');
        $this->assertGreaterThan(0, strlen($user->getNameLast()));
    }
    
    /** @test */
    public function testLastNameLengthGreaterThanEqualTo2(): void
    {
        $user = new User();
        $user->setNameLast('Jo');
        $this->assertGreaterThanOrEqual(2, strlen($user->getNameLast()));
    }
    
    /** @test */
    public function testLastNameLengthLessThanEqualTo255(): void
    {
        $user = new User();
        $user->setNameLast('THIS STRING IS 255 CHARACTERS xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
        $this->assertLessThanOrEqual(255, strlen($user->getNameLast()));
    }

    /** @test */
    public function testEmailGetSet(): void
    {
        $user = new User();
        $user->setEmail('john@example.com');
        $this->assertEquals($user->getEmail(), 'john@example.com');
    }

    /** @test */
    public function testEmailIsString(): void
    {
        $user = new User();
        $user->setEmail('john@example.com');
        $this->assertIsString($user->getEmail());
    }    

    /** @test */
    public function testEmailNotBlank(): void
    {
        $user = new User();
        $user->setEmail('j');
        $this->assertGreaterThan(0, strlen($user->getEmail()));
    }
    
    /** @test */
    public function testEmailLengthGreaterThanEqualTo3(): void
    {
        $user = new User();
        $user->setEmail('j@j');
        $this->assertGreaterThanOrEqual(3, strlen($user->getEmail()));
    }
    
    /** @test */
    public function testEmailLengthLessThanEqualTo180(): void
    {
        $user = new User();
        $user->setEmail('THIS STRING IS 180 CHARACTERS xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
        $this->assertLessThanOrEqual(180, strlen($user->getEmail()));
    }

    /** @test */
    public function testPasswordGetSet(): void
    {
        $user = new User();
        $user->setPassword('john123');
        $this->assertEquals($user->getPassword(), 'john123');
    }

    /** @test */
    public function testPasswordIsString(): void
    {
        $user = new User();
        $user->setPassword('john123');
        $this->assertIsString($user->getPassword());
    }

    /** @test */
    public function testPasswordNotBlank(): void
    {
        $user = new User();
        $user->setPassword('password');
        $this->assertGreaterThan(0, strlen($user->getPassword()));
    }
    
    /** @test */
    public function testPasswordLengthLessThanEqualTo(): void
    {
        $user = new User();
        $user->setPassword('password');
        $this->assertLessThanOrEqual(255, strlen($user->getPassword()));
    }
}