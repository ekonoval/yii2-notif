<?php
//$scenario->skip();

$I = new AcceptanceTester($scenario);
$I->wantTo('signup with User2 (duplicating username)');
$I->amOnPage('/site/signup');

$I->fillField('Username', 'user2');
$I->fillField('Email', 'user3@gmail.com');
$I->fillField('Password', 'user3');
$I->click(['id' => 'signup-btn']);

$I->expect('to see username duplication error');

$I->wait(1);
$I->see('has already been taken');
$I->seeInCurrentUrl('/site/signup');


$I->amGoingTo('to signup with existing email'); //----------------------
$I->amOnPage('/site/signup');

$I->fillField('Username', 'user3');
$I->fillField('Email', 'user2@gmail.com');
$I->fillField('Password', 'user3');
$I->click(['id' => 'signup-btn']);

$I->expect('to see email duplication error');

$I->wait(1);
$I->see('has already been taken');
$I->seeInCurrentUrl('/site/signup');

$I->amGoingTo('to signup with valid data'); //----------------------
$I->amOnPage('/site/signup');

$I->fillField('Username', 'user3');
$I->fillField('Email', 'user3@gmail.com');
$I->fillField('Password', 'user3');
$I->click(['id' => 'signup-btn']);

$I->expect('successful signup');

$I->wait(1);
$I->seeInCurrentUrl('/');
$I->see('Logout (user3)');