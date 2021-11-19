<?php
include('UserDao.php');

echo dirname(__FILE__);

function dd($o, $title = null){
    echo "<hr>";
    echo "<strong>".$title."</strong>";
    echo "<pre>";
    print_r($o);
    echo "</pre>";
}
echo "<hr>";
echo md5('123123');
echo "<hr>";

$dao = new UserDao();


dd($dao->list(), 'list()');

$user1 = $dao->get(2);
dd($user1, 'get(1)');


$newUser = new User('rhayati', 'zakaria', 'rhayatizakaria@gmail.com', '2020-20-20', '123123', '1');
dd($newUser, '$newUser');
echo 'HELLO', $newUser->getNom('nom');


dd($lastId = $dao->create($newUser), 'create($newUser) .. Last inserted id :');
dd($dao->list(), 'list()');


dd($dao->delete($lastId), 'delete($lastId)');


