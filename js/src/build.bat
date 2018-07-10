@echo off

echo Generating JS...

set STYLE=--compress
if not "%1"=="" set STYLE=%1

for %%F in (*.js) do (
  echo uglify-js %%F...
  call uglifyjs %%F --no-source-map %STYLE% > ..\%%~nF.min.js
)

exit /b 0
