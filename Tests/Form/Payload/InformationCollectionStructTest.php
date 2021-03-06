<?php

namespace Netgen\Bundle\EzFormsBundle\Tests\Form\Payload;

use Netgen\Bundle\EzFormsBundle\Form\Payload\InformationCollectionStruct;

class InformationCollectionStructTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCollectedFieldValue()
    {
        $struct = new InformationCollectionStruct();
        $struct->setCollectedFieldValue('some_field', 'some_value');

        $this->assertEquals('some_value', $struct->getCollectedFieldValue('some_field'));
        $this->assertEquals(null, $struct->getCollectedFieldValue('some_field_not_existing'));
    }

    public function testGetCollectedFields()
    {
        $fields = array(
            'some_field_1' => 'some_value_1',
            'some_field_2' => 'some_value_2',
        );

        $struct = new InformationCollectionStruct();
        $struct->setCollectedFieldValue('some_field_1', 'some_value_1');
        $struct->setCollectedFieldValue('some_field_2', 'some_value_2');

        $this->assertEquals($fields, $struct->getCollectedFields());
    }
}
