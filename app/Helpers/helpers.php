<?php

function userCan($permission)
{
    return auth()->user()->can($permission);
}
