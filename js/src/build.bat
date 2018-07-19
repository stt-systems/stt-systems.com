@echo off

echo Generating JS...

set STYLE=--compress
if "%1"=="beautify" (
  set STYLE=--beautify
  shift /1
)

set FILES=*.js
if not "%1"=="" (
  if "%STYLE%"=="--beautify" for /f "tokens=1,* delims= " %%a in ("%*") do set FILES=%%b
  if not "%STYLE%"=="--beautify" set FILES=%*
)

if "%1"=="" del ..\*.js 2> nul

for %%F in (%FILES%) do (
  echo uglify-js %%F...
  call uglifyjs %%F --output ..\%%~nF.min.js %STYLE%
)

exit /b 0
