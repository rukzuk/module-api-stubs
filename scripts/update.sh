#!/bin/bash

#
# Update Stubs
#
DEFAULT_BRANCH="master"
BRANCH=${1:-$DEFALUT_BRANCH}

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
directory="${DIR}/tmp/rukzuk_repo"
target="${DIR}/.."
createStubs="${directory}/cms/docs/createStubs.sh"

function clean_target() {
    rm -rf "${target}/js/"
    rm -rf "${target}/php/"
    mkdir -p "${target}/js/"
    mkdir -p "${target}/php/"
}

function make_repo_dir() {
    echo "------------ start generating php api stubs"
    if [ ! -d "$directory" ]; then
      mkdir -p "$directory"
      chmod 777 "$directory"
    fi
}

function clone_rukzuk_repo() {
    git clone --depth 1 --branch ${BRANCH} ssh://git@stash.rukzuk.intern:7999/rz/rukzuk.git "$directory"
    git --git-dir="${directory}/.git" describe --always > "${target}/git.version"
}

function create_php_stubs() {
    # install composer packages
    (cd ${directory}/cms && ./composer.phar update)

    # create stubs
    if [ -f "$createStubs" ]; then
        echo "------------ run createStubs ${directory} ${target}/php"
        "$createStubs" "${target}/php"
    else
        echo "------------ $createStubs not found"
        exit 1
    fi
    echo "------------ done"
}

function copy_js_stubs() {
    cp ${directory}/js/CMS/api/API.js "${target}/js/"
}

# call
clean_target
make_repo_dir
clone_rukzuk_repo
copy_js_stubs
create_php_stubs

echo "------------ removing tmp repo folder"
rm -rf ${directory}
echo "------------ OK"
