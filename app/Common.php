<?php
namespace App;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use App\Event;
use Code16\CarbonBusiness\BusinessDays;
class Common
{
	public function getTextBetween($string, $start, $end){
		$string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}

	public function terbilang($nilai){
        if($nilai<0) {
            $hasil = "minus ". trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }           
        return $hasil;
    }

    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    public function buildAction($method=null,$id, array $misc = null){
        //method build action button eg.inside datatable etc
        $title = ($misc['title'] != null) ? $misc['title'] : 'title';
        $class = ($misc['class'] != null) ? $misc['class'] : 'btn btn-outline-primary btn-sm';
        $icon = ($misc['icon'] != null) ? $misc['icon'] : 'fa fa-info';

        $control = '<a href="javascript:void(0);" onclick="'.$method.'('. $id .')" data-toggle="tooltip" title="'.$title.'" class="'.$class.'"><i class="'.$icon.'"></i></a>';
        return $control;
    }

    static function workingDays($start, $end){
        
        $start = date('Y-m-d H:i:s', strtotime($start) );
        $end = date('Y-m-d H:i:s', strtotime($end) );
        $day_end = strtotime($end);
        $day_end_name = date('l',$day_end);
        $date = new BusinessDays();
        $get_holidays = Event::whereBetween('start', [$start, $end])->whereNull('info')->get();
        $holidays = array();
        //return $get_holidays;
        foreach($get_holidays as $holiday){
            //$holidays[] = $holiday->start;
            $date->addHoliday(Carbon::parse($holiday->start));
            $holidays[] = $holiday->start;
            
        }
        //$i = ( !in_array($start,$holidays) && !in_array($day_start_name,['Sun','Sat']) ) ? 1 : 0;
        $include_end = ( !in_array($end,$holidays) && !in_array($day_end_name,['sunday','saturday']) ) ? 1 : 0;

        $days = $date->daysBetween(Carbon::parse($start), Carbon::parse($end));
        $days_count = $days+$include_end;
        //return $days+$i+$j;
        return $days_count;
        //return $days;
    }

    static function cutText($string, $mode = 2, $n = 0)
    {
        $n = ($n == 0) ? 50 : $n;
        if (strlen($string) > 50) {

            // truncate string
            $stringCut = substr($string, 0, $n);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;
    }

    // get array dates between 2 dates
    // $format = 'Y-m-d' default mysql date format
    static function getDatesArray($date_start, $date_end, $format = 'Y-m-d'){
      $dates = array();
      $current = strtotime($date_start);
      $date2 = strtotime($date_end);
      $stepVal = '+1 day';
      while( $current <= $date2 ) {
         $dates[] = date($format, $current);
         $current = strtotime($stepVal, $current);
      }
      return $dates;
    }

    //fungsi untuk menampilkan array tanggal selain hari libur (sabtu, minggu, dan hari besar)
    static function getAvailableDate($date_start, $date_end)
    {
        
        $dates_array = Common::getDatesArray($date_start, $date_end);
        //get available dates (dates between $tgl_mulai and $tgl_akhir except holiday and weekend)
        $available = [];
        foreach($dates_array as $date){
            $dayname = date('D', strtotime($date));
            if(!in_array($dayname,['Sat','Sun'])){
                //cek hari libur disini
                $holiday = Event::whereNull('info')->where('start', date($date))->count();
                if($holiday<1){
                    //code terkait kuota kalender per user disini
                    array_push($available, $date);
                }
            }            
        }
        return $available;
    
    }

    static function cleanInput($input){
        $str = htmlspecialchars_decode($input);
        $allowed_html = '<br><p><div><span><img><a>';
        return strip_tags($str, $allowed_html);
    }
    

    function find_key_value($array, $key, $val)
    {
        foreach ($array as $item)
        {
            if (is_array($item) && find_key_value($item, $key, $val)) return true;

            if (isset($item[$key]) && $item[$key] == $val) return true;
        }

        return false;
    }
    
}