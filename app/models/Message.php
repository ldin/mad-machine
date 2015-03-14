<?php

class Message extends \Eloquent {
        protected $fillable = array('email', 'message', 'addressee_id', 'sender_id', 'addressee_status', 'sender_status');

}