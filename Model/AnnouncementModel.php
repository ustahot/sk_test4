<?php

class AnnouncementModel
{

    /**
     * Возвращает массив анонсов к конкретной новости
     * @param $itemId
     * @return array
     */
    static public function getOnNews($itemId)
    {
        $sql = "SELECT * FROM announce WHERE item_id = :item_id ";

        if (!$st = Cfg::getDB()->prepare($sql)) {
            die('Не удалось подготовить запрос на поиск анонсов!');
        }

        $st->bindParam(':item_id', $itemId, PDO::PARAM_STR);

        if (!$st->execute()) {
            die('Не удалось выполнить запрос на поиск новостей!');
        }

        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

}
