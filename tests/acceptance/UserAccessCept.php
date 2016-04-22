<?php
use Step\Acceptance\UserSteps;

$I = new UserSteps($scenario);

$I->wantTo('to check cabinet access is enabled for USER');

$I->amInCabinet();

$I->seeCabinetPage();

//$I->wantTo("Check that notifications access is disabled for guest");
//$I->amInNotificationsCrudIndex();
//$I->seeLoginPage();
//
//$I->amInNotificationsCrudEdit();
//$I->seeLoginPage();
//
//$I->wantTo("Check that users-crud access is disabled for guest");
//$I->amInUsersCrudIndex();
//$I->seeLoginPage();
//
//$I->amInUsersCrudEdit();
//$I->seeLoginPage();