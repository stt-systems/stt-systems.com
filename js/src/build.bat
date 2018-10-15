@echo off

echo Generating JS...

set PRODUCTION=
set STYLE=--beautify
if "%1"=="production" (
  echo Production mode...
  set PRODUCTION=yes
  set STYLE=--compress -m
  shift /1
) else (
  echo Development mode...
)

set FILES=*.js
if not "%1"=="" (
  if not "%PRODUCTION%"=="" for /f "tokens=1,* delims= " %%a in ("%*") do set FILES=%%b
  if "%PRODUCTION%"=="" set FILES=%*
)

mkdir tmp
for %%F in (%FILES%) do (
  echo uglify-js %%F...
  call uglifyjs %%F --output tmp\%%~nF.min.js %STYLE%
)
if "%FILES%"=="*.js" del ..\*.js 2> nul
robocopy tmp .. *.js /w:1 /e /fft
rd /q /s tmp

exit /b 0
