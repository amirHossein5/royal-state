<?php

use Illuminate\Support\Collection;

/**
 * if has errors returns is-invalid class.
 *
 */
function errorClass(object $errors, string $name): ?String
{
    return in_array($name, array_keys($errors->messages()))
        ? 'is-invalid'
        : '';
}

/**
 * if old exists returns checked.
 *
 */
function oldChecked(int|string $old): string
{
    return old($old) !== null ? 'checked' : ' ';
}

function oldOrValueChecked(
    null|int|string $old,
    null|int|string $value,
): string {
    return old($old) ?? $value ? 'checked' : '';
}

/**
 * if old equals with expected returns selected.
 *
 */
function oldEqualsSelected(int|string $old, int|string $expected): ?String
{
    return old($old) == $expected ? 'selected' : '';
}

/**
 * select old or value if one of them exists and
 *
 *  returns selected if that be equlas with expected.
 *
 */
function oldOrValueSelected(
    null|int|string $old,
    null|int|string $value,
    int|string $expected,
): ?String {
    if (old($old)) {
        return old($old) == $expected ? 'selected' : '';
    } else {
        return $expected == $value ? 'selected' : '';
    }
}

/**
 * returns old if exists or value if exists.
 *
 */
function oldOrValue(
    null|int|string $old,
    null|int|string $value
): ?String {
    return old($old) ?? $value;
}

/**
 * returns whether has more pages for paginate.
 *
 */
function hasMorePages(int $current_page, int $last_page): Bool
{
    return $last_page > $current_page ? true : false;
}

/**
 * makes slug from string.
 *
 */
function make_slug(string $text): String
{
    return implode('-', explode(' ', $text));
}

function hasPermission(Collection $permissions, string $expectedPermission): string
{
    $permission = $permissions[$expectedPermission] ?? '';
    $old = old('permissions');

    if ($old) {
        if (old("permissions.{$expectedPermission}")) {
            return 'checked';
        }

        if (!old("permissions.{$expectedPermission}") && $permission) {
            return '';
        }

        return '';
    }

    if ($permission) {
        return 'checked';
    }

    return '';
}

function numberformat(float $number, int $decimal = 3): string
{
    $number_format = number_format($number, $decimal);

    return  substr($number_format, 0, strpos($number_format, '.'));
}
