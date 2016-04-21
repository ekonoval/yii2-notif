<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('sign in with User2 account');
$I->amOnPage('/site/login');

$I->fillField('Username', 'user2');
$I->fillField('Password', 'user2');

$I->click(['name' => 'login-button']);

$I->seeInCurrentUrl('/site/cabinet');
$I->see('Logout (user2)');


$I->click(['id' => 'logout-btn']);
$I->dontSee('Logout (user2)');
$I->amOnPage('/site/cabinet');
$I->seeInCurrentUrl('/site/login');