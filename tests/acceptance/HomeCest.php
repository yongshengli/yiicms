<?php
use yii\helpers\Url as Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));        
        $I->see('YiiCms企业系统');
        
        $I->seeLink('首页');
        $I->click('关于我们');
        $I->wait(2); // wait for page to be opened
        
//        $I->see('This is the About page.');
    }
}
