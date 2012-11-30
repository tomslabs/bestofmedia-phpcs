#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR

if [[ $(uname) == 'Darwin' ]]
then
  VERSION=$( xpath package.xml "string(/*[name()='package']/*[name()='version']/*[name()='release'])" 2> /dev/null )
else
  VERSION=$( xmllint --xpath "string(/*[name()='package']/*[name()='version']/*[name()='release'])" package.xml )
fi

mkdir -p PHP_CodeSniffer_Standards_BestOfMedia-$VERSION
cp -R CodeSniffer LICENSE README PHP_CodeSniffer_Standards_BestOfMedia-$VERSION

#pear package-validate PHP_CodeSniffer_Standards_BestOfMedia-$VERSION/package.xml

tar -zcvf PHP_CodeSniffer_Standards_BestOfMedia-$VERSION.tgz package.xml PHP_CodeSniffer_Standards_BestOfMedia-$VERSION
rm -Rf PHP_CodeSniffer_Standards_BestOfMedia-$VERSION
pear package-validate PHP_CodeSniffer_Standards_BestOfMedia-$VERSION.tgz
