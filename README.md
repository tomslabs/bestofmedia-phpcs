Requirements:
sudo pear install PEAR_PackageFileManager_Cli-alpha
LINUX: xmllint (xmllint: using libxml version 20708)
MAC: xpath

edit package.xml

- set /package/date
- set /package/time
- increment /package/version/release
- set /package/notes from ./changelog.sh output

generate package.xml content through pfm

0.4.0 version has bug with git, there are missing libraries.

mv .git .git2
./pfm
12. generate content
14. Save and quit

Edit package.xml to properly type new files (test, php, data).
Remove build.sh and changelog.sh that don't need to be released.

mv .git2 .git


validate package:
sudo pear install package.xml
sudo pear uninstall tomslabs/PHP_CodeSniffer_Standards_BestOfMedia

build and validate TGZ package:
./build.sh

