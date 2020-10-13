<?php

namespace App\Controller;

use App\Repository\BundleRepository;
use App\Repository\PlatformRepository;
use App\Repository\ProviderRepository;
use App\Service\ExchangeService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    public function __construct(ManagerRegistry $managerRegistry, ExchangeService $exchangeClient)
    {
        $this->managerRegistry = $managerRegistry;
        $this->exchangeClient = $exchangeClient;
    }
    /**
     * @Route("/api/bundles")
     */
    public function getBundles()
    {
        return $this->json(
            (new BundleRepository($this->managerRegistry))->getAll()
        );
    }

    /**
     * @Route("/api/providers")
     */
    public function getProviders()
    {
        return $this->json(
            (new ProviderRepository($this->managerRegistry))->getAll()
        );
    }

    /**
     * @Route("/api/platforms")
     */
    public function getPlatforms()
    {
        return $this->json(
            (new PlatformRepository($this->managerRegistry))->getAll()
        );
    }

    /**
     * @Route("/api/exchange")
     */
    public function getCurrencies()
    {
        return $this->json($this->exchangeClient->getEuro());
    }
}