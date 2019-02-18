<?php
/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\BehatBundle\API\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use EzSystems\BehatBundle\API\Facade\ContentTypeFacade;

class ContentTypeContext implements Context
{
    /** @var ContentTypeFacade  */
    private $contentTypeFacade;

    public function __construct(ContentTypeFacade $contentTypeFacade)
    {
        $this->contentTypeFacade = $contentTypeFacade;
    }

    /**
     * @Given I create a :contentTypeName Content Type with :contentTypeIdentifier identifier
     */
    public function iCreateAContentTypeWithIdentifier($contentTypeName, $contentTypeIdentifier, TableNode $fieldDetails): void
    {
        $fieldDefinitions = $this->parseFieldDefinitions($fieldDetails);

        $this->contentTypeFacade->createContentType($contentTypeName, $contentTypeIdentifier, $fieldDefinitions);
    }

    private function parseFieldDefinitions($fieldDetails)
    {
        return null;
    }
}