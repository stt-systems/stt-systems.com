@echo off

echo Generating CSS...

call c:\compiler\3rdParty\sass\sass.bat blueimp-gallery.scss blueimp-gallery.min.css --no-source-map --style=compressed
call c:\compiler\3rdParty\sass\sass.bat carousel.scss        carousel.min.css        --no-source-map --style=compressed
call c:\compiler\3rdParty\sass\sass.bat flat-blue.scss       flat-blue.min.css       --no-source-map --style=compressed
call c:\compiler\3rdParty\sass\sass.bat font-awesome.scss    font-awesome.min.css    --no-source-map --style=compressed
call c:\compiler\3rdParty\sass\sass.bat responsive.scss      responsive.min.css      --no-source-map --style=compressed
call c:\compiler\3rdParty\sass\sass.bat theme-menu.scss      theme-menu.min.css      --no-source-map --style=compressed

if not "%1"=="nopause" pause

exit /b 0
