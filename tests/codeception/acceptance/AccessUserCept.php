<?php
use Step\Acceptance\UserSteps;

$I = new UserSteps($scenario);

$I->wantTo('to check cabinet access is enabled for USER');

$I->amInCabinet();

$I->seeCabinetPage();

$I->wantTo("Check that notifications access is disabled for USER");
$I->amInNotificationsCrudIndex();
$I->seeForbidden();

$I->amInNotificationsCrudEdit();
$I->seeForbidden();

$I->wantTo("Check that users-crud access is disabled for USER");
$I->amInUsersCrudIndex();
$I->seeForbidden();

$I->amInUsersCrudEdit();
$I->seeForbidden();

$I->amInArticlesCrudIndex();
$I->seeForbidden();