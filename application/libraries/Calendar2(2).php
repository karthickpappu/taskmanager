<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calendar
 *
 * @author Natesh
 */
class Calendar2 {
	
    //put your code here
    public function __construct() {
        $this->CI =& get_instance();
    }
    
    public function gen_calendar($month, $year)
    {
        $calendar_days = null;
        $first_day = date_create("$year-$month-01");
        $first_day_name = $first_day->format('D');
        $col = 0;
        $row = 0;
        switch ($first_day_name)
        {
            case "Sun":
                $col = 0;
                break;
            case "Mon":
                $col = 1;
                break;
            case "Tue":
                $col = 2;
                break;
             case "Wed":
                $col = 3;
                break;
             case "Thu":
                $col = 4;
                break;
             case "Fri":
                $col = 5;
                break;
             case "Sat":
                $col = 6;
                break;
             default:
                $col = 0;
                break;                
        }
        $no_of_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
        
        for($day = 1; $day <= $no_of_days; $day++)
        {
            $calendar_days[$row][$col] = $day;
            $col++;
            if($col == 7)
            {
                $col = 0;
                $row++;
            }
        }
        return $calendar_days;  
    }
    
    public function gen_week_calendar($weekno, $year)
    {
        $week_days = null;
        $row = 0;
        $no_of_days=7;
        
        for($day = 1; $day <= $no_of_days; $day++)
        {
            $first_day = date_create("{$year}-W{$weekno}-$day");
            $week_days[$row] = array($first_day,"");
            $row++;
        }
        return $week_days;  
    }
    
