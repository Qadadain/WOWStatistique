<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720224915 extends AbstractMigration
{
    private const REGION_TABLE_NAME = 'region';
    private const REALM_TABLE_NAME = 'realm';

    public function up(Schema $schema): void
    {
        $region = $schema->createTable(name: self::REGION_TABLE_NAME);
        $region->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true]);
        $region->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $region->setPrimaryKey(['id']);

        $realm  = $schema->createTable(name: self::REALM_TABLE_NAME);
        $realm->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true]);
        $realm->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $realm->addColumn(name: 'region_id', typeName: Types::INTEGER, options: ['notnull' => false]);
        $realm->addForeignKeyConstraint(foreignTable: $region, localColumnNames: ['region_id'], foreignColumnNames: ['id']);
        $realm->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable(name: self::REGION_TABLE_NAME);
        $schema->dropTable(name: self::REALM_TABLE_NAME);
    }
}
