<?php
$scenario->skip();

$I = new AcceptanceTester($scenario);
$I->wantTo('sign in with User2 account');
$I->amOnPage('/site/login');

$I->fillField('Username', 'user2');
$I->fillField('Password', 'user2');
$I->click(['name' => 'login-button']);

$I->expect('user2 has been signed in');

$I->seeInCurrentUrl('/site/cabinet');
$I->see('Logout (user2)');

$I->amGoingTo('logout user2 and check access to cabinet again');

$I->click(['id' => 'logout-btn']);
$I->dontSee('Logout (user2)');
$I->amOnPage('/site/cabinet');
$I->seeInCurrentUrl('/site/login');