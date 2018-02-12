#!/usr/bin/env bash

case "$OSTYPE" in
  darwin*)  OSNAME="osx" ;;
  linux*)   OSNAME="linux" ;;
  bsd*)     OSNAME="bsd" ;;
  msys*)    OSNAME="windows" ;;
  *)        OSNAME="unknown: $OSTYPE" ;;
esac

if [ ! -x "$(which phantomjs)" ]; then
    if [ $OSNAME == "osx" ]; then

        brew install phantomjs
    elif [[ $platform == 'linux' ]]; then

        sudo apt-get update
        sudo apt-get install build-essential chrpath libssl-dev libxft-dev -y
        sudo apt-get install libfreetype6 libfreetype6-dev -y
        sudo apt-get install libfontconfig1 libfontconfig1-dev -y
        export PHANTOM_JS="phantomjs-2.1.1-linux-x86_64"
        curl https://github.com/Medium/phantomjs/releases/download/v2.1.1/$PHANTOM_JS.tar.bz2
        sudo tar xvjf $PHANTOM_JS.tar.bz2
        sudo mv $PHANTOM_JS /usr/local/share
        sudo ln -sf /usr/local/share/$PHANTOM_JS/bin/phantomjs /usr/local/bin
    elif [[ $platform == 'bsd' ]]; then

        sudo pkg install phantomjs
    fi
fi

export PHANTOMJS_BINARY_PATH=$(which phantomjs)

vendor/bin/phpunit