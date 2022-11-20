<?php

namespace App\Tests\Feature;

use App\Infrastructure\Model\StateModel;
use App\Infrastructure\Repository\StateRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameApplicationTest extends WebTestCase
{
    public function testLetterIsGuesed()
    {
        $client = static::createClient();

        $container = static::getContainer();
        $stateRepository = $this->createMock(StateRepositoryInterface::class);
        $stateRepository->expects(self::once())
            ->method('find')
            ->willReturn(new StateModel(['masked' => '__', 'secret' => 'hi']))
        ;
        $container->set(StateRepositoryInterface::class, $stateRepository);

        $client->request('GET', '/turn?letter=h');
        $response = $client->getResponse()->getContent();

        $array = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        $this->assertSame($array, ['masked_word' => "h _"]);
        $this->assertResponseIsSuccessful();
    }
}
