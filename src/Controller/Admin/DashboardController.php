<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Controller\Admin\LivreCrudController;
use App\Controller\Admin\AuteurCrudController;


use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(LivreCrudController::class)->generateUrl();

        return $this->redirect($url);
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');


    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Biblioweb');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);


        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linktoRoute('retour au site', 'fas fa-institution', 'index');
        yield MenuItem::linkToCrud('Livres', 'fas fa-book', Livre::class);
        yield MenuItem::linkToCrud('Auteur', 'fas fa-users', Auteur::class);
    }
}
