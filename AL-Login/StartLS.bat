@ECHO off
TITLE Aion Unity Login Server
color E
:START
CLS
IF "%MODE%" == "" (
SET JAVA_OPTS=-Xms32m -Xmx512m -server
)
ECHO Starting Aion Unity Login Server in %MODE% mode.
set Path=..\Tools\Java\jre7\bin;%Path%
set CLASSPATH=..\Tools\Java\jre7\lib\rt.jar
JAVA %JAVA_OPTS% -cp ./libs/*;AL-Login.jar com.aionemu.loginserver.LoginServer
SET CLASSPATH=%OLDCLASSPATH%
IF ERRORLEVEL 2 GOTO START
IF ERRORLEVEL 1 GOTO ERROR
IF ERRORLEVEL 0 GOTO END
:ERROR
ECHO.
ECHO Login Server has terminated abnormaly!
ECHO.
PAUSE
EXIT
:END
ECHO.
ECHO Login Server is terminated!
ECHO.
PAUSE
EXIT