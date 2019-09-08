<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Factories;


use RuleEngine\Constants\RuleConstants;
use RuleEngine\Constants\RuleNameConstants;
use RuleEngine\Traits\RuleEngineResponseTrait;

/**
 * Class RuleEngineFactory
 * Description: This is a factory to create rule manger, call the related function and return the final result
 */
class RuleEngineFactory
{
    use RuleEngineResponseTrait;

    /** @var RuleEngineServicesFactory */
    private $ruleEngineServices;

    /**
     * RuleEngineFactory constructor.
     * @param RuleEngineServicesFactory $ruleEngineServices
     */
    public function __construct(RuleEngineServicesFactory $ruleEngineServices)
    {
        $this->ruleEngineServices = $ruleEngineServices;
    }

    /**
     * @param string $rule
     * @param $data
     * @return array
     */
    public function getResult(string $rule, $data)
    {
        if (!in_array($rule, RuleNameConstants::$rules)) {
            return self::error(RuleConstants::RULE_INVALID);
        }

        $ruleArray = explode(":", $rule);
        $ruleManagerName = $ruleArray[0];
        $ruleMethodName = $ruleArray[1];

        $ruleManager = $this->getRuleManager($ruleManagerName);

        return $this->success($ruleManager->getRuleManagerResult($ruleMethodName, $data));
    }

    /**
     * @param $ruleManagerName
     * @return mixed
     */
    private function getRuleManager(string $ruleManagerName)
    {
        $ruleManagerName = $ruleManagerName . "RuleManager";
        $ruleManager = $this->ruleEngineServices->getRuleEngineServices($ruleManagerName);

        return $ruleManager;
    }
}
