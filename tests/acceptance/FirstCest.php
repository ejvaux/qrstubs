<?php

use \Codeception\Util\HttpCode;

class FirstCest
{
    private $userUsername = 'P000199';
    private $userPassword = '12345678';
    private $canteenUsername = 'canteen01';
    private $canteenPassword = 'ctn123456';

    public function _before(AcceptanceTester $I)
    {

    }

    // tests
    public function TestLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $this->_login($I,$this->userUsername,$this->userPassword);
        $I->seeInCurrentUrl('/user');
        $I->see('P000199');
        $I->see('EJ Mati');
        $I->click('EJ Mati');
        $I->see('Sign Out');
        $I->click('Sign Out');
        $I->seeInCurrentUrl('/login');
    }

    public function TestScan(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $this->_login($I,$this->canteenUsername,$this->canteenPassword);
        $I->seeInCurrentUrl('/canteen');
        $this->_scanQr($I);
        $I->waitForText('Transaction Request Sent',5);
        $this->_scanQr($I);
        $I->waitForText('Please ask the employee to confirm the Pending Transactions first.',5);
        $I->see('OK');
        $I->click('OK');
    }

    public function TestConfirm(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $this->_login($I,$this->userUsername,$this->userPassword);
        $this->_confirm($I);
    }

    public function TestCancel(AcceptanceTester $I)
    {
        $this->TestScan($I);
        $this->_cancel($I);
    }

    public function TestContact(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $this->_login($I,$this->userUsername,$this->userPassword);
        $I->seeInCurrentUrl('/user');
        $this->_contact($I);
    }

    public function TestFAQ(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $this->_login($I,$this->userUsername,$this->userPassword);
        $I->seeInCurrentUrl('/user');
        $this->_faq($I);
    }

    public function TestUserTransactionsPage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $this->_login($I,$this->userUsername,$this->userPassword);
        $I->seeInCurrentUrl('/user');
        $this->_transactions($I);
    }

    public function TestCanteenTransactionsPage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $this->_login($I,$this->canteenUsername,$this->canteenPassword);
        $I->seeInCurrentUrl('/canteen');
        $this->_transactions($I);
    }

    public function _login(AcceptanceTester $I,$uname,$pass)
    {
        $I->amOnPage('/login');
        $I->fillField('Username',$uname);
        $I->fillField('Password',$pass);
        $I->click('//button[@type="submit"]');
    }

    public function _scanQr(AcceptanceTester $I)
    {
        $I->waitForText('SCAN',5);
        $I->click('//button[@id="scanqrBtn"]');
        $I->waitForElementVisible('//input[@name="amount"]',5);
        $I->fillField('//input[@name="amount"]','10');
        $I->click('//button[@id="transactBtn"]');
        $I->waitForElementVisible('//button[contains(text(),"Confirm")]',5);
        $I->click('//button[contains(text(),"Confirm")]');
        //$I->click('//button[contains(text(),"Confirm")]');
    }

    public function _confirm(AcceptanceTester $I)
    {
        $I->seeInCurrentUrl('/user');
        $I->waitForText('Confirm',5);
        $I->click('Confirm');
        $I->waitForText('Yes, proceed',5);
        $I->click('Yes, proceed');
        $I->waitForText('Accepted',5);
    }

    public function _cancel(AcceptanceTester $I)
    {
        $I->waitForText('Cancel',5);
        $I->click('Cancel');
        $I->waitForText('Yes, proceed',5);
        $I->click('Yes, proceed');
        $I->waitForText('Cancelled',5);
    }

    public function _contact(AcceptanceTester $I)
    {
        $I->waitForText('Contact Us',5);
        $I->click('Contact Us');
        $I->waitForText('Contact Information',5);
        $I->waitForText('Close',5);
        $I->click('Close', '#questionModal');
    }

    public function _transactions(AcceptanceTester $I)
    {
        $I->waitForText('Transactions',5);
        $I->click('Transactions');
        $I->waitForText('ID NO',5);
        $I->waitForText('Home',5);
        $I->click('Home');
    }

    public function _faq(AcceptanceTester $I)
    {
        $I->waitForText('FAQ',5);
        $I->click('FAQ');
        $I->waitForText('Frequently Asked Questions',5);
        $I->waitForText('Home',5);
        $I->click('Home');
    }
}
