#!/bin/bash

# TFN 190417 passing fileName and MailMode parameter to python script to generate html file according to usage

# set WESTA_ACTIV_SRC variable (to get appropiate prod/dev sources)
source /etc/environment

#echo "set src path to $WESTA_ACTIV_SRC"
sudo $WESTA_ACTIV_SRC'generateStatisticTable.sh' $1 $2
