<?php
class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('/backend/default/login');
    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('登录', 'button');

    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(100);
        $I->amOnPage('/backend/default/index');
        $I->see('退出');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs(\app\modules\backend\models\AdminUserIdentity::findByUsername('admin'));
        $I->amOnPage('/backend/default/index');
        $I->see('退出');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('用户名不能为空');
        $I->see('密码不能为空');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'demo',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'demo',
            'LoginForm[password]' => 'demo',
        ]);
        $I->see('退出');
        $I->see('<span class="hidden-xs">admin</span>');
//        $I->dontSeeElement('<span class="hidden-xs">admin</span>');
    }
}