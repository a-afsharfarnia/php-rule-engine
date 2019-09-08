<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Traits;


/**
 * Trait RuleEngineResponseTrait
 * Description: This a trait to handle rule engine response
 */
trait RuleEngineResponseTrait
{
    /**
     * @param $data
     * @return array
     */
    public function success($data = null): array
    {
        $result = [
            'status' => true,
            'message' => '',
            'ruleResult' => $data
        ];

        return $result;
    }

    /**
     * @param $message
     * @return array
     */
    public function error($message = null): array
    {
        $result = [
            'status' => false,
            'message' => $message,
            'ruleResult' => ''
        ];

        return $result;
    }
}
