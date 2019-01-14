#!/bin/bash
if [ -z $key ]
then
        read -p "Enter key location string (to generate it, please look at https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/) " key
fi
if [ -z $target ]
then
	read -p "Enter destination user@host:path string: " target
fi
sftp -i $key -b ./commands.ftp $target
echo "deployment done"
