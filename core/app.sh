#!/bin/bash

#stop services and proccess for MAMP
echo -e "${title_bar}====================================${NC}"
echo -e "${title_bar}Stopping apache and mysql services  ${NC}"
echo -e "${title_bar}====================================${NC}"
echo ""
echo ""

#sudo apachectl stop
open ./closeMAMP.app
echo  -e "\033[5mWARNING: Closing Services ...\033[0m"
sleep 7
#Start services and proccess for MAMP

echo ""
echo ""

echo -e "${title_bar}====================================${NC}"
echo -e "${title_bar}Starting apache and mysql services .${NC}"
echo -e "${title_bar}====================================${NC}"
#Start mysql and apache
open ./openMAMP.app
echo  -e "\033[5mWARNING: Re-starting Services ...\033[0m"
sleep 7

