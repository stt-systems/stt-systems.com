@echo off

set MODE=production
if not "%1"=="" set MODE=%1

pushd css\src
call build %MODE%
popd
echo.

pushd js\src
call build %MODE%
popd
echo.
