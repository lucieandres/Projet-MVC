#!/bin/sh

remote='linserv-info-01.iutnice.unice.fr'
remote_dir='www/'

rsync $1 -auvz ./ $remote:$remote_dir


