<?php
namespace Step\Acceptance;

class GuestSteps extends \AcceptanceTester
{
    public $username;
    public $password;

    public function __construct($scenario)
    {
        parent::__construct($scenario);

        if ($this->username and $this->password)
            $this->login($this->username, $this->password);
    }

    function login($username, $password) // 1
    {
        $I = $this;
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', $username);
        $I->fillField('LoginForm[password]', $password);
        $I->click('Login');
        $I->wait(1); // 2
        $I->seeCurrentUrlEquals('/'); // 3
    }

    function logout()
    {
        $I = $this;
        $I->amOnPage('/');
        // Expecting that this button is presented on the homepage.
        $I->click('logout');
    }

    public function imagineCustomer()
    {
        $faker = \Faker\Factory::create();
        return [
            'CustomerRecord[name]' => $faker->name,
            'CustomerRecord[birth_date]' => $faker->date('Y-m-d'),
            'CustomerRecord[notes]' => $faker->sentence(8),
            'PhoneRecord[number]' => $faker->phoneNumber
        ];
    }

    function fillCustomerDataForm($fieldsData)
    {
        $I = $this;
        foreach ($fieldsData as $key => $value) {
            $I->fillField($key, $value);
        }
    }

    public function seeLoginPage()
    {
        $this->seeInCurrentUrl('/site/login');
    }

    public function amInCabinet()
    {
        $this->amOnPage('/site/cabinet');
    }

    public function seeCabinetPage()
    {
        $this->seeInCurrentUrl('/site/cabinet');
    }

    public function amInNotificationsCrudIndex()
    {
        $this->amOnPage('/backend/notification-crud');
    }

    public function amInNotificationsCrudEdit()
    {
        $this->amOnPage('/backend/notification-crud/update?id=1');
    }

    public function amInUsersCrudIndex()
    {
        $this->amOnPage('/backend/user-crud');
    }

    public function amInUsersCrudEdit()
    {
        $this->amOnPage('/backend/user-crud/update?id=1');
    }

    public function amInArticlesCrudIndex()
    {
        $this->amOnPage('/backend/article-crud');
    }
}