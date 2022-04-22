<?php

use App\CustomFunctions;
use App\credit as Credit;
use \Codeception\Util\HttpCode;
use App\User;

class TransactionCest
{
    private $credit;
    private $user;
    private $UserPassword = '12345678';
    private $canteenUsername = 'canteen01';
    private $canteenPassword = 'ctn123456';

    public function _before(FunctionalTester $I)
    {
        $this->_getUser();
        $I->assertNotNull($this->user);
        $this->_getCredit();
        if (!$this->credit) {
            $this->_insertCredit();
        }
        $I->assertNotNull($this->credit);
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $this->_loginCanteen($I);
        $this->_scanQr($I);
        $I->see('Transaction Request Sent');
        $this->_scanQr($I);
        $I->see('Please ask the employee to confirm the Pending Transactions first.');
        $this->_logout($I);
        $this->_loginUser($I);
        $this->_confirm($I);
    }

    public function _insertCredit()
    {
        $c = new Credit;
        $c->user_id = $this->user->id;
        $c->control_no = CustomFunctions::generateControlNum();
        $c->amount = 4200;
        $c->save();
    }

    public function _getCredit()
    {
        $this->credit = Credit::where('control_no',CustomFunctions::generateControlNum())->where('user_id',$this->user->id)->first();
    }

    public function _getUser()
    {
        $this->user = User::find(46);
    }

    public function _loginCanteen(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeInCurrentUrl('/login');
        $I->fillField('Username', $this->canteenUsername);
        $I->fillField('Password', $this->canteenPassword);
        $I->click('Login','.btn');
        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function _loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeInCurrentUrl('/login');
        $I->fillField('Username', $this->user->uname);
        $I->fillField('Password', $this->UserPassword);
        $I->click('Login','.btn');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeInCurrentUrl('/user');
    }

    public function _scanQr(FunctionalTester $I)
    {
        $I->seeInCurrentUrl('/canteen');
        $I->sendAjaxPostRequest('/transact', [
            'userId' => $this->user->id,
            'ctrl' => $this->credit->control_no,
            'amount' => 10,
            '_token' => csrf_token(),
        ]);
    }

    public function _logout(FunctionalTester $I)
    {
        $I->submitForm('#logout-form',[]);
        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function _confirm(FunctionalTester $I)
    {
        $I->see('Confirm');
    }
}
