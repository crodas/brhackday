#!/bin/sh
#rsync --copy-links -rav --del $(pwd)/ root@bustablog.net:/data/www/api.languess.org/ --exclude="cache" --exclude="tmp" --exclude="sphinx/data/" --exclude="sphinx/log/"
rsync --copy-links -ravv --del $(pwd)/ root@geekcasts.tv:/data/www/brhackday.crodas.org/ --exclude="cache" --exclude="tmp" --exclude="sphinx/data/" --exclude="sphinx/log/"
