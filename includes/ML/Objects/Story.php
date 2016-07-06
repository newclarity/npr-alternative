<?php

namespace NprAlt\ML\Objects {

    use NprAlt\Core;
    use NprAlt\ML;
    use NprAlt\ML\Objects;

    class Story extends ML\Base\Model {

        use Objects\Links;

        const PROPERTY_MAP = array(
            'partnerId'        => 'partner_id',
            'shortTitle'       => 'short_title',
            'miniTeaser'       => 'mini_teaser',
            'textWithHtml'     => 'html',
            'storyDate'        => 'story_date',
            'pubDate'          => 'pub_date',
            'lastModifiedDate' => 'last_modified_date',
            'audioRunByDate'   => 'audio_run_by_date',
            'priorityKeywords' => 'priority_keywords',
        );


        /**
         * @var string
         */
        var $id;

        /**
         * @var string
         */
        var $partner_id;

        /**
         * @var string
         */
        var $title;

        /**
         * @var string
         */
        var $subtitle;

        /**
         * @var string
         */
        var $short_title;

        /**
         * @var string
         */
        var $teaser;

        /**
         * @var string
         */
        var $mini_teaser;

        /**
         * @var string
         */
        var $slug;

        /**
         * @var string
         */
        var $transcript;

        /**
         * @var Objects\ByLine|Objects\ByLine[]
         */
        var $bylines;

        /**
         * @var Objects\Paragraphs
         */
        var $text;

        /**
         * @var Objects\Paragraphs
         */
        var $html;

        /**
         * @var string
         */
        var $story_date;

        /**
         * @var string
         */
        var $pub_date;

        /**
         * @var string
         */
        var $last_modified_date;

        /**
         * @var Objects\Image[]
         */
        var $images = array();

        /**
         * @var Objects\Audio[]
         */
        var $audio = array();

        /**
         * @var Objects\Organization
         */
        var $organization;

        /**
         * @var Objects\Story_Ref[]
         */
        var $parents = array();

        /**
         * @param string              $element_name
         * @param ML\Base\Xml_Element $xml_element
         */
        function assign_value( $element_name, $xml_element ) {

            switch ( $element_name ) {

                case 'link':
                    $this->add_link( $xml_element );
                    break;

                case 'storyDate':
                case 'pubDate':
                case 'lastModifiedDate':
                    $this->set_datetime_value( $xml_element );
                    break;

                case 'organization':
                    $this->organization = new Objects\Organization( $xml_element );
                    break;

                case 'parent':
                    $this->parents[] = new Objects\Story_Ref( $xml_element );
                    break;

                case 'byline':
                    $this->bylines[] = new Objects\Byline( $xml_element );
                    break;

                case 'image':
                    $this->images[] = new Objects\Image( $xml_element );
                    break;

                case 'audio':
                    $this->audio[] = new Objects\Audio( $xml_element );
                    break;

                case 'text':
                case 'textWithHtml':
                    $this->set_object_value( $xml_element, new Objects\Paragraphs( $xml_element, array(
                        'is_html' => 'textWithHtml' === $element_name,
                    ) ) );
                    break;

                default:
                    parent::assign_value( $element_name, $xml_element );
                    break;

            }

        }

    }
}