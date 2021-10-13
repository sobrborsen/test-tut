#! /bin/bash

# This is a small helper script used called from the makefile

#set -e
#set -x
#set -v

php -S localhost:8000 -t tests/ui > /dev/null 2>&1 &
PID=$!

export QUNIT_TIMEOUT=10000
npx qunit-reporter http://localhost:8000/ cov
STATUS=$?
kill $PID
npx nyc report
exit $STATUS
