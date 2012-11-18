#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR

pear package-validate package.xml
VERSION=$( xmllint --xpath "string(/*[name()='package']/*[name()='version']/*[name()='release'])" package.xml )

mkdir -p PHP_CodeSniffer_Standards_BestOfMedia-$VERSION
cp -R CodeSniffer LICENSE README PHP_CodeSniffer_Standards_BestOfMedia-$VERSION
tar -zcvf PHP_CodeSniffer_Standards_BestOfMedia-$VERSION.tgz package.xml PHP_CodeSniffer_Standards_BestOfMedia-$VERSION
rm -Rf PHP_CodeSniffer_Standards_BestOfMedia-$VERSION