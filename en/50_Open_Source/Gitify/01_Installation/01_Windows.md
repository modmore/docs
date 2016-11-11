On Windows, some of the installation steps are bit more work, especially adding Gitify to your `PATH` variable.

This question on Stack Overflow explains the procedure of editing the PATH variable on Windows 7: http://stackoverflow.com/questions/7307548/how-to-access-php-with-the-command-line-on-windows/7307581#7307581

It's common on Windows that you need to add PHP, MySQL and the Gitify executables to the PATH. 

Common locations of the PHP executable on windows include:

````
c:\php\php.exe
c:\php5\php.exe
c:\windows\php.exe
c:\program files\php\php.exe
c:\wamp\bin\php\php5\php.exe
c:\xampp\php\php.exe
<ampps root>\php\php.exe
````

### Additional Dependencies

Here are the Windows dependencies in order to get the script to execute properly. They must be installed and their bin folders have to be added to the Windows PATH environment variable in the Advanced System Settings screen:

* UnZip for Windows compatible unzip capabilities (http://gnuwin32.sourceforge.net/packages/unzip.htm)
    * .zip download - http://iweb.dl.sourceforge.net/project/gnuwin32/unzip/5.51-1/unzip-5.51-1-bin.zip
* Win-Bash compatible linux bsh commands (http://sourceforge.net/projects/win-bash/?source=directory)
    * .zip download - http://superb-dca2.dl.sourceforge.net/project/win-bash/shell-complete/latest/shell.w32-ix86.zip
* compatible curl support (http://www.confusedbycode.com/curl/#downloads)
* curl needs the msvc redistributable in order to function (install this before curl) - https://download.microsoft.com/download/9/3/F/93FCF1E7-E6A4-478B-96E7-D4B285925B00/vc_redist.x64.exe
* windows composer support (https://getcomposer.org)
    * Binary download - https://getcomposer.org/Composer-Setup.exe

Once those are completed, the rest of the instructions do work.