<?php
/**
 * Created by PhpStorm.
 * User: Honza
 */

namespace App\Tests\Registration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationTest extends WebTestCase
{
    private $client = null;

    /**
     * @dataProvider getUrls
     */
    public function testIndex($url)
    {
        $this->client = self::createClient();

        $this->client->request('GET', $url);

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function getUrls()
    {
        $url = [
            ['/'],
        ];

        return $url;
    }
}