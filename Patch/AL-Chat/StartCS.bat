@ECHO off
TITLE Aion Unity Chat Server
color f0
:START
CLS
IF "%MODE%" == "" (
SET JAVA_OPTS=-Xms32m -Xmx512m -server
)
ECHO Starting Aion Lightning Chat Server in %MODE% mode.
set Path=..\Tools\Java\jre7\bin;%Path%
set CLASSPATH=..\Tools\Java\jre7\lib\rt.jar
JAVA %JAVA_OPTS% -cp ./libs/*;AL-Chat.jar com.aionemu.chatserver.ChatServer
SET CLASSPATH=%OLDCLASSPATH%
IF ERRORLEVEL 2 GOTO START
IF ERRORLEVEL 1 GOTO ERROR
IF ERRORLEVEL 0 GOTO END
:ERROR
ECHO.
ECHO Chat Server has terminated abnormaly!
ECHO.
PAUSE
EXIT
:END
ECHO.
ECHO Chat Server is terminated!
ECHO.
PAUSE
EXIT