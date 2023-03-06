<?php

declare(strict_types=1);

namespace oat\wiquid\migrations;

use Doctrine\DBAL\Schema\Schema;
use oat\tao\scripts\tools\migrations\AbstractMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;
use oat\qtiItemPci\model\PciModel;
use oat\wiquid\scripts\install\RegisterPciblobIMS;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version202103160949554106_wiquid extends AbstractMigration
{

    public function getDescription(): string
    {
        return 'Convert Text Reader interaction to IMS compliant';
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
                new RegisterPciblobIMS()
            )(
                ['1.0.0']
            )
        );
    }

    public function down(Schema $schema): void
    {
        throw new IrreversibleMigration(
            'In order to undo this migration, please revert the client-side changes and run ' . RegisterPciblobIMS::class
        );
    }
}
