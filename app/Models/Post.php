<?php

namespace app\Models;

use core\Model;

class Post extends Model
{
    /**
     * La tabla de la base de datos
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Campos de la base de datos que
     * pueden ser asignados
     *
     * @var mixed
     */
    protected $fillable = [
        'title', 'content', 'user_id',
    ];

}