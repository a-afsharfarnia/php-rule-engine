<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Constants;


/**
 * Class RuleNameConstants
 * Description: Rule name must be define in this class
 */
class RuleNameConstants
{
    const MANAGER_NAME_SPACE = 'RuleEngine\\Services';

    // First is service name and second is method name
    const RULE_1_IS_USER_VALID_TO_REGISTER = "Register:userValidation";
    const RULE_2_GET_REGISTER_FEE_DISCOUNT = "Register:getRegistrationFeeDiscount";
    const RULE_3_IS_PASSWORD_MUST_BE_CHANGED = "Login:needToChangeThePassword";
    const RULE_4_IS_HINT_MUST_BE_SHOWED = "Login:needToShowTheHint";

    public static $rules = [
        self::RULE_1_IS_USER_VALID_TO_REGISTER,
        self::RULE_2_GET_REGISTER_FEE_DISCOUNT,
        self::RULE_3_IS_PASSWORD_MUST_BE_CHANGED,
        self::RULE_4_IS_HINT_MUST_BE_SHOWED
    ];
}
