<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\Behat\API\Facade;

use EzSystems\Behat\API\ContentData\FieldTypeNameConverter;
use eZ\Publish\API\Repository\ContentTypeService;
use eZ\Publish\API\Repository\Exceptions\NotFoundException;

class ContentTypeFacade
{
    /** @var \eZ\Publish\API\Repository\ContentTypeService */
    private $contentTypeService;

    public function __construct(ContentTypeService $contentTypeService)
    {
        $this->contentTypeService = $contentTypeService;
    }

    public function createContentType(string $contentTypeName, string $contentTypeIdentifier, string $contentTypeGroupName, string $mainLanguageCode, bool $isContainer, array $fieldDefinitions)
    {
        $contentTypeCreateStruct = $this->contentTypeService->newContentTypeCreateStruct($contentTypeIdentifier);
        $contentTypeCreateStruct->names = [$mainLanguageCode => $contentTypeName];
        $contentTypeCreateStruct->mainLanguageCode = $mainLanguageCode;
        $contentTypeCreateStruct->isContainer = $isContainer;
        $contentTypeCreateStruct->nameSchema = $this->getNameSchema($fieldDefinitions);

        foreach ($fieldDefinitions as $definition) {
            $contentTypeCreateStruct->addFieldDefinition($definition);
        }

        $contentTypeGroup = $this->contentTypeService->loadContentTypeGroupByIdentifier($contentTypeGroupName);

        $contentTypeDraft = $this->contentTypeService->createContentType($contentTypeCreateStruct, [$contentTypeGroup]);
        $this->contentTypeService->publishContentTypeDraft($contentTypeDraft);
    }

    public function contentTypeExists(string $contentTypeIdentifier): bool
    {
        try {
            $this->contentTypeService->loadContentTypeByIdentifier($contentTypeIdentifier);

            return true;
        } catch (NotFoundException $e) {
            return false;
        }
    }

    public function getFieldTypeIdentifierByName(string $fieldtypeName): string
    {
        return FieldTypeNameConverter::getFieldTypeIdentifierByName($fieldtypeName);
    }

    private function getNameSchema(array $fieldDefinitions): string
    {
        $fieldDefinitionIdentifiers = array_column($fieldDefinitions, 'identifier');

        return sprintf('<%s>', implode('|', $fieldDefinitionIdentifiers));
    }
}
