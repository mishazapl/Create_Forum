<?php

namespace liw\mvc\Model\Article;

class ArticleNews extends SettingArticle
{
    private $host  = 'localhost';
    private $user  = 'root';
    private $pass  = '';
    private $bd    = 'Article';
    private $mysqli;
    private $table = 'ArticleNews';
    private $headerArticle;
    private $article;
    private $creator;
    private $data;

    public function connectBD()
    {
        @$this->mysqli = new \mysqli($this->host,$this->user,$this->pass,$this->bd);

        if (mysqli_connect_errno()) {
            print 'Неизвестная ошибка на сайте.';
            exit();
        }
    }

    /**
     * @param $headerArticle
     * @param $article
     * @param $creator
     * @param $data
     *
     * Загрузка статей в бд.
     */

    public function prepareQuery($headerArticle, $article, $creator, $data)
    {
        $this->headerArticle = $this->mysqli->real_escape_string($headerArticle);
        $this->article       = $this->mysqli->real_escape_string($article);
        $this->creator       = $this->mysqli->real_escape_string($creator);
        $this->data          = $this->mysqli->real_escape_string($data);

        $this->sendData();
    }

    private function sendData()
    {
        $this->mysqli->query
        (
            "INSERT INTO `$this->table` 
        (
        `HeaderArticle`,
        `Article`,
        `Creator`,
        `Data`
        ) 
        VALUES 
        (
        \"$this->headerArticle\",
        \"$this->article\",
        \"$this->creator\",
        \"$this->data\"
        )"
        );
        $this->mysqli->close();
        header("Location: http://localhost/web/Article.php");
    }

    public function getArticle()
    {
        $this->article = $this->mysqli->query
        (
            "SELECT `HeaderArticle`, `Article`, `Creator`, `Data` 
             FROM `$this->table` ORDER BY `id` DESC LIMIT 5"
        );
        $this->article = $this->article->fetch_all(MYSQLI_ASSOC);
        $this->mysqli->close();
        return $this->article;
    }
}