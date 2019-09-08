# A Simple Method to Make a Rule Engine in PHP
In most projects, we have some business rules which affect on our processes and outputs. It is a best practice to design a rule engine in our project to control all the rules.


## The reasons for having a rule engine
- The rules may be changed many times. So If we have a rule engine, we just need to change one place, not much code in the project.
- We can create many unit test on our rules easily.
- Our codes will be more readable.
- Rule engine will be a new layer which is separated from other layers. 
 
 
## Our best practice 
Imagine we want to make a register and login processes for our project. 

In `register` process, we have two following rules:
  - **Rule1**: If user Ip is in our blocked ip list or ip location is in our blocked location list, user is invalid to register and the register form must not be showed for these kind of users.
  - **Rule2**: Imagine to register, we get register fee from user. There are some discounts here. If user's age is less than 20 years, discount is equal to 0.2 and if user job is student or teacher, discount is equal to 0.25

In `login` process, we have two following rules:
  - **Rule3**: After login, if user's last login is more than 3 months ago, user must change the password.
  - **Rule4**: Imagine after first login, we show some guides to user. The rule is: if user's last login is more than 1 year ago, hint (user guide) need to be showed again.
 
  
### How to use 
After making your rule engine based on the continued document description, you can use it in your project like that:
 ```php
  $result = $ruleEngineFactory->getResult($ruleName, $data);
 ```
 As you can see, we call `getResult` method from an instance of `RuleEngineFactory` class (it is defined in Factories folder). These method get a rule name and a data as its parameters that describe which rule must be called and what data is needed to process in the given rule. 
 
 
### Infrastructure  
In our method, we have four main folders:
- Constants
- Factories
- Services
- Traits


### Constants folder
In constants folder, we have 2 PHP class files which contain our rule engine constants:
- **RuleConstants**: Contains all the rules constant, such as messages, values and etc. which we will use them in our rule manager services.

- **RuleNameConstants**: Contains all the rules name which we will later use them to call our rules. A name should has the rule number and must be defined like that: 
    > Service_Name_Without_RuleManager_Phrase:Method_Name.
    
    For example:
    ```php
    const RULE_2_GET_REGISTER_FEE_DISCOUNT = "Register:getRegistrationFeeDiscount";
    ```
    Here rule number 2 has been defined. `Register` (first character is in capital) is the service name without `RuleManager` phrase (our services are in the Services folder) and `getRegistrationFeeDiscount` is the name of related method.
 
    
### Factories folder
In factories folder, we have 2 PHP class files which make our rule engine factories:
- **RuleEngineServicesFactory**: This is a service factory which contains a method named `getRuleEngineServices`. This method get a service name and return related service (our services are in the Services folder). You can define this service factory as you wish. In fact, it is depend on your service container and what is your method to make services. In this project, we gave you a sample in Symfony framework (also you can use [Symfony Service container Factory][1]).

- **RuleEngineFactory**: This is the main factory, which contains a method named `getResult` that must be called to get a given rule result. This method get a rule name (it must be defined in RuleNameConstants as explained in the previous section) and a data as its parameters that describe which rule must be called and what data is needed to process in the given rule. In this method, rule name is exploded to service name and method name. Service name is passed to `RuleEngineServicesFactory` to get related service and finally the related method from the service is called to get the result of the given rule and return to our project.
    

### Services folder
In this folder there are an Abstract class file and our rule manger services:
- **RuleManagerAbstract**: This is called in RuleEngineFactory to get the services result. This must be extended in all services.

- **Our Services Class Files**: we must create our services in this folder. Each service contains one or more related methods (rules). In service name, after the main service name, we must add `RuleManager` phrase. In `RuleNameConstants` we must defined our rules name base on the service name and methods.
 
 
### Traits folder
In this folder there is one trait named `RuleEngineResponseTrait` which defines a format to return the rule engine result. It is used in `RuleEngineFactory`.

[1]: https://symfony.com/doc/3.4/service_container/factories.html
