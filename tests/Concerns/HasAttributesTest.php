<?php

namespace Esign\Seo\Tests\Concerns;

use Esign\Seo\Tests\TestCase;

class HasAttributesTest extends TestCase
{
    /** @test */
    public function it_can_set_an_attribute()
    {
        $testTag = new TestTag();
        $testTag->set('key', 'value');

        $this->assertEquals('value', $testTag->get('key'));
    }

    /** @test */
    public function it_can_get_an_attribute()
    {
        $testTag = new TestTag();
        $testTag->set('key', 'value');

        $this->assertEquals('value', $testTag->get('key'));
    }

    /** @test */
    public function it_can_return_null_if_getting_an_attribute_that_has_not_been_set()
    {
        $testTag = new TestTag();

        $this->assertNull($testTag->get('key'));
    }

    /** @test */
    public function it_can_return_a_default_value_if_given_one()
    {
        $testTag = new TestTag();

        $this->assertEquals('default value', $testTag->get('key', 'default value'));
    }

    /** @test */
    public function it_can_mutate_an_attribute()
    {
        $testTag = new TestTag();
        $testTag->set('title', 'value');

        $this->assertEquals('value - Suffix', $testTag->get('title'));
    }

    /** @test */
    public function it_can_set_a_raw_attribute()
    {
        $testTag = new TestTag();
        $testTag->setRaw('title', 'value');

        $this->assertEquals('value', $testTag->get('title'));
    }

    /** @test */
    public function it_can_check_if_an_attribute_exists()
    {
        $testTag = new TestTag();
        $testTag->set('keyA', 'value');

        $this->assertTrue($testTag->has('keyA'));
        $this->assertFalse($testTag->has('keyB'));
    }

    /** @test */
    public function it_can_do_stuff_conditionally()
    {
        $testTag = new TestTag();
        $testTag->when(true, fn (TestTag $testTag) => $testTag->set('key', 'value A'));
        $testTag->when(false, fn (TestTag $testTag) => $testTag->set('key', 'value B'));

        $this->assertEquals('value A', $testTag->get('key'));
    }

    /** @test */
    public function it_can_do_stuff_conditionally_when_empty()
    {
        $testTag = new TestTag();
        $testTag->whenEmpty('key', fn (TestTag $testTag) => $testTag->set('key', 'value A'));
        $testTag->whenEmpty('key', fn (TestTag $testTag) => $testTag->set('key', 'value B'));

        $this->assertEquals('value A', $testTag->get('key'));
    }
}
