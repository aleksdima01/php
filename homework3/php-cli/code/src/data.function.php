<?php

function validateDate(string $date): bool
{
    $dateBlocks = explode("-", $date);
    $today = date("Ymd");

    $arrayDate = date_parse_from_format("d-m-Y", $date);
    $formatDate = $arrayDate['year'] . $arrayDate['month'] . $arrayDate['day'];

    if (!(count($dateBlocks) === 3)) {
        return false;
    }

    if ($today < $formatDate) {
        return false;
    }

    if (isset($dateBlocks[0]) && $dateBlocks[0] > 31 || $dateBlocks[0] < 1) {
        return false;
    }

    if (isset($dateBlocks[1]) && $dateBlocks[1] > 12 || $dateBlocks[1] < 1) {
        return false;
    }

    if (isset($dateBlocks[2]) && $dateBlocks[2] > date('Y') || $dateBlocks[2] < date('Y') - 110) {
        return false;
    }

    return true;
}
