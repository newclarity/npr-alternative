<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;

    /**
     * Class _List_ - Underscores used because "list" is a reserved word in PHP.
     */
    class _List_ extends ML\Base\Model {

        const PROPERTY_MAP = array(
            'miniTeaser' => 'mini_teaser',
        );

        /**
         * @var string
         */
        var
        $title;

        /**
         * @var string
         */
        var
        $teaser;

        /**
         * @var string
         */
        var
        $mini_teaser;

        /**
         * @var ML\Objects\Links[] $links
         */
        use Objects\Links;

        /**
         * @var Objects\Story[]
         */
        var
        $stories;

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'link':
                    $this->add_link( $xml_element );
                    break;

                case 'story':
                    $this->stories[] = new Objects\Story( $xml_element );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );

            }

        }


        /**
         *
         */
        function reserve_stories() {
            //
            //      //if the query didn't have a sort parameter, reverse the order so that we end up with
            //      //stories in reverse-chron order.
            //      //there are no params and 'sort=' is not in the URL
            //      if (empty($this->request->params) && !stristr($this->request->url, 'sort=')){
            //        $this->stories = array_reverse($this->stories);
            //      }
            //      //there are params, and sort is not one of them
            //      if (!empty($this->request->params) && !array_key_exists('sort', $this->request->params ) ){
            //        $this->stories = array_reverse($this->stories);
            //      }

        }

    }

}