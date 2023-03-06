<?php

declare(strict_types=1);

namespace oat\wiquid\migrations;

use Doctrine\DBAL\Schema\Schema;
use oat\tao\scripts\tools\migrations\AbstractMigration;
use oat\qtiItemPci\model\PciModel;
use oat\wiquid\scripts\install\RegisterPciblobIMS;
use oat\wiquid\scripts\install\RegisterPciblobOAT;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version202107081305304106_wiquid extends AbstractMigration
{

    public function getDescription(): string
    {
        return 'Restore the previous version of the Text Reader interaction';
    }

    public function up(Schema $schema): void
    {
        $registry = (new PciModel())->getRegistry();
        if ($registry->has('blobInteraction')) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $registry->removeAllVersions('blobInteraction');
        }

        $this->addReport(
            $this->propagate(
                new RegisterPciblobOAT()
            )(
                ['0.9.0']
            )
        );
        $this->addReport(
            $this->propagate(
                new RegisterPciblobIMS()
            )(
                ['1.0.0']
            )
        );

    }

    public function down(Schema $schema): void
    {
        $registry = (new PciModel())->getRegistry();
        if ($registry->has('blobInteraction')) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $registry->removeAllVersions('blobInteraction');
        }

        $this->addReport(
            $this->propagate(
                new RegisterPciblobIMS()
            )(
                ['1.0.0']
            )
        );
    }
}
