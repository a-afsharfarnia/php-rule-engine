<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Services;


/**
 * Abstract Class RuleManagerAbstract
 * Description: This is an abstract for rule engine services
 */
abstract class RuleManagerAbstract
{
    /**
     * @param string $ruleMethodName
     * @param $data
     * @return mixed
     */
    public function getRuleManagerResult(string $ruleMethodName, $data)
    {
        $ruleResult = $this->{$ruleMethodName}($data);

        return $ruleResult;
    }
}
