<?php
use Step\Acceptance\GuestSteps;

$I = new GuestSteps($scenario);

$I->wantTo('to check cabinet access is disabled for guest');

$I->amInCabinet();

$I->seeLoginPage();

$I->wantTo("Check that notifications access is disabled for guest");
$I->amInNotificationsCrudIndex();
$I->seeLoginPage();

$I->amInNotificationsCrudEdit();
$I->seeLoginPage();

$I->wantTo("Check that users-crud access is disabled for guest");
$I->amInUsersCrudIndex();
$I->seeLoginPage();

$I->amInUsersCrudEdit();
$I->seeLoginPage();

$I->amInArticlesCrudIndex();
$I->seeLoginPage();