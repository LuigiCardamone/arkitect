<?php
declare(strict_types=1);

namespace Arkitect\Rules;

use Arkitect\Expression\Expression;
use Arkitect\Rules\DSL\AndThatShouldParser;
use Arkitect\Rules\DSL\BecauseParser;

class AndThatShould implements AndThatShouldParser
{
    private RuleBuilder $ruleBuilder;

    public function __construct(RuleBuilder $expressionBuilder)
    {
        $this->ruleBuilder = $expressionBuilder;
    }

    public function andThat(Expression $expression): AndThatShouldParser
    {
        $this->ruleBuilder->addThat($expression);

        return $this;
    }

    public function should(Expression $expression): BecauseParser
    {
        $this->ruleBuilder->addShould($expression);

        return new Because($this->ruleBuilder);
    }

    public function shouldNot(Expression $expression): BecauseParser
    {
        $this->ruleBuilder->addShouldNot($expression);

        return new Because($this->ruleBuilder);
    }
}
