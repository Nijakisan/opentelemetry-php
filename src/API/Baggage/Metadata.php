<?php

declare(strict_types=1);

namespace OpenTelemetry\API\Baggage;

final class Metadata implements MetadataInterface
{
    private static ?self $instance = null;

    public static function getEmpty(): Metadata
    {
        return self::$instance ??= new self('');
    }

    public function __construct(private readonly string $metadata)
    {
    }

    #[\Override]
    public function getValue(): string
    {
        return $this->metadata;
    }
}
