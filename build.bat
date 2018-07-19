@echo off

set MODE=
if not "%1"=="" set MODE=%1

pushd css\src
call build %MODE%
popd
echo.

pushd js\src
call build %MODE%
popd
echo.
