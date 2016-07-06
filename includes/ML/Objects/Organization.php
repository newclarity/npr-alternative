<?php

namespace NprAlt\ML\Objects {

    use NprAlt\ML;

    class Organization extends ML\Base\Model {

        const PROPERTY_MAP = array(
            'orgId'   => 'org_id',
            'orgAbbr' => 'org_abbr',
        );

        /**
         * @var int
         */
        var $org_id;

        /**
         * @var string
         */
        var $org_abbr;

        /**
         * @var string
         */
        var $name;

        /**
         * @var string
         */
        var $website;

    }

}