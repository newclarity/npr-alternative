<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;

    class Audio extends ML\Base\Model {

        const PROPERTY_MAP = array(
            'rightsHolder' => 'rights_holder',
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
        var $duration;

        /**
         * @var string
         */
        var $description;

        /**
         * @var Objects\Format[]
         */
        var $formats;

        /**
         * @var string
         */
        var $region;

        /**
         * @var string
         */
        var $rights_holder;

        /**
         * @var Objects\Permissions
         */
        var $permissions;

        /**
         * @var Objects\Stream
         */
        var $stream;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'id':
                case 'title':
                case 'type':
                case 'description':
                case 'region':
                case 'rights_holder':
                    $this->set_string_value( $xml_element );
                    break;

                case 'duration':
                    $this->duration = intval( $xml_element->value() );
                    break;

                case 'format':
                    $this->formats[] = new Objects\Format( $xml_element );
                    break;

                case 'permissions':
                    $this->permissions[] = new Objects\Permissions( $xml_element );
                    break;

                case 'stream':
                    $this->stream = new Objects\Stream( $xml_element );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }

    }
}