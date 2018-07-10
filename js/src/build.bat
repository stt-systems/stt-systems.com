@echo off

echo Generating JS...

set STYLE=--compress
if not "%1"=="" set STYLE=%1

for %%F in (*.js) do (
  echo uglify-js %%F...
  call uglifyjs %%F --output ..\%%~nF.min.js %STYLE%
)

exit /b 0
