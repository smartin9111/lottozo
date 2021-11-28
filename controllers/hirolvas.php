<?php

class Hirolvas_Controller
{
    public $baseName = 'hirolvas';  //meghat�rozni, hogy melyik oldalon vagyunk
    public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
    {
        //bet�ltj�k a n�zetet
        {


            $model = new Hirolvas_Model;
            $getData = $model->getArticles();
            $regData = $model->saveArticle($vars);


            $view = new View_Loader($this->baseName . "_main");
            foreach ($getData as $name => $value) {
                $view->assign($name, $value);
            }
            foreach ($regData as $name => $value) {
                $view->assign($name, $value);
            }
        }
    }
}