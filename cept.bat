@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=vendor/codeception/codeception/codecept
php "%BIN_TARGET%" %*
