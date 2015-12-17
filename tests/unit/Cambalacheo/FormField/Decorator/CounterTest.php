<?php

use Cambalacheo\FormField\FormInputBasic;
use Cambalacheo\FormField\Decorator\Counter;

class CounterTest extends TestCase
{
    /** @test */
    public function an_input_field_text_should_be_returned_with_counter()
    {
        $html = (new Counter(new FormInputBasic))->build('test', [], $this->app['session.store']);

        $input = "<div class='input-counter'><input class=\"form-control\" name=\"test\" type=\"text\"><div class='small'><span id='counter-test'>0</span>/255</div></div>";

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_text_should_be_returned_with_counter_max()
    {
        $formField = new Counter(new FormInputBasic);
        $formField->setArguments(['max' => 1]);

        $html = $formField->build('test', [], $this->app['session.store']);

        $input = "<div class='input-counter'><input class=\"form-control\" name=\"test\" type=\"text\"><div class='small'><span id='counter-test'>0</span>/1</div></div>";

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_text_should_pass_arguments_to_decorator_an_input()
    {
        $formField = new Counter(new FormInputBasic);
        $formField->setArguments(['max' => 60]);

        $html = $formField->build('test', ['foo' => 'bar'], $this->app['session.store']);

        $input = "<div class='input-counter'><input class=\"form-control\" foo=\"bar\" name=\"test\" type=\"text\"><div class='small'><span id='counter-test'>0</span>/60</div></div>";

        $this->assertEquals($input, $html);
    }
}