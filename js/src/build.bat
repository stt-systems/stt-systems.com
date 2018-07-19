@echo off

echo Generating JS...

set PRODUCTION=
set STYLE=--beautify
if "%1"=="production" (
  echo Production mode...
  set PRODUCTION=yes
  set STYLE=--compress
  shift /1
) else (
  echo Development mode...
)

set FILES=*.js
if not "%1"=="" (
  if not "%PRODUCTION%"=="" for /f "tokens=1,* delims= " %%a in ("%*") do set FILES=%%b
  if "%PRODUCTION%"=="" set FILES=%*
)

if "%FILES%"=="*.js" del ..\*.js 2> nul

for %%F in (%FILES%) do (
  echo uglify-js %%F...
  call uglifyjs %%F --output ..\%%~nF.min.js %STYLE%
)

exit /b 0
