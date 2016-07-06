<?php


namespace NprAlt\ML\Objects {

    use NprAlt\ML;
    use NprAlt\ML\Objects;

    class Story_Ref extends ML\Base\Model {

        /**
         * @var string
         */
        var $id;

        /**
         * @var string
         */
        var $type;

        /**
         * @var string
         */
        var $title;

        /**
         * Links property
         */
        use Objects\Links;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'title':
                    $this->set_string_value( $xml_element );
                    break;

                case 'link':
                    $this->add_link( $xml_element );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }

    }

}