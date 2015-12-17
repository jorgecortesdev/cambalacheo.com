<?php

use Mockery as m;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Cambalacheo\FormField\FormInputBasic;
use Cambalacheo\FormField\Decorator\Error;

class ErrorTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /** @test */
    public function an_input_field_text_should_have_an_error_block()
    {
        $viewErrorBag = (new ViewErrorBag)->put('default', new MessageBag(['foo' => 'bar']));

        $session = m::mock('Illuminate\Session\Store');
        $session->shouldReceive('get')
            ->once()
            ->with('errors')
            ->andReturn($viewErrorBag);

        $html = (new Error(new FormInputBasic))->build('foo', [], $session);

        $input = '<input class="form-control" name="foo" type="text"><span class="help-block">* bar</span>';

        $this->assertEquals($input, $html);
    }

    /** @test */
    public function an_input_field_text_should_not_have_an_error_block()
    {
        $session = m::mock('Illuminate\Session\Store');
        $session->shouldReceive('get')
            ->once()
            ->with('errors')
            ->andReturn(null);

        $html = (new Error(new FormInputBasic))->build('foo', [], $session);

        $input = '<input class="form-control" name="foo" type="text">';

        $this->assertEquals($input, $html);
    }
}