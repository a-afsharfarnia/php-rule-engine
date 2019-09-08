<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Services;


use RuleEngine\Constants\RuleConstants;
use src\IpBundle\Services\IpService;
use src\LocationBundle\Services\LocationService;

/**
 * Class RegisterRuleManager
 * Description: This is a rule engine service to handle all the rules in register process
 */
class RegisterRuleManager extends RuleManagerAbstract
{
    /** @var IpService */
    private $ipService;

    /** @var LocationService */
    private $locationService;


    /**
     * RegisterRuleManager constructor.
     * @param IpService $ipService
     * @param LocationService $locationService
     */
    public function __construct(IpService $ipService, LocationService $locationService)
    {
        $this->ipService = $ipService;
        $this->locationService = $locationService;
    }

    /**
     * @param string $userIp
     * @return boolean
     *
     * Rule Description: If user Ip is in blocked ip list or ip location is in blocked location list, return false
     */
    private function userValidation(string $userIp): bool
    {
        $blockedIpList = $this->ipService->getBlockedIpList();   //***** return an array of blocked IPs

        if (in_array($userIp, $blockedIpList)) {
            return false;
        }

        $ipLocation = $this->ipService->getIpLocation($userIp);
        $blockedLocationList = $this->locationService->getBlockedLocationList();   //***** return an array of blocked locations

        if (in_array($ipLocation, $blockedLocationList)) {
            return false;
        }

        return true;
    }

    /**
     * @param $formData
     * @return float
     *
     * Rule Description: If user age is less than 20 years, discount is equal to 0.2 and
     * if user job is student or teacher, discount is equal to 0.25
     */
    private function getRegistrationFeeDiscount($formData): float
    {
        $discount = RuleConstants::DISCOUNT_DEFAULT_TO_REGISTER;

        $userAge = $formData->age;
        $userJob = $formData->job;

        if ($userAge <= RuleConstants::AGE_LIMITATION_TO_GET_DISCOUNT) {
            $discount = $discount + RuleConstants::DISCOUNT_FOR_AGE_LIMITATION;
        }

        if ($userJob == RuleConstants::STUDENT_JOB || $userJob == RuleConstants::TEACHER_JOB) {
            $discount = $discount + RuleConstants::DISCOUNT_FOR_JOB_TYPE;
        }

        return $discount;
    }
}
