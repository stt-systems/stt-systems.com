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

mkdir tmp
for %%F in (%FILES%) do call :sass %%F

if "%FILES%"=="*.scss" del ..\*.css 2> nul
robocopy tmp .. *.css /w:1 /e /fft
rd /q /s tmp

exit /b 0

:sass
set FILENAME=%1
if not "%FILENAME:~0,1%"=="_" (
  echo sass %1...
  call sass %1 tmp\%~n1.min.css --no-source-map --style=%STYLE%
)

exit /b
