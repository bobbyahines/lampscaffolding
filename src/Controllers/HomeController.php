<?php declare(strict_types=1);

namespace App\Controllers;


use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomeController extends Controller
{

    public function index(ServerRequestInterface $request): ResponseInterface
    {

        $templatePath = '/Home/Home.twig';
        $template = $this->twig->load($templatePath);
        $render = $template->render(['title' => 'hello world.',]);

        $response = new Response();
        $response->getBody()->write($render);

        return $response;
    }
}