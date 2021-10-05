<?php declare(strict_types=1);

namespace Tests;

use App\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{

    public function testFileExists(): void
    {
        $this->assertFileExists(dirname(__DIR__, 2) . '/src/Database.php');
    }

    public function testClassInstantiation(): void
    {
        $this->assertInstanceOf(
          Database::class,
          new Database()
        );
    }
}
