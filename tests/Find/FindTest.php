<?php
/**
 * Created by PhpStorm.
 * User: Honza
 */

namespace App\Tests\Find;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class FindTest
 * @package App\Tests\Find
 */
class FindTest extends WebTestCase
{
    public function testFindIndex()
    {
        $this->client = self::createClient();

        $this->client->request('GET', '/Customer/find');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->assertContains(
            'Vyhledání zákazníka',
            $this->client->getResponse()->getContent()
        );
    }

    public function testFindingCustomer()
    {
        $this->client = self::createClient();

        $crawler = $this->client->request('GET', '/Customer/find');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $form = $crawler->selectButton('Vyhledat')->form();

        $form['find_customer_form[name]']->setValue('1');
        $this->client->submit($form);
        $this->assertContains(
            'Zákazník nenalezen',
            $this->client->getResponse()->getContent()
        );

        $form['find_customer_form[name]']->setValue('Jan');
        $this->client->submit($form);

        $this->assertContains(
            'Zákazník nalezen',
            $this->client->getResponse()->getContent()
        );

        $form['find_customer_form[name]']->setValue('');
        $form['find_customer_form[surname]']->setValue('Zajíc');
        $this->client->submit($form);

        $this->assertContains(
            'Zákazník nalezen',
            $this->client->getResponse()->getContent()
        );

        $form['find_customer_form[surname]']->setValue('');
        $form['find_customer_form[idc]']->setValue('123');
        $this->client->submit($form);

        $this->assertContains(
            'Zákazník nalezen',
            $this->client->getResponse()->getContent()
        );
    }
}