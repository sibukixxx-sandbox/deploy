#!/bin/bash

wget http://deployer.org/deployer.phar

mv deployer.phar /usr/local/bin/dep
chmod +x /usr/local/bin/dep

#composer require deployer/deployer:~3.0
