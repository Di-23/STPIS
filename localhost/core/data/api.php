<?php
class API{
    static function runMethod($data)
    {
        if(session::$current_session_id<=0)
            throw new MException('Error: Unathorized cant use Wteme.API');
        
        switch ($data) {
            case 'like':
            case 'isLiked':
            case 'addToFriends':
            case 'isFriend':
        }
    }
}