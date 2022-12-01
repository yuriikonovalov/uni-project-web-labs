<?php
function request_weather($url = 'https://www.gismeteo.ua/ua/weather-kharkiv-5053/')
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($curl);
    curl_close($curl);
    return new Weather($data);
}

class Temperature
{
    public  $hour;
    public  $degree;

    public function __construct($hour,  $degree)
    {
        $this->hour = $hour;
        $this->degree = $degree;
    }
}

class Weather
{
    public  $city;
    public  $date;
    public  $sunrise;
    public  $sunset;
    public  $day_time;
    public  $temperatures;

    public function __construct($response)
    {
        $this->city = $this->get_city($response);
        $this->date = $this->get_date($response);
        $this->sunrise = $this->get_sunrise($response);
        $this->sunset = $this->get_sunset($response);
        $this->day_time = $this->get_day_time($response);
        $this->temperatures = $this->get_temperatures($response);
    }

    private function  get_city($response)
    {
        $pattern = '/<div class=\"transparent-city js-transparent-city\">.*<\/div>/sU';
        preg_match($pattern, $response, $matches);
        $match = $matches[0];
        $start = strlen("<div class=\"transparent-city js-transparent-city\">");
        $end =  strlen($match) - $start - strlen("</div>");
        return substr($match, $start, $end);
    }

    private function get_date($response)
    {
        $pattern = '/cacheDate: \'..\...\...../sU';
        preg_match($pattern, $response, $matches);
        $match = $matches[0];
        $start = strlen("cacheDate: '");
        $end =  strlen($match) - $start;
        return substr($match, $start, $end);
    }


    private function get_sunrise($response)
    {
        $pattern = '/<div class="astro-sun">.*<div>Схід — .*:.*<\/div>/sU';
        preg_match($pattern, $response, $matches);
        $match = $matches[0];
        $start_breakpoint = "Схід — ";
        $start = strpos($match, $start_breakpoint) + strlen($start_breakpoint);
        $end =  strlen($match) - $start - strlen("</div>");
        return substr($match, $start, $end);
    }

    private function get_sunset($response)
    {
        $pattern = '/<div class="astro-sun">.*<div>Захід — .*:.*<\/div>/sU';
        preg_match($pattern, $response, $matches);
        $match = $matches[0];
        $start_breakpoint = "Захід — ";
        $start = strpos($match, $start_breakpoint) + strlen($start_breakpoint);
        $end =  strlen($match) - $start - strlen("</div>");
        return substr($match, $start, $end);
    }


    private function get_day_time($response)
    {
        $pattern = '/Тривалість дня: .*<\/div>/sU';
        preg_match($pattern, $response, $matches);
        $match = $matches[0];
        $start = strlen("Тривалість дня: ");
        $end =  strlen($match) - $start - strlen("</div>");
        $day_time =  substr($match, $start, $end);
        return $this->format_day_time($day_time);
    }


    private function format_day_time($day_time)
    {
        $array = explode(" ", $day_time);
        $formatted_hours = $this->format_hours($array[0]);
        // If more there's more than 2 items then the date also has a minute value.
        if (count($array) > 2) {
            return "$formatted_hours $array[2] $array[3]";
        } else {
            return "рівно $formatted_hours";
        }
    }

    private function format_hours($hours)
    {
        switch (true) {
            case in_array($hours, array('1', '21')):
                return "$hours година";
            case in_array($hours, array('2', '3', '4', '22', '23', '24')):
                return "$hours години";
            default:
                return "$hours годин";
        }
    }

    private function get_temperatures($response)
    {
        $pattern = '/width: 12.5%.*?<span class="unit unit_temperature_c">.*?<\/span>/';
        preg_match_all($pattern, $response, $matches);
        $match = $matches[0];
        $temperatures = array();
        for ($i = 0; $i < 8; $i++) {
            $start_breakpoint = "<span class=\"unit unit_temperature_c\">";
            $start = strpos($match[$i], $start_breakpoint) + strlen($start_breakpoint);
            $end =  strlen($match[$i]) - $start - strlen("</span>");
            $temperature =  substr($match[$i], $start, $end);
            $temperature = str_replace('&minus;', '-', $temperature);
            $temperatures[$i] = $temperature;
        }

        $hours = $this->get_temperature_hours($response);
        $result = array();
        for ($i = 0; $i < 8; $i++) {
            $result[$i] = new Temperature($hours[$i], $temperatures[$i]);
        }
        return $result;
    }

    private function get_temperature_hours($response)
    {
        $pattern = '/<span>..?<sup class="time-sup">/';
        preg_match_all($pattern, $response, $matches);
        $match = $matches[0];
        $hours = array();
        for ($i = 0; $i < 8; $i++) {
            $start = strlen("<span>");
            $end =  strlen($match[$i]) - $start - strlen("<sup class=\"time-sup\">");
            $hour =  substr($match[$i], $start, $end);
            $hours[$i] = $hour;
        }
        return $hours;
    }
}
