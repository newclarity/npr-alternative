<?php

namespace NprAlt\ML\Objects {

    use NprAlt\ML;
    use NprAlt\ML\Objects;

    class Image extends ML\Base\Model {

        const PROPERTY_MAP = array(
            'hasBorder' => 'has_border',
        );

        /**
         * @var string
         */
        var $id;

        /**
         * @var string
         */
        var $title;

        /**
         * @var string
         */
        var $type;

        /**
         * @var int
         */
        var $width;

        /**
         * @var string
         */
        var $src;

        /**
         * @var string
         */
        var $has_border;

        /**
         * @var string
         */
        var $caption;

        /**
         * @var Objects\Link
         */
        var $link;

        /**
         * @var string
         */
        var $producer;

        /**
         * @var Objects\Provider
         */
        var $provider;

        /**
         * @var string
         */
        var $copyright;

        /**
         * @var Objects\Crop[]
         */
        var $crops;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'title':
                case 'caption':
                case 'producer':
                case 'copyright':
                case 'id':
                case 'type':
                case 'width':
                case 'src':
                case 'hasBorder':
                    $this->set_string_value( $xml_element );
                    break;

                case 'link':
                    $this->link = new Objects\Link( $xml_element );
                    break;

                case 'crop':
                    $this->crops[] = new Objects\Crop( $xml_element );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }

        /**
         * @param ML\Base\Xml_Element $root_element
         */
        function sanitize_properties( $root_element ) {

            $this->width = intval( $this->width );
            $this->has_border = 'true' === strtolower( $this->has_border );

        }


    }

}