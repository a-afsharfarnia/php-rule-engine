<?php
/**
 * Project_Name: Rule Engine in PHP
 * Created_By: Abbas Afsharfarnia (28/06/2019 19:50)
 * Project_Address: https://github.com/afsharfarnia/ruleEngine
 */

namespace RuleEngine\Constants;


/**
 * Class RuleConstants
 * Description: All constants must be defined in this class
 */
class RuleConstants
{
    // Errors
    const RULE_INVALID= 'The rule is invalid.';

    // Login rule constants
    const LAST_LOGIN_LIMITATION_DAYS_FOR_CHANGE_PASSWORD = 90;
    const LAST_LOGIN_LIMITATION_DAYS_FOR_SHOW_HINT = 365;

    // Register rule constants
    const DISCOUNT_DEFAULT_TO_REGISTER = 0.1;
    const AGE_LIMITATION_TO_GET_DISCOUNT = 20;
    const DISCOUNT_FOR_AGE_LIMITATION = 0.2;
    const DISCOUNT_FOR_JOB_TYPE = 0.25;
    const STUDENT_JOB = 'student';
    const TEACHER_JOB = 'teacher';
}
