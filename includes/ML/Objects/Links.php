<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;


    trait Links {

        /**
         * @var Objects\Link[]
         */
        var $links;

        /**
         * @param ML\Base\Xml_Element $current
         */
        function add_link( $current ) {
            $type = $current->get_attribute( 'type' );

            $link = new Objects\Link( $current );

            if ( 'api' === $type ) {
                $api_key_param = '&apiKey=' . \NprAlt::api_key();
                $link->url = str_replace( $api_key_param, '', $link->url );
            }

            $this->links[ $type ] = $link;


        }

    }
}