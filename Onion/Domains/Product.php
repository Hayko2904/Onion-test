<?php


namespace Onion\Domains;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string
     * Products table
     */
    protected $table = 'products';

    /**
     * @var string[]
     * Fillable columns
     */
    protected $fillable = [
        'title'
    ];
}
