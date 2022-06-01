<?php

function userCan($permission) :bool
{
    return auth()->user()->can($permission);
}