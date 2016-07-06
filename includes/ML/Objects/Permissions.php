<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;

    class Permissions extends ML\Base\Model {

        /**
         * @var Objects\Permission
         */
        var $download;

        /**
         * @var Objects\Permission
         */
        var $stream;

        /**
         * @var Objects\Permission
         */
        var $embed;

    }

}