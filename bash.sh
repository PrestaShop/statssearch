#!/bin/bash

./vendor/bin/header-stamp --exclude=vendor,node_modules --display-report
UNIT=$?

if [[ "$UNIT" == "0" ]]; then
  echo -e "\e[92mUNIT TESTS OK\e[0m"
else
  echo -e "\e[91mUNIT TESTS FAILED\e[0m"
fi
exit $UNIT;
