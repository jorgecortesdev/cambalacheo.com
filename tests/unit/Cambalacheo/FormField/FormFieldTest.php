<?php

class FormFieldTest extends TestCase
{
    /** @test */
    public function it_should_return_a_basic_input_email()
    {
        $html = FormField::email();

        $input = '<input class="form-control" name="email" type="email">';

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function it_should_return_a_basic_input_text_with_label()
    {
        $html = FormField::with('label')->text();

        $input = '<label for="text" class="control-label">Text: </label><input class="form-control" name="text" type="text" id="text">';

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function two_instances_should_be_different()
    {
        $one = FormField::with('label')->text();
        $two = FormField::text();

        $this->assertNotEquals($one, $two);
    }

    /** @test */
    public function a_call_to_with_should_accept_arguments_as_arrays()
    {
        $html = FormField::with(['counter' => ['max' => 50]], 'label')->name();

        $input = "<label for=\"name\" class=\"control-label\">Name: </label><div class='input-counter'><input class=\"form-control\" name=\"name\" type=\"text\" id=\"name\"><div class='small'><span id='counter-name'>0</span>/50</div></div>";

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_text_should_pass_arguments_and_array_of_arguments_using_formfield_facade()
    {
        $html = FormField::with(['counter' => [
                'max'     => 1,
                'wrapper' => ['class' => 'foobar']
            ]]
        )->text();

        $input = "<div class='foobar'><input class=\"form-control\" name=\"text\" type=\"text\"><div class='small'><span id='counter-text'>0</span>/1</div></div>";

        $this->assertEquals($input, $html);
    }
}