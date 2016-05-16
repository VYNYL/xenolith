<?php

namespace Vynyl\Xenolith\Value;

class ModelTemplate extends Template
{
    /**
     * Namespace of the model.
     */
    public $namespace;

    /**
     * Soft delete import statement.
     */
    public $soft_delete_import;

    /**
     * Documentation to be displayed above the class.
     */
    public $docs;

    /**
     * Name of the table.
     */
    public $table_name;

    /**
     * Timestamp mappings.
     */
    public $timestamps;

    /**
     * Soft delete date mappings.
     */
    public $soft_delete_dates;

    /**
     * Primary key of model.
     */
    public $primary;

    /**
     * List of fillable fields.
     */
    public $fields;

    /**
     * List of casts.
     */
    public $casts;

    /**
     * List of validation rules.
     */
    public $rules;

    /**
     * ModelTemplate constructor.
     */
    public function __construct()
    {

    }
}
