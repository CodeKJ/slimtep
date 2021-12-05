<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends BaseController
{

    public function home(Request $request, Response $response) : Response
    {
        return $this->view->render($response, 'welcome.twig');
    }

}