    public function render_booking_calendar($month,$year,$calendar_days,$equipment_calendar,$equipment_booking_calendar,$booking_request_calendar)
    {
        $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('F');
                
        $calendar_html = "";
        if(isset($calendar_days))
        {
            /* Create day header */
            $calendar_html = $calendar_html.'<br /><div class="row">';
            $calendar_html = $calendar_html.'<div class="col-md-12 text-center">'.'<div style="border:1px solid #31708f; background-color:#31708f; font-weight:400; font-size:24px;color:white">'.$monthName.'-'.$year.'</div>'.'</div>';
            $calendar_html = $calendar_html.'</div>';
            $calendar_html = $calendar_html.'<div class="row">';
            $calendar_html = $calendar_html.'<div class="col-md-12">';
            $calendar_html = $calendar_html.'<table class="table table-bordered" style="border-collapse: collapse;border-spacing: 0;">';
            $calendar_html = $calendar_html.'<thead>';
            $calendar_html = $calendar_html.'<tr>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Sunday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Monday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Tuesday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Wednesday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Thursday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Friday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Saturday</div></th>';
            $calendar_html = $calendar_html.'</tr>';
            $calendar_html = $calendar_html.'</thead>';
            $calendar_html = $calendar_html.'<tbody>';
            
            for ($row = 0; $row < 5; $row++) {
                /* First Create Row */
                if(isset($calendar_days[$row][0])) {
                    $calendar_html = $calendar_html.'<tr>';
                }
                for ($col = 0; $col < 7; $col++) {
                    if(isset($calendar_days[$row][$col]))
                    {
                        $day_number = $calendar_days[$row][$col];
                        $down_date = false;
                        $down_reason = "";
                        $bookings = "";
                        $requests = "";
                        /* Check if the day is marked as down-day */
                        if($equipment_calendar)
                        {
                            foreach ($equipment_calendar as $equipment_calendar_entry) {
                                //echo $equipment_calendar_entry["down_date"];
                                $down_day = $equipment_calendar_entry["down_day"];
                                if($down_day == $day_number)
                                {
                                    $down_date = true;
                                    $down_reason = $equipment_calendar_entry["down_reason"];
                                }
                            }
                        }
                        /*  Check if any bookings are there for the day */
                        if($equipment_booking_calendar){
                        foreach ($equipment_booking_calendar as $equipment_booking_entry) {
                            $booking_day = $equipment_booking_entry["confirmation_day"];
                            if($booking_day == $day_number)
                            {
                                if(empty($bookings))
                                {
                                    $bookings = '<span style="font-size:11px; font-weight:300;color:black">Bookings:</span><div class="booking-confirm">'.str_pad($equipment_booking_entry["confirmation_time_from"],2,"0",STR_PAD_LEFT).':00-'.str_pad($equipment_booking_entry["confirmation_time_to"],2,"0",STR_PAD_LEFT).':00  Hrs</div>';
                                }
                                else
                                {
                                    $bookings = $bookings.'<div class="booking-confirm">'.str_pad($equipment_booking_entry["confirmation_time_from"],2,"0",STR_PAD_LEFT).':00-'.str_pad($equipment_booking_entry["confirmation_time_to"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                }
                            }
                        }
                        }
                        /*  Check if any pending bookings requests are there for the day */
                        if($booking_request_calendar)
                        {
                            foreach ($booking_request_calendar as $booking_request_entry) {
                            $request_day = $booking_request_entry["request_day"];
                            if($request_day == $day_number)
                            {
                                if(empty($requests))
                                {
                                    $requests = '<span style="font-size:11px; font-weight:300;color:black">Requests:<div class="booking-request">'.str_pad($booking_request_entry["working_hrs"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                }
                                else
                                {
                                    $requests = $requests.'<div class="booking-request">'.str_pad($booking_request_entry["working_hrs"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                }
                            }
                        }
                        }
                        $calendar_html = $calendar_html.'<td>';
                        if($down_date)
                        {
                            $calendar_html = $calendar_html.'<div style="min-height:100px;background-color:#c9c9c9; color:blue; border:1px solid #e9e9e9; border-radius:2px;padding:3px">';
                            /* First Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.'<div class="down-day" style="border:1px solid #ccc; width:22px; height:22px;text-align:center;border-radius:2px;background-color:#e2e2e2;font-weight:bold;">'.$day_number.'</div>';
                            $calendar_html = $calendar_html.'</div>';
                            $calendar_html = $calendar_html.'</div>';                            
                            /* Second Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.'<div class="down-reason">'.$down_reason.'</div>';
                            $calendar_html = $calendar_html.'</div>';
                            $calendar_html = $calendar_html.'</div>';
                            
                            $calendar_html = $calendar_html.'</div>';
                        }
                        else
                        {
                            $calendar_html = $calendar_html.'<div style="min-height:100px;background-color:#f9f9f9; color:blue; border:1px solid #e9e9e9; border-radius:2px;padding:3px">';
                            /* First Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.'<div class="up-day" style="border:1px solid #ccc; width:22px; height:22px;text-align:center;border-radius:2px;background-color:#e2e2e2;font-weight:bold;" data-toggle="tooltip" title="New booking request"><div class="dn">'.$day_number.'</div><div class="dd" style="display:none">'.$day_number.'-'. substr($monthName, 0, 3).'-'.$year.'</div></div>';
                            $calendar_html = $calendar_html.'</div>';
                            $calendar_html = $calendar_html.'</div>';
                            /* Second Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.$bookings;
                            $calendar_html = $calendar_html.$requests;
                            $calendar_html = $calendar_html.'</div>';                            
                            $calendar_html = $calendar_html.'</div>';
                            
                            $calendar_html = $calendar_html.'</div>';
                        }                        
                        $calendar_html = $calendar_html.'</td>';
                    }
                    else
                    {
                        $calendar_html = $calendar_html.'<td>'.''.'</td>';
                    }
                }
                if(isset($calendar_days[$row][0])) {
                    $calendar_html = $calendar_html.'</tr>';
                }
            }
            $calendar_html = $calendar_html.'</tbody>';
            $calendar_html = $calendar_html.'</table>';
            $calendar_html = $calendar_html.'</div>';
            $calendar_html = $calendar_html.'</div>';
           
        }
        return $calendar_html;
    }
    
    public function render_booking_calendar_new($month,$year,$calendar_days,$equipment_calendar,$equipment_booking_calendar,$booking_request_calendar)
    {
        $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('F');
        
        $calendar_html = "";
        $calendar_html = $calendar_html.'<div class="row" style="border-bottom:1px solid #9e9e9e">';
        $calendar_html = $calendar_html.'<div class="col-md-1" style="float:left; font-size:1.3em; text-align:center; height:40px; line-height:40px; color:#757575"><i class="fa fa-angle-left" style="float:left; font-size:1.3em; text-align:center; height:40px; line-height:40px; color:#757575" aria-hidden="true"></i></div>';
        $calendar_html = $calendar_html.'<div class="col-md-10" style="float:left; font-size:1.3em; text-align:center; height:40px; line-height:40px; color:#757575">';
        $calendar_html = $calendar_html.strtoupper($monthName)."  ".$year;
        $calendar_html = $calendar_html.'</div>';
        $calendar_html = $calendar_html.'<div class="col-md-1" style="float:left; font-size:1.3em; text-align:center; height:40px; line-height:40px; color:#757575"><i class="fa fa-angle-right" style="float:left; font-size:1.3em; text-align:center; height:40px; line-height:40px; color:#757575" aria-hidden="true"></i></div>';
        $calendar_html = $calendar_html.'</div>';
        if(isset($calendar_days))
        {
            $calendar_html = $calendar_html.'<div class="row">';
            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; font-size:1.1em; font-weight:400; text-align:center; height:50px; line-height:50px; color:#757575" data-toggle="tooltip" title="Sunday">S</div>';
            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; font-size:1.1em; font-weight:400; text-align:center; height:50px; line-height:50px; color:#757575" data-toggle="tooltip" title="Monday">M</div>';
            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; font-size:1.1em; font-weight:400; text-align:center; height:50px; line-height:50px; color:#757575" data-toggle="tooltip" title="Tuesday">T</div>';
            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; font-size:1.1em; font-weight:400; text-align:center; height:50px; line-height:50px; color:#757575" data-toggle="tooltip" title="Wednesday">W</div>';
            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; font-size:1.1em; font-weight:400; text-align:center; height:50px; line-height:50px; color:#757575" data-toggle="tooltip" title="Thursday">T</div>';
            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; font-size:1.1em; font-weight:400; text-align:center; height:50px; line-height:50px; color:#757575" data-toggle="tooltip" title="Friday">F</div>';
            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; font-size:1.1em; font-weight:400; text-align:center; height:50px; line-height:50px; color:#757575" data-toggle="tooltip" title="Saturday">S</div>';
            $calendar_html = $calendar_html.'</div>';
            
            for ($row = 0; $row < 6; $row++) {
                $calendar_html = $calendar_html.'<div class="row">';
                for ($col = 0; $col < 7; $col++) {
                    if(isset($calendar_days[$row][$col]))
                    {
                        $day_number = $calendar_days[$row][$col];
                        $down_date = false;
                        $down_reason = "";
                        if($equipment_calendar)
                        {
                            foreach ($equipment_calendar as $equipment_calendar_entry) {
                                $down_day = $equipment_calendar_entry["down_day"];
                                if($down_day == $day_number)
                                {
                                    $down_date = true;
                                    $down_reason = $equipment_calendar_entry["down_reason"];
                                }
                            }
                        }
                        if($down_date)
                        {
                            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; text-align:center; height:50px; line-height:50px; color:#9e9e9e"><div class="day-down" data-toggle="tooltip" title="'.$down_reason.'">'.$day_number.'</div></div>';
                        }
                        else
                        {
                            $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; text-align:center; height:50px; line-height:50px; color:#9e9e9e"><div class="day-up" data-dd="'.$day_number.'" data-dm="'.$month.'" data-dy="'.$year.'" data-token="'.md5($day_number.$month.$year).'" data-dt="'.$day_number.'-'. substr($monthName, 0, 3).'-'.$year.'">'.$day_number.'</div></div>';
                        }
                    }
                    else
                    {
                        $calendar_html = $calendar_html.'<div style="float:left; width:14.28%; text-align:center; height:50px; line-height:50px; color:#9e9e9e"></div>';
                    }
                }
                $calendar_html = $calendar_html.'</div>';
            }
            
        }
        return $calendar_html;
    }
    
    public function render_booking_calendar_week($week_no,$year,$week_days,$equipment_calendar,$equipment_booking_calendar,$booking_request_calendar)
    {
        //$dateObj   = DateTime::createFromFormat('!m', $month);
        //$monthName = $dateObj->format('F');
        
        $calendar_html = "";
        if(isset($week_days))
        {
            /* Create day header */
            $calendar_html = $calendar_html.'<br /><div class="row">';
            $calendar_html = $calendar_html.'<div class="col-md-12 text-center">'.'<div style="border:1px solid #31708f; background-color:#31708f; font-weight:400; font-size:24px;color:white">'.date('F', strtotime($year.'-W'.$week_no)).'-'.$year.'</div>'.'</div>';
            $calendar_html = $calendar_html.'</div>';
            $calendar_html = $calendar_html.'<div class="row">';
            $calendar_html = $calendar_html.'<div class="col-md-12">';
            $calendar_html = $calendar_html.'<table class="table table-bordered" style="border-collapse: collapse;border-spacing: 0;">';
            $calendar_html = $calendar_html.'<thead>';
            $calendar_html = $calendar_html.'<tr>';
            
            $calendar_html = $calendar_html.'<th style="width: 12.5%"><div class="text-center"></div></th>';
            
            for ($row = 0; $row < 7; $row++)
            {
                $down_date = false;
                $down_reason = "";
                /* Check if the day is marked as down-day */
                if($equipment_calendar)
                {
                    foreach ($equipment_calendar as $equipment_calendar_entry) {
                        //echo $equipment_calendar_entry["down_date"];
                        $down_day = $equipment_calendar_entry["down_day"];
                        if($down_day == $week_days[$row][0]->format('j'))
                        {
                            $down_date = true;
                            $down_reason = $equipment_calendar_entry["down_reason"];
                        }
                    }
                }
                $calendar_html = $calendar_html.'<th style="width: 12.5%">';
                $calendar_html = $calendar_html.'<div class="row"><div class="col-md-12" style="padding:3px;">'.$week_days[$row][0]->format('D').'</div></div>';
                if($down_date)
                {
                    $calendar_html = $calendar_html.'<div class="row"><div class="col-md-12" style="padding:3px;"><div class="down-day" style="border:1px solid #ccc; width:22px; height:22px;text-align:center;border-radius:2px;background-color:#e2e2e2;font-weight:bold;" data-toggle="tooltip" title="" data-original-title="New booking request"><div class="dn">'.$week_days[$row][0]->format('j').'</div><div class="dd" style="display:none">'.$week_days[$row][0]->format('d-M-Y').'</div></div></div></div>';
                    $calendar_html = $calendar_html.'<div class="row"><div class="col-md-12" style="padding:3px;"><div style="line-height:12px;padding:2px;border:1px solid #ccc; font-size:0.7em; text-align:left;border-radius:2px;background-color:#ffeb3b;font-weight:normal;" data-toggle="tooltip" title="">'.$down_reason.'</div></div></div>';
                }
                else
                {
                    $calendar_html = $calendar_html.'<div class="row"><div class="col-md-12" style="padding:3px;"><div class="up-day" style="border:1px solid #ccc; width:22px; height:22px;text-align:center;border-radius:2px;background-color:#e2e2e2;font-weight:bold;" data-toggle="tooltip" title="" data-original-title="New booking request"><div class="dn">'.$week_days[$row][0]->format('j').'</div><div class="dd" style="display:none">'.$week_days[$row][0]->format('d-M-Y').'</div></div></div></div>';
                }
            }            
            $calendar_html = $calendar_html.'</tr>';
            $calendar_html = $calendar_html.'</thead>';
            $calendar_html = $calendar_html.'<tbody>';
            
            for($i = 0; $i < 24 ; $i++)
            {
                $calendar_html = $calendar_html.'<tr>';
                for ($col = 0; $col < 8; $col++)
                {
                    if($col == 0)
                    {
                        $from_time = str_pad($i, 2, "0", STR_PAD_LEFT); 
                        $to_time = str_pad($i+1, 2, "0", STR_PAD_LEFT); 
                        
                        $calendar_html = $calendar_html.'<td style="border-color:#ddd;">';
                        $calendar_html = $calendar_html.'<div style="min-height:16px">';
                        $calendar_html = $calendar_html.$from_time.':00 - '.$to_time.':00';
                        $calendar_html = $calendar_html.'</div>';
                        $calendar_html = $calendar_html.'</td>';
                    }
                    else
                    {
                        $from_time = str_pad($i, 2, "0", STR_PAD_LEFT); 
                        $to_time = str_pad($i+1, 2, "0", STR_PAD_LEFT); 
                        
                        $calendar_html = $calendar_html.'<td style="border-color:#ddd;">';
                        $calendar_html = $calendar_html.'<div style="min-height:16px">';
                        
                        $bookings_exist = false;
                        $requests_exist = false;
                        
                        if($equipment_booking_calendar){
                            foreach ($equipment_booking_calendar as $equipment_booking_entry) {
                                $booking_day = $equipment_booking_entry["confirmation_day"];
                                if($booking_day == $week_days[$col-1][0]->format('j'))
                                {
                                    if($from_time == $equipment_booking_entry["confirmation_time_from"])
                                    {
                                        $bookings_exist = true;
                                        $calendar_html = $calendar_html.'<div class="booking-confirm">'.str_pad($equipment_booking_entry["confirmation_time_from"],2,"0",STR_PAD_LEFT).':00-'.str_pad($equipment_booking_entry["confirmation_time_to"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                    }
                                    if($to_time == $equipment_booking_entry["confirmation_time_to"])
                                    {
                                        $bookings_exist = true;
                                        $calendar_html = $calendar_html.'<div class="booking-confirm">'.str_pad($equipment_booking_entry["confirmation_time_from"],2,"0",STR_PAD_LEFT).':00-'.str_pad($equipment_booking_entry["confirmation_time_to"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                    }
                                    if($from_time > $equipment_booking_entry["confirmation_time_from"] && $to_time < $equipment_booking_entry["confirmation_time_to"])
                                    {
                                        $bookings_exist = true;
                                        $calendar_html = $calendar_html.'<div class="booking-confirm">'.str_pad($equipment_booking_entry["confirmation_time_from"],2,"0",STR_PAD_LEFT).':00-'.str_pad($equipment_booking_entry["confirmation_time_to"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                    }
                                }
                            }
                        }

                        if($booking_request_calendar)
                        {
                            foreach ($booking_request_calendar as $booking_request_entry) {
                                $request_day = $booking_request_entry["request_day"];
                                if($request_day == $week_days[$col-1][0]->format('j'))
                                {
                                    if($from_time == $booking_request_entry["preferred_timings_from"])
                                    {
                                        $requests_exist = true;
                                        $calendar_html = $calendar_html.'<div class="booking-request">'.str_pad($booking_request_entry["working_hrs"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                    }
                                    if($to_time == $booking_request_entry["preferred_timings_to"])
                                    {
                                        $requests_exist = true;
                                        $calendar_html = $calendar_html.'<div class="booking-request">'.str_pad($booking_request_entry["working_hrs"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                    }
                                    if($from_time > $booking_request_entry["preferred_timings_from"] && $to_time < $booking_request_entry["preferred_timings_to"])
                                    {
                                        $requests_exist = true;
                                        $calendar_html = $calendar_html.'<div class="booking-request">'.str_pad($booking_request_entry["working_hrs"],2,"0",STR_PAD_LEFT).':00 Hrs</div>';
                                    }
                                }
                            }
                        }
                        
                        if($bookings_exist == false && $requests_exist == false)
                        {
                            $calendar_html = $calendar_html.'<div style="min-height:16px">';
                            $calendar_html = $calendar_html.'<div class="up-day" style="width:auto; height:22px;text-align:center;border-radius:2px;font-weight:bold;" data-toggle="tooltip" title="" data-original-title="New booking request"><div class="dn"></div><div class="dd" style="display:none">'.$week_days[$col-1][0]->format('d-M-Y').'</div><div class="dtt" style="display:none">1</div><div class="dfrt" style="display:none">'.$i.'</div><div class="dtot" style="display:none">'.($i+1).'</div></div>';
                            $calendar_html = $calendar_html.'</div>';
                        }
                        $calendar_html = $calendar_html.'</div>';
                        $calendar_html = $calendar_html.'</td>';                        
                    }
                }
                $calendar_html = $calendar_html.'</tr>';
            }
            $calendar_html = $calendar_html.'</tbody>';
            $calendar_html = $calendar_html.'</table>';
            $calendar_html = $calendar_html.'</div>';
            $calendar_html = $calendar_html.'</div>';           
        }
        return $calendar_html;
    }
    
    public function render_equipment_calendar($month,$year,$calendar_days,$equipment_calendar)
    {
        $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('F');
        $calendar_html = "";
        if(isset($calendar_days))
        {
            /* Create day header */
            $calendar_html = $calendar_html.'<br /><div style=""><div class="row">';
            $calendar_html = $calendar_html.'<div class="col-md-12 text-center">'.'<div style="border:1px solid #31708f; background-color:#31708f; font-weight:400; font-size:24px;color:white">'.$monthName.'-'.$year.'</div>'.'</div>';
            $calendar_html = $calendar_html.'</div>';
            $calendar_html = $calendar_html.'<div class="row">';
            $calendar_html = $calendar_html.'<div class="col-md-12">';
            $calendar_html = $calendar_html.'<table class="table table-bordered" style="border-collapse: collapse;border-spacing: 0;">';
            $calendar_html = $calendar_html.'<thead>';
            $calendar_html = $calendar_html.'<tr>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Sunday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Monday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Tuesday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Wednesday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Thursday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Friday</div></th>';
            $calendar_html = $calendar_html.'<th style="width: 14.28%"><div class="text-center">Saturday</div></th>';
            $calendar_html = $calendar_html.'</tr>';
            $calendar_html = $calendar_html.'</thead>';
            $calendar_html = $calendar_html.'<tbody>';
            
            for ($row = 0; $row < 5; $row++) {
                /* First Create Row */
                if(isset($calendar_days[$row][0])) {
                    $calendar_html = $calendar_html.'<tr>';
                }
                for ($col = 0; $col < 7; $col++) {
                    if(isset($calendar_days[$row][$col]))
                    {
                        $day_number = $calendar_days[$row][$col];
                        $down_date = false;
                        $down_reason = "";
                        /* Check if the day is marked as down-day */
                        foreach ($equipment_calendar as $equipment_calendar_entry) {
                            //echo $equipment_calendar_entry["down_date"];
                            $down_day = $equipment_calendar_entry["down_day"];
                            if($down_day == $day_number)
                            {
                                $down_date = true;
                                $down_reason = $equipment_calendar_entry["down_reason"];
                            }
                        }
                        $calendar_html = $calendar_html.'<td>';
                        if($down_date)
                        {
                            $calendar_html = $calendar_html.'<div style="min-height:100px;background-color:#c9c9c9; color:blue; border:1px solid #e9e9e9; border-radius:2px;padding:3px">';
                            /* First Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.'<div class="calendar-day" style="border:1px solid #ccc; width:22px; height:22px;text-align:center;border-radius:2px;background-color:#e2e2e2;font-weight:bold;"><div class="dn">'.$day_number.'</div><div class="dd" style="display:none">'.$day_number.'-'. substr($monthName, 0, 3).'-'.$year.'</div></div>';
                            $calendar_html = $calendar_html.'</div>';
                            $calendar_html = $calendar_html.'</div>';                            
                            /* Second Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.'<div class="down-reason">'.$down_reason.'</div>';
                            $calendar_html = $calendar_html.'</div>';
                            $calendar_html = $calendar_html.'</div>';
                            
                            $calendar_html = $calendar_html.'</div>';
                        }
                        else
                        {
                            $calendar_html = $calendar_html.'<div style="min-height:100px;background-color:#f9f9f9; color:blue; border:1px solid #e9e9e9; border-radius:2px;padding:3px">';
                            /* First Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.'<div class="calendar-day" style="border:1px solid #ccc; width:22px; height:22px;text-align:center;border-radius:2px;background-color:#e2e2e2;font-weight:bold;"><div class="dn">'.$day_number.'</div><div class="dd" style="display:none">'.$day_number.'-'. substr($monthName, 0, 3).'-'.$year.'</div></div>';
                            $calendar_html = $calendar_html.'</div>';
                            $calendar_html = $calendar_html.'</div>';
                            /* Second Row */
                            $calendar_html = $calendar_html.'<div class="row">';
                            $calendar_html = $calendar_html.'<div class="col-md-12" style="padding:3px;">';
                            $calendar_html = $calendar_html.'</div>';                            
                            $calendar_html = $calendar_html.'</div>';
                            
                            $calendar_html = $calendar_html.'</div>';
                        }                        
                        $calendar_html = $calendar_html.'</td>';
                    }
                    else
                    {
                        $calendar_html = $calendar_html.'<td>'.''.'</td>';
                    }
                }
                if(isset($calendar_days[$row][0])) {
                    $calendar_html = $calendar_html.'</tr>';
                }
            }
            $calendar_html = $calendar_html.'</tbody>';
            $calendar_html = $calendar_html.'</table>';
            $calendar_html = $calendar_html.'</div>';
            $calendar_html = $calendar_html.'</div>';
            $calendar_html = $calendar_html.'</div>';
        }
        return $calendar_html;
    }   
}
?>