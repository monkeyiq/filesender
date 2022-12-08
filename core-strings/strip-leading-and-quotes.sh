#!/bin/bash

F=$1
mv $F /tmp/$F.tmp
cat /tmp/$F.tmp | sed 's/^[ ]*"/"/g' | sed 's/^"//g' | sed 's/"[,]*$//g' > $F

