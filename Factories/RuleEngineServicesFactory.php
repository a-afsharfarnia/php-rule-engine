<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Factories;

use Exchange\RuleEngineBundle\Constants\RuleNameConstants;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RuleEngineServicesFactory
 * Description: This is a factory to create and return rule engine services
 */
class RuleEngineServicesFactory implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getRuleEngineServices($service)
    {
        return $this->container->get(RuleNameConstants::MANAGER_NAME_SPACE . $service);
    }
}




