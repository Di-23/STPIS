<?php
class likes{
    static function isLiked($type,$user_id,$post_id)
    {
        return SQL::exec('SELECT * FROM like WHERE element_id=? AND user_id=? AND type=? AND liked=?', [$post_id,$user_id,$type,1], SQL::FETCH);
    }
    static function setLiked($type,$user_id,$post_id,$isLiked)
    {
        SQL::exec('UPDATE like SET liked=? WHERE element_id=? AND user_id=? AND type=?', [$isLiked,$post_id,$user_id,$type], SQL::FETCH);
    }
    static function countLikes($type,$post_id)
    {
        return SQL::exec('SELECT count(id) FROM like WHERE element_id=? AND type=? AND liked=?', [$post_id,$type,1], SQL::COUNT);
    }
}
