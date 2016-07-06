<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;

    class Message extends ML\Base\Model {

        /**
         * @var int
         */
        var $id;

        /**
         * @var string
         */
        var $level;

        /**
         * @var string
         */
        var $text;

        /**
         * @var string
         */
        var $timestamp;


    }

}