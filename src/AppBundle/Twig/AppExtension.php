<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('minutesToHour', [$this, 'minutesToHourFilter']),
        ];
    }

    public function minutesToHourFilter($time, $format = '%02dh%02d')
    {
        if ($time < 1) {
            return;
        }
        $hours   = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
}