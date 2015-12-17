<?php

use Cambalacheo\FormField\FormInputBasic;
use Cambalacheo\FormField\Decorator\Label;
use Cambalacheo\FormField\Decorator\Counter;

class LabelTest extends TestCase
{
    /** @test */
    public function an_input_field_text_should_be_returned_with_label()
    {
        $html = (new Label(new FormInputBasic))->build('test', [], $this->app['session.store']);

        $input = "<label for=\"test\" class=\"control-label\">Test: </label><input class=\"form-control\" name=\"test\" type=\"text\" id=\"test\">";

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_text_should_be_returned_with_label_and_counter()
    {
        $html = (new Label(new Counter(new FormInputBasic)))->build('test', [], $this->app['session.store']);

        $input = "<label for=\"test\" class=\"control-label\">Test: </label><div class='input-counter'><input class=\"form-control\" name=\"test\" type=\"text\" id=\"test\"><div class='small'><span id='counter-test'>0</span>/255</div></div>";

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_text_should_be_returned_with_label_custom()
    {
        $label = new Label(new FormInputBasic);
        $label->setArguments(['label' => 'Foo:']);
        $html = $label->build('bar', [], $this->app['session.store']);

        $input = '<label for="bar" class="control-label">Foo:</label><input class="form-control" name="bar" type="text" id="bar">';

        $this->assertEquals($input, $html);
    }
}