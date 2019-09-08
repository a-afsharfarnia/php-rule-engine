<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Services;


use RuleEngine\Constants\RuleConstants;
use src\UserBundle\Entity\User;
use src\UserBundle\Services\UserService;

/**
 * Class LoginRuleManager
 * Description: This is a rule engine service to handle all the rules in login process
 */
class LoginRuleManager extends RuleManagerAbstract
{
    /** @var UserService */
    private $userService;


    /**
     * LoginRuleManager constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param User $user
     * @return boolean
     *
     * Rule Description: If user last login is more than 3 months ago, password need to be changed
     */
    private function needToChangeThePassword(User $user): bool
    {
        $userId = $user->getId();
        $userLastLogin = $this->userService->getUserLastLogin($userId);

        $lastLoginLimit = RuleConstants::LAST_LOGIN_LIMITATION_DAYS_FOR_CHANGE_PASSWORD;  //***** 3 months
        $now = new \DateTime();

        if ($userLastLogin->diff($now)->days > $lastLoginLimit) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @return boolean
     *
     * Rule Description: If user last login is more than 1 year ago, hint (user guide) need to be showed again
     */
    private function needToShowTheHint(User $user): bool
    {
        $userId = $user->getId();
        $userLastLogin = $this->userService->getUserLastLogin($userId);

        $lastLoginLimit = RuleConstants::LAST_LOGIN_LIMITATION_DAYS_FOR_SHOW_HINT;  //***** 1 year
        $now = new \DateTime();

        if ($userLastLogin->diff($now)->days > $lastLoginLimit) {
            return true;
        }

        return false;
    }
}
