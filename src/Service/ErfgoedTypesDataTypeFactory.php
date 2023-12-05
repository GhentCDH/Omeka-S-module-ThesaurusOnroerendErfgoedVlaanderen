<?php
namespace ThesaurusOnroerendErfgoedVlaanderen\Service;

use Interop\Container\ContainerInterface;
use ThesaurusOnroerendErfgoedVlaanderen\DataType\ErfgoedTypes\ErfgoedTypes;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ErfgoedTypesDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new ErfgoedTypes($services);
    }
}