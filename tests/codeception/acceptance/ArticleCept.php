<?php
use Step\Acceptance\AdminSteps;

function fillForm($I, $fieldsData)
{
    foreach ($fieldsData as $key => $value)
        $I->fillField($key, $value);
}

$I = new AdminSteps($scenario);

$I->amOnPage('/backend/article-crud');
$I->click('Create Article');
$I->seeInCurrentUrl('/backend/article-crud/create');

$faker = \Faker\Factory::create();
$first_article = [
     'ArticleCrudSave[title]' => $faker->sentence($words = 3),
     'ArticleCrudSave[short_text]' => $faker->sentences(1),
     'ArticleCrudSave[full_text]' => $faker->sentences(4),
 ];

fillForm($I, $first_article);

$I->click("//button[@type='submit' and text()='Create']");

$I->wait(5);



