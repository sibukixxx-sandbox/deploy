#!/bin/bash

if test; then

else

fi


if [ `which wget` ]; then
    wget http://deployer.org/deployer.phar
else
    curl -O http://deployer.org/deployer.phar
fi

mv deployer.phar /usr/local/bin/dep

chmod +x /usr/local/bin/dep

#composer require deployer/deployer:~3.0