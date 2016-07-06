<?php

namespace NprAlt\ML\Base {

    use NprAlt\ML;

    /**
     * Class NprAlt_Core_DateTime
     */
    class DateTime {

        /**
         * @var int
         */
        var $time;

        /**
         * @var string
         */
        var $year;

        /**
         * @var string
         */
        var $month;

        /**
         * @var string
         */
        var $day;

        /**
         * @var string
         */
        var $hour;

        /**
         * @var string
         */
        var $minutes;

        /**
         * @var string
         */
        var $seconds;

        /**
         * @var string
         */
        var $time_zone;

        /**
         * NprML_DateTime constructor.
         *
         * @param ML\Base\Xml_Element $xml_element
         */
        function __construct( $xml_element ) {

            $this->time = strtotime( $xml_element->value() );

            $this->year = date( 'Y', $this->time );
            $this->month = date( 'm', $this->time );
            $this->day = date( 'd', $this->time );

            $this->hour = date( 'h', $this->time );
            $this->minutes = date( 'i', $this->time );
            $this->seconds = date( 's', $this->time );

            $this->time_zone = date( 'e', $this->time );

        }

        /**
         * @return bool|string
         */
        function __toString() {
            return date( 'Y-m-d h:i:s', $this->time );
        }

    }
}