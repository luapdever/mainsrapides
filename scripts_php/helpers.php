<?php

use Carbon\Carbon;

function tinyText($text) {
    $points = strlen($text) > 19 ? '...' : '';
    $text = substr($text, 0, 20) . $points;
    return $text;
}

function smallDescription($text) {
    $points = strlen($text) > 99 ? '...' : '';
    $text = substr($text, 0, 100) . $points;
    return $text;
}

function featuring($feat) {
    return $feat ? 'ft ' . $feat : '';
}

function format_date($date) {
    $target = Carbon::createFromFormat('Y-m-d H:i:s',  $date);

    $format = '';
    $current = date("Y-m-d H:i:s");
    $months = $target->diffInMonths($current);
    $days = $target->diffInDays($current);
    $hours = $target->diffInHours($current);
    $minutes = $target->diffInMinutes($current);
    $seconds = $target->diffInSeconds($current);

    if($months>0 && $months < 6) {
        $format = $months . 'mon';
    } elseif($days>0 && $days < 30) {
        $format = $days . 'd';
    } elseif($hours>0 && $hours < 24) {
        $format = $hours . 'h';
    } elseif($minutes>0 && $minutes < 60) {
        $format = $minutes . 'm';
    } elseif($seconds>0 && $seconds < 60) {
        $format = 'un instant';
    } else {
        $format = $target->englishMonth . ' ' . $target->year;
    }

    return $format ? 'Il y a ' . $format : $target;
}

function format_count($count) {
    if(is_integer($count)) {
        $count_formatted = '';
        if($count >= 0 && $count < 1000) {
            $count_formatted = $count;
        } elseif($count >= 1000 && $count < 1000000 ) {
            $count_formatted = round($count/1000, 2) . ' K';
        } elseif($count >= 1000000 && $count < 1000000000 ) {
            $count_formatted = round($count/1000000, 2) . ' M';
        } elseif($count >= 1000000000) {
            $count_formatted = round($count/1000000000, 2) . ' Md';
        }

        return $count_formatted;
    }
}

function unique_code_songster() {
    return str_shuffle(md5(uniqid(rand(), true)) . getdate()[0]);
}


?>