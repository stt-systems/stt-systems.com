@echo off

echo Generating CSS...

set STYLE=compressed
if "%1"=="expanded" (
  set STYLE=expanded
  shift /1
)

set FILES=*.scss
if not "%1"=="" (
  if "%STYLE%"=="expanded" for /f "tokens=1,* delims= " %%a in ("%*") do set FILES=%%b
  if not "%STYLE%"=="expanded" set FILES=%*
)

if "%1"=="" del ..\*.css 2> nul

for %%F in (%FILES%) do call :sass %%F

exit /b 0

:sass
set FILENAME=%1
if not "%FILENAME:~0,1%"=="_" (
  echo sass %1...
  call sass %1 ..\%~n1.min.css --no-source-map --style=%STYLE%
)

exit /b
