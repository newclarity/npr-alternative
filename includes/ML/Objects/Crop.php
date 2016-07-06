<?php

namespace NprAlt\ML\Objects {

    use NprAlt\ML;

    class Crop extends ML\Base\Model {

        /**
         * @var string
         */
        var $type;

        /**
         * @var string
         */
        var $src;

        /**
         * @var int
         */
        var $height;

        /**
         * @var int
         */
        var $width;

        /**
         * @var bool
         */
        var $primary;

        /**
         * @param ML\Base\Xml_Element $root_element
         */
        function sanitize_properties( $root_element ) {

            $this->height = intval( $this->height );
            $this->width = intval( $this->width );
            $this->primary = 'true' === strtolower( $this->primary );

        }

    }
}