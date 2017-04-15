#!/bin/bash

# set WESTA_ACTIV_SRC variable (to get appropiate prod/dev sources)
source /etc/environment

#echo "set src path to $WESTA_ACTIV_SRC"
sudo $WESTA_ACTIV_SRC'generateStatisticTable.sh'
