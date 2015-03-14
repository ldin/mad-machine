<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends Eloquent 
{
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;
}


