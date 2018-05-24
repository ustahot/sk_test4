<?php

require_once 'Views/NewsView.php';
require_once 'Model/NewsModel.php';


class MainController
{
    /**
     * @param $date
     */
    static public function showOnDate($date)
    {
        $insertTs = strtotime($date);
        $newsOnDate = NewsModel::getOnDate($date);

        $newsData = array();
        foreach ($newsOnDate as $news){
            $objNews = NewsModel::find($news['id']);
            array_push(
                $newsData
                , array(
                    'title' => $objNews->getTitle(),
                    'announcements' => $objNews->announcements()
                )
            );
        }

        NewsView::make(
            array(
                'news_data' => $newsData,
                'insert_ts' => $insertTs,
            )
        );

    }
}