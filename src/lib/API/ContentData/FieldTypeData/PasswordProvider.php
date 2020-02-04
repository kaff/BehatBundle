<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\Behat\API\ContentData\FieldTypeData;

class PasswordProvider extends AbstractFieldTypeDataProvider
{
    public const DEFAUlT_PASSWORD = 'Passw0rd-42';

    public function supports(string $fieldTypeIdentifier): bool
    {
        return $fieldTypeIdentifier === 'password';
    }

    public function generateData(string $contentTypeIdentifier, string $fieldIdentifier, string $language = 'eng-GB'): string
    {
        return self::DEFAUlT_PASSWORD;
    }
}
