<?php

declare(strict_types=1);

namespace OpenTelemetry\SDK\Logs\Processor;

use OpenTelemetry\Context\ContextInterface;
use OpenTelemetry\SDK\Common\Future\CancellationInterface;
use OpenTelemetry\SDK\Logs\LogRecordExporterInterface;
use OpenTelemetry\SDK\Logs\LogRecordProcessorInterface;
use OpenTelemetry\SDK\Logs\ReadWriteLogRecord;

class SimpleLogRecordProcessor implements LogRecordProcessorInterface
{
    public function __construct(private readonly LogRecordExporterInterface $exporter)
    {
    }

    /**
     * @see https://github.com/open-telemetry/opentelemetry-specification/blob/main/specification/logs/sdk.md#onemit
     */
    #[\Override]
    public function onEmit(ReadWriteLogRecord $record, ?ContextInterface $context = null): void
    {
        $this->exporter->export([$record]);
    }

    #[\Override]
    public function shutdown(?CancellationInterface $cancellation = null): bool
    {
        return $this->exporter->shutdown($cancellation);
    }

    #[\Override]
    public function forceFlush(?CancellationInterface $cancellation = null): bool
    {
        return $this->exporter->forceFlush($cancellation);
    }
}
