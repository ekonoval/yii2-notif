<?php
use Step\Acceptance\AdminSteps;

$I = new AdminSteps($scenario);

$I->wantTo('to check cabinet access is enabled for ADMIN');

$I->amInCabinet();

$I->seeCabinetPage();

$I->wantTo("Check that notifications access is disabled for ADMIN");
$I->amInNotificationsCrudIndex();
$I->dontSeeForbidden();

$I->amInNotificationsCrudEdit();
$I->dontSeeForbidden();

$I->wantTo("Check that users-crud access is disabled for ADMIN");
$I->amInUsersCrudIndex();
$I->dontSeeForbidden();

$I->amInUsersCrudEdit();
$I->dontSeeForbidden();

$I->amInArticlesCrudIndex();
$I->dontSeeForbidden();