<?php



if (!function_exists('date_indo')) {
    /**
     * Returns a indonesian date
     *
     * @param date $date
     * date default system to convert
     *
     * @return string a string in human readable format
     *
     * */
    function date_indo($date)
    {
        if (is_null($date)) {
            return null;
        }

        $year  = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day   = substr($date, 8, 2);

        switch ($month) {
            case 1:
                $monthName = 'Januari';
                break;

            case 2:
                $monthName = 'Februari';
                break;

            case 3:
                $monthName = 'Maret';
                break;

            case 4:
                $monthName = 'April';
                break;

            case 5:
                $monthName = 'Mei';
                break;

            case 6:
                $monthName = 'Juni';
                break;

            case 7:
                $monthName = 'Juli';
                break;

            case 8:
                $monthName = 'Agustus';
                break;

            case 9:
                $monthName = 'September';
                break;

            case 10:
                $monthName = 'Oktober';
                break;

            case 11:
                $monthName = 'November';
                break;

            case 12:
                $monthName = 'Desember';
                break;

            default:
                $monthName = null;
                break;
        }
        return $day . ' ' . $monthName . ' ' . $year ?? null;
    }
}

if (!function_exists('month_indo')) {
    /**
     * Returns a indonesian date
     *
     * @param date $date
     * date default system to convert
     *
     * @return string a string in human readable format
     *
     * */
    function month_indo($date)
    {
        if (is_null($date)) {
            return null;
        }

        $month = substr($date, 5, 2);

        switch ($month) {
            case 1:
                $monthName = 'Januari';
                break;

            case 2:
                $monthName = 'Februari';
                break;

            case 3:
                $monthName = 'Maret';
                break;

            case 4:
                $monthName = 'April';
                break;

            case 5:
                $monthName = 'Mei';
                break;

            case 6:
                $monthName = 'Juni';
                break;

            case 7:
                $monthName = 'Juli';
                break;

            case 8:
                $monthName = 'Agustus';
                break;

            case 9:
                $monthName = 'September';
                break;

            case 10:
                $monthName = 'Oktober';
                break;

            case 11:
                $monthName = 'November';
                break;

            case 12:
                $monthName = 'Desember';
                break;

            default:
                $monthName = null;
                break;
        }
        return  $monthName  ?? null;
    }
}

if (!function_exists('get_time_from_timestamp')) {

    function get_time_from_date($time)
    {
        return substr($time, 10, 6);
    }
}

if (!function_exists('rupiah_format')) {

    function rupiah_format($value)
    {
        return number_format($value, 0, ',', '.');
    }
}

if (!function_exists('percen')) {

    function percen($total, $piece, $round = 2)
    {
        if ($total == 0 or $piece == 0) {
            return "0%";
        } else {
            return round((($piece / $total) * 100), 2) . '%';
        }
    }
}

if (!function_exists('get_age')) {

    function get_age($year)
    {
        return now()->format("Y") - $year;
    }
}

if (!function_exists('change_wrap_pagination')) {
    /**
     * Returns a indonesian format currency
     *
     * @param int value
     * @param int decimal
     *
     *
     * @return string a string in indonesian currency format
     *
     * */
    function change_wrap_pagination($data, $new_name)
    {
        $collect = collect($data);

        if($collect->has('data')){
            $collect[$new_name] = $collect['data'];
            $collect->forget('data');
        }

        return $collect->toArray();
    }
}

if (!function_exists('wrap_pagination')) {
    /**
     * Returns a indonesian format currency
     *
     * @param int value
     * @param int decimal
     *
     *
     * @return string a string in indonesian currency format
     *
     * */
    function wrap_pagination($data)
    {
        $collect = collect($data);


        $collect['links'] = [
            'first' => $collect['first_page_url'],
            'prev' => $collect['prev_page_url'],
            'next' => $collect['next_page_url'],
            'last' => $collect['last_page_url'],
        ];

        $collect['meta'] = [
            'current_page' => $collect['current_page'],
            'from' => $collect['from'],
            'last_page' => $collect['last_page'],
            'path' => $collect['path'],
            'per_page' => $collect['per_page'],
            'to' => $collect['to'],
            'total' => $collect['total'],
        ];

        $collect->forget('first_page_url');
        $collect->forget('prev_page_url');
        $collect->forget('next_page_url');
        $collect->forget('last_page_url');
        $collect->forget('last_page');

        $collect->forget('current_page');
        $collect->forget('from');
        $collect->forget('path');
        $collect->forget('per_page');
        $collect->forget('to');
        $collect->forget('total');


        return $collect->toArray();
    }
}

if (!function_exists('remove_links_paginate')) {
    /**
     * Returns a indonesian format currency
     *
     * @param int value
     * @param int decimal
     *
     *
     * @return string a string in indonesian currency format
     *
     * */
    function remove_links_paginate($data)
    {
        $collect = collect($data);
        $meta = collect($collect['meta']);

        $meta->forget('links');
        $collect->forget('meta');
        $collect['meta'] = $meta;

        return $collect->toArray();
    }
}
