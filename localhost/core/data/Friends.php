<?

class friends {

    public static function getFriendsIds($id) {
        $data = SQL::exec('SELECT * FROM friends WHERE submited = ? AND (receiver_id=? OR request_id=?)', [1, $id, $id], SQL::FETCHALL);
        $friends_ids = array();
        foreach ($data as $key => $value) {
            array_push($friends_ids, $value[$id == $value['receiver_id'] ? 'request_id' : 'receiver_id']);
        }
        return $friends_ids;
    }

    public static function getUnsubmittedIds($id) {
        $data = SQL::exec('SELECT * FROM friends WHERE submited = ? AND (receiver_id=? OR request_id=?)', [0, $id, $id], SQL::FETCHALL);
        $friends_ids = array();
        foreach ($data as $key => $value) {
            array_push($friends_ids, $value[$id == $value['receiver_id'] ? 'request_id' : 'receiver_id']);
        }
        return $friends_ids;
    }

    public static function unsubmittedCount($id) {
        return SQL::exec('SELECT COUNT(id) FROM friends WHERE submited=? AND receiver_id=? OR request_id=?', [0,$id, $id], SQL::COUNT);
    }

    public static function friendsCount($id) {
        return SQL::exec('SELECT COUNT(id) FROM friends WHERE submited=? AND receiver_id=? OR request_id=?', [1,$id, $id], SQL::COUNT);
    }

}

?>