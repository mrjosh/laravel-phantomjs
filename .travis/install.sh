#!/bin/bash

# Install some custom requirements on Linux
if [ $(phantomjs --version) != '2.1.1' ]; then

    echo "Installing phantomjs ...";

    rm -rf $PWD/travis_phantomjs;
    mkdir -p $PWD/travis_phantomjs;
fi

if [ $(phantomjs --version) != '2.1.1' ]; then

    wget https://assets.membergetmember.co/software/phantomjs-2.1.1-linux-x86_64.tar.bz2 -O $PWD/travis_phantomjs/phantomjs-2.1.1-linux-x86_64.tar.bz2;
fi

if [ $(phantomjs --version) != '2.1.1' ]; then

    tar -xvf $PWD/travis_phantomjs/phantomjs-2.1.1-linux-x86_64.tar.bz2 -C $PWD/travis_phantomjs;
fi

export PATH=$PWD/travis_phantomjs/phantomjs-2.1.1-linux-x86_64/bin:$PATH

phantomjs --version