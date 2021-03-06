<?php

namespace Persona\Hris\Controller\Admin;

use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController;
use Persona\Hris\Repository\CityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@personahris.com>
 */
class CityController extends AdminController
{
    /**
     * @Route(path = "/region/{id}/cities", name = "city_by_region")
     *
     * @param string $id
     *
     * @return Response
     */
    public function findCityByRegionAction(string $id)
    {
        $cities = $this->container->get(CityRepository::class)->findCityByRegion($id);

        return new JsonResponse(['cities' => $cities]);
    }

    /**
     * @param string $entityClass
     * @param string $searchQuery
     * @param array  $searchableFields
     * @param null   $sortField
     * @param null   $sortDirection
     * @param null   $dqlFilter
     *
     * @return QueryBuilder
     */
    protected function createSearchQueryBuilder($entityClass, $searchQuery, array $searchableFields, $sortField = null, $sortDirection = null, $dqlFilter = null)
    {
        return CityRepository::createQueryBuilderForSearch($this->getDoctrine(), $searchQuery, $searchableFields, $sortField, $sortDirection, $dqlFilter);
    }
}
