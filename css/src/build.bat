@echo off

echo Generating CSS...

set STYLE=compressed
if not "%1"=="" set style=%1

for %%F in (*.scss) do (
  echo sass %%F...
  call sass %%F ..\%%~nF.min.css --no-source-map --style=%STYLE%
)

exit /b 0
