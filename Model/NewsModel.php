<?php

require_once 'Classes/Cfg.php';
require_once 'Model/AnnouncementModel.php';

class NewsModel
{

    private $id;
    private $title;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Возвращает Объект Новости по её ID
     * @param $id
     * @return NewsModel
     */
    static public function find($id)
    {
        $sql = "SELECT * FROM news WHERE id = :id ";

        if (!$st = Cfg::getDB()->prepare($sql)) {
            die('Не удалось подготовить запрос на поиск новости!');
        }

        $st->bindParam(':id', $id, PDO::PARAM_INT);

        if (!$st->execute()) {
            die('Не удалось выполнить запрос на поиск новости!');
        }

        if (!$result = $st->fetch(PDO::FETCH_ASSOC)){
            die('Не найдена новость с id ' . $id);
        }

        $news = new self();
        $news->setId((int) $result['id']);
        $news->setTitle($result['title']);

        return $news;

    }


    /**
     * Возвращает все новости на конкретную дату
     * @param $date
     * @return array
     */
    static public function getOnDate($date)
    {
        $sql = "SELECT n.*, n.insert uu FROM news n WHERE DATE(n.insert) = :date ";

        if (!$st = Cfg::getDB()->prepare($sql)) {
            die('Не удалось подготовить запрос на поиск новостей!');
        }

        $st->bindParam(':date', $date, PDO::PARAM_STR);

        if (!$st->execute()) {
            die('Не удалось выполнить запрос на поиск новостей!');
        }


        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает все анонсы к текущей новости
     * @return array
     */
    public function announcements()
    {
        $result = AnnouncementModel::getOnNews($this->getId());
        return $result;
    }

}
