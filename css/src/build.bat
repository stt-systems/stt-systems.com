@echo off

echo Generating CSS...

set STYLE=compressed
if not "%1"=="" set STYLE=%1

del ..\*.css 2> nul
for %%F in (*.scss) do call :sass %%F

exit /b 0

:sass
set FILENAME=%1
if not "%FILENAME:~0,1%"=="_" (
  echo sass %1...
  call sass %1 ..\%~n1.min.css --no-source-map --style=%STYLE%
)

exit /b
