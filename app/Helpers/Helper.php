<?php


function errorClass(object $errors, string $name): ?String
{
    return in_array($name, array_keys($errors->messages()))
        ? 'is-invalid'
        : '';
}

function oldChecked(int|string $old)
{
    return old($old) !== null ? 'checked' : '';
}

function oldEqualsSelected(int|string $old, int|string $equalsOld): ?String
{
    return old($old) == $equalsOld ? 'selected' : '';
}

function oldOrValueSelected(null|int|string $old, int|string $value, int|string $beEqual): ?String
{
    if (old($old)) {
        return old($old) == $beEqual ? 'selected' : '';
    } else {
        return $beEqual == $value ? 'selected' : '';
    }
}

function oldOrValue(null|int|string $old, int|string $value): String
{
    return old($old) ?? $value;
}
