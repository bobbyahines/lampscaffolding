<?php declare(strict_types=1);

namespace Tests\src\Controllers;

use App\Controllers\HomeController;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    public function testFileExists(): void
    {
        $this->assertFileExists(dirname(__DIR__, 3) . '/src/Controllers/HomeController.php');
    }

    public function testClassInstantiation(): void
    {
        $this->assertInstanceOf(
          HomeController::class,
          new HomeController()
        );
    }
}
