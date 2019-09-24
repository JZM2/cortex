<?php
/**
 * Created by PhpStorm.
 * User: Honza
 */

namespace App\Tests\Find;

use http\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class FindTest
 * @package App\Tests\Find
 */
class FindTest extends WebTestCase
{
    /** @var Client $client */
    private $client;

    protected function setUp()
    {
        $this->client = self::createClient();
    }

    public function testFindIndex()
    {
        $this->client->request('GET', '/Customer/find');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->assertContains(
            'Vyhledání zákazníka',
            $this->client->getResponse()->getContent()
        );
    }

    public function testFindingCustomer()
    {
        $crawler = $this->client->request('GET', '/Customer/find');

        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Vyhledat')->form();

        $this->client->submit($form);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        /*
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
        */
    }

    public function testReport()
    {
        $crawler = $this->client->request('GET', '/Report');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertContains(
            'Report',
            $this->client->getResponse()->getContent()
        );
    }
}