#!/bin/bash
if [ -z $key ]
then
        read -p "Enter key location string: " key
fi
if [ -z $target ]
then
	read -p "Enter destination user@host:path string: " target
fi
sftp -i $key -b ./commands.ftp $target
echo "deployment done"
