<?php

namespace App\Models;

class Regions_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'regions';
        parent::__construct($this->table);
    }

}
