<?php

namespace Netgen\Bundle\EzFormsBundle\Tests\Form\Type\FieldType;

use Netgen\Bundle\EzFormsBundle\Form\Type\FieldType\UserUpdateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints;

class UserUpdateTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testItExtendsAbstractType()
    {
        $updateUserType = new UserUpdateType(10);
        $this->assertInstanceOf(AbstractType::class, $updateUserType);
    }

    public function testBuildForm()
    {
        $formBuilder = $this->getMockBuilder(FormBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(array('add'))
            ->getMock();

        $emailOptions = array(
            'label' => 'E-mail address',
            'constraints' => array(
                new Constraints\NotBlank(),
                new Constraints\Email(),
            ),
        );

        $passwordConstraints[] = new Constraints\Length(
            array(
                'min' => 10,
            )
        );

        $passwordOptions = array(
            'type' => 'password',
            'required' => false,
            'invalid_message' => 'Both passwords must match.',
            'options' => array(
                'constraints' => $passwordConstraints,
            ),
            'first_options' => array(
                'label' => 'New password (leave empty to keep current password)',
            ),
            'second_options' => array(
                'label' => 'Repeat new password',
            ),
        );

        $formBuilder->expects($this->at(0))
            ->method('add')
            ->willReturn($formBuilder)
            ->with('email', 'email', $emailOptions);

        $formBuilder->expects($this->at(1))
            ->method('add')
            ->with('password', 'repeated', $passwordOptions);

        $userCreateType = new UserUpdateType(10);
        $userCreateType->buildForm($formBuilder, array());
    }

    public function testGetName()
    {
        $updateUserType = new UserUpdateType(10);
        $this->assertEquals('ezforms_ezuser_update', $updateUserType->getName());
    }
}
