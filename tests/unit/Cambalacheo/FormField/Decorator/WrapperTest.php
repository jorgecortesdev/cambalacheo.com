<?php

use Cambalacheo\FormField\FormInputBasic;
use Cambalacheo\FormField\Decorator\Wrapper;

class WrapperTest extends TestCase
{
    /** @test */
    public function an_input_field_text_should_be_returned_with_wrapper()
    {
        $html = (new Wrapper(new FormInputBasic))->build('test', [], $this->app['session.store']);

        $input = "<div class='form-group'><input class=\"form-control\" name=\"test\" type=\"text\"></div>";

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_text_should_be_returned_with_wrapper_custom()
    {
        $wrapper = new Wrapper(new FormInputBasic);
        $wrapper->setArguments(['element' => 'span', 'class' => 'foo']);

        $html = $wrapper->build('test', [], $this->app['session.store']);

        $input = "<span class='foo'><input class=\"form-control\" name=\"test\" type=\"text\"></span>";

        $this->assertEquals($input, $html);
    }
}