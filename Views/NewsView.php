<?php

class NewsView
{
    /**
     * Осуществляет вывод результата
     * @param $data - массив новостей, включая анонсы
     */
    static public function make($data)
    {

        foreach ($data['news_data'] as $news){

            echo '<br> News ' . htmlspecialchars($news['title']) . ":" . "\n";

            foreach ($news['announcements'] as $announce){
                echo htmlspecialchars($announce['text']) . "\n";
                //echo $announce['text'] . "\n";

                // сдедующие if и echo можно было бы упразнить, если реализовать анализ значения $announce['is_new']
                // в модели News. Это позводидо бы уменьшить вложенность управляющих струтур кода, но модель стала бы
                // значительно нагруженнее. Думаю, вреда получилось бы больше, чем пользы.
                if ($announce['is_new']) {
                    $mainItem = $announce;
                }

            }

            echo 'Main news item: ' . htmlspecialchars($mainItem['id']) . "\n";

        }

        echo '<br>' . date('Y-m-d H:i:s', $data['insert_ts']);

    }

}