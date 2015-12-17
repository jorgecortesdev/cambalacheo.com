<?php

use Cambalacheo\FormField\FormInputBasic;

class FormInputBasicTest extends TestCase
{
    /** @test */
    public function an_input_field_text_should_be_returned()
    {
        $html = (new FormInputBasic)->build('test', [], $this->app['session.store']);

        $input = '<input class="form-control" name="test" type="text">';

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_with_attributes_should_be_returned()
    {
        $html = (new FormInputBasic)->build('test', ['foo' => 'bar'], $this->app['session.store']);

        $input = '<input class="form-control" foo="bar" name="test" type="text">';

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_guessed_type_should_be_returned()
    {
        $html = (new FormInputBasic)->build('description', [], $this->app['session.store']);

        $input = '<textarea class="form-control" name="description" cols="50" rows="10"></textarea>';

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_custom_type_should_be_returned()
    {
        $html = (new FormInputBasic)->build('custom', ['type' => 'password'], $this->app['session.store']);

        $input = '<input class="form-control" type="password" name="custom" value="">';

        $this->assertEquals($input, $html);
    }
}