@echo off

echo Generating CSS...

set PRODUCTION=
set STYLE=expanded
if "%1"=="production" (
  echo Production mode...
  set PRODUCTION=yes
  set STYLE=compressed
  shift /1
) else (
  echo Development mode...
)

set FILES=*.scss
if not "%1"=="" (
  if not "%PRODUCTION%"=="" for /f "tokens=1,* delims= " %%a in ("%*") do set FILES=%%b
  if "%PRODUCTION%"=="" set FILES=%*
)

if "%FILES%"=="*.scss" del ..\*.css 2> nul

for %%F in (%FILES%) do call :sass %%F

exit /b 0

:sass
set FILENAME=%1
if not "%FILENAME:~0,1%"=="_" (
  echo sass %1...
  call sass %1 ..\%~n1.min.css --no-source-map --style=%STYLE%
)

exit /b
