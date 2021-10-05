<?php declare(strict_types=1);

namespace Tests\src\Controllers;

use App\Controllers\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testFileExists(): void
    {
        $this->assertFileExists(dirname(__DIR__, 3) . '/src/Controllers/Controller.php');
    }

    public function testClassInstantiation(): void
    {
        $this->assertInstanceOf(
          Controller::class,
          new Controller()
        );
    }
}
