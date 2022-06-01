<?php

function userCan($permission) :bool
{
    return auth()->user()->can($permission);
}

function updateImage(?object $file, string $path): string
{
    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('/uploads/' . $path . '/'), $fileName);

    return "uploads/$path/" . $fileName;
}

function deleteImage(?string $image)
{
    $imageExists = file_exists($image);

    if ($imageExists) {
        if ($image != 'backend/image/default.png') {
            @unlink($image);
        }
    }
}

function flashSuccess(string $msg)
{
    session()->flash('success', $msg);
}

function flashWarning(string $msg)
{
    session()->flash('warning', $msg);
}

function flashError(string $msg)
{
    session()->flash('error', $msg);
}

