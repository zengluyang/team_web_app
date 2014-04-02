

<?php
/**
 * Created by PhpStorm.
 * User: ZLY
 * Date: 13-11-28
 * Time: 下午10:11
 */
class ResearchController extends Controller
{

    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    public function actionProject()
    {

    }

    public function actionInterest()
    {

    }
}