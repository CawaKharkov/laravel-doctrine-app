<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Collective\Annotations\Routing\Annotations\Annotations\Get;
use Collective\Annotations\Routing\Annotations\Annotations\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 * @Middleware("web")
 * @Middleware("auth")
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @Get("/dashboard",as="dashboard.index")
     */
    public function index()
    {
        $users = $this->em->getRepository(\App\Entities\User::class)->findAll();

        return view('dashboard.index',[
            'users' => $users
        ]);
    }
}
