#!/bin/bash
ProjectDir=$(dirname "$(dirname "$(dirname "$(readlink -f "$0")")")")
# shellcheck disable=SC1090
source "${ProjectDir}/bash/libraries.bash"

# Safe Switch
if [ "$1" == "" ]; then
  echoNowAction "Production Git Update Project ? [y/N]"
  read -r -e -p '' safe_switch
else
  safe_switch=$1
fi

if [ "${safe_switch}" != "y" ]; then
  echoNowAction "Good Bye , Have a nice day !!!"
  exit
fi

echoNowAction "Start git.bash"
start_at=$(date +%s)

cd "${ProjectDir}" || exit

echoNowAction "Git"
sudo git fetch --all
sudo git pull

echoNowAction "composer install"
sudo composer install

echoNowAction "Change Dir ${ProjectDir}/storage/ Owner to nginx"
sudo chown -R nginx.nginx "${ProjectDir}/storage/"

close_at=$(date +%s)
run_time=$((close_at - start_at))
echoNowAction "Close git.bash"
echoNowAction "Took ${run_time} seconds finished git.bash"
