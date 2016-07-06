<?php

use NprAlt\Core;
use NprAlt\ML\Objects;

/**
 * Class NprAlt\Result
 */
class NprAlt_Result extends Core\Instance {


    /**
     * @var Objects\Root
     */
    private $_ml_root;

    /**
     * NprAlt\Result constructor.
     *
     * @param Objects\Root $_ml_root
     * @param                 $properties
     */
    function __construct( $_ml_root, $properties = array() ) {

        $this->_ml_root = $_ml_root;

        parent::__construct( $properties );

    }

    function stories() {

        return $this->_ml_root;

    }

}
