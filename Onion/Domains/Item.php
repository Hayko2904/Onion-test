<?php


namespace Onion\Domains;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'title'
    ];
}
