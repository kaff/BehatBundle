<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\Behat\API\Context\LimitationParser;

use eZ\Publish\API\Repository\Values\User\Limitation;
use EzSystems\EzPlatformWorkflow\Value\Limitation\WorkflowTransitionLimitation;

class WorkflowTransitionLimitationParser implements LimitationParserInterface
{
    public function supports(string $limitationType): bool
    {
        return \in_array(strtolower($limitationType), ['workflowtransition', 'workflow transition']);
    }

    public function parse(string $limitationValues): Limitation
    {
        $limitations = explode(',', $limitationValues);

        return new WorkflowTransitionLimitation(
            ['limitationValues' => $limitations]
        );
    }
}
