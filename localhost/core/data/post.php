<?

class post {

    public static function getFriendsPosts($id) {
        $ids = friends::getFriendsIds($id);
        if($ids)
        return SQL::exec('SELECT * FROM posts WHERE autor IN('.str_repeat('?,', count($ids) - 1) . '?'.') ORDER BY id DESC', $ids, SQL::FETCHALL);
    }

    private static function incrementPostViews($id) {
        SQL::exec('UPDATE posts SET views=views+1 WHERE autor=?', [$id], SQL::NONE);
    }

    public static function getPostsById($id) {
        self::incrementPostViews($id);
        return SQL::exec('SELECT * FROM posts WHERE autor=? ORDER BY id DESC', [$id], SQL::FETCHALL);
    }

}

?>