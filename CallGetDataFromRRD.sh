#!/bin/bash

# set WESTA_ACTIV_SRC variable (to get appropiate prod/dev sources)
source /etc/environment

sudo $WESTA_ACTIV_SRC'getDataFromRRD.sh'
