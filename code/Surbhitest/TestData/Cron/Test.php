<?php
namespace Surbhitest\TestData\Cron;

use Psr\Log\LoggerInterface;

class Test {
    protected $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function execute() {
        $this->logger->info('Cron is Working');
    }
}