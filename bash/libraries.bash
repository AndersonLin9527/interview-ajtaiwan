#!/bin/bash
# shellcheck disable=SC2034
Bash_Path=$(readlink -f "$0")
Bash_Folder=$(dirname "${Bash_Path}")
Bash_Name="$(basename -- "${Bash_Path}")"

function echoNowAction() {
  echo "[ $(date '+%F %T') ] $1"
}
