<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20220720224915 extends AbstractMigration
{
    private const REGION_TABLE_NAME = 'region';
    private const REALM_TABLE_NAME = 'realm';
    private const GENDER_TABLE_NAME = 'gender';
    private const RACE_TABLE_NAME = 'race';
    private const CLASSE_TABLE_NAME = 'classe';
    private const CHARACTER_TABLE_NAME = 'character';

    public function up(Schema $schema): void
    {
        $region = $schema->createTable(name: self::REGION_TABLE_NAME);
        $region->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement' => true]);
        $region->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $region->setPrimaryKey(['id']);

        $realm = $schema->createTable(name: self::REALM_TABLE_NAME);
        $realm->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement' => true]);
        $realm->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $realm->addColumn(name: 'region_id', typeName: Types::INTEGER, options: ['notnull' => true]);
        $realm->addForeignKeyConstraint(foreignTable: $region, localColumnNames: ['region_id'], foreignColumnNames: ['id']);
        $realm->setPrimaryKey(['id']);

        $gender = $schema->createTable(name: self::GENDER_TABLE_NAME);
        $gender->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement' => true,]);
        $gender->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $gender->setPrimaryKey(['id']);

        $race = $schema->createTable(name: self::RACE_TABLE_NAME);
        $race->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement' => true,]);
        $race->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $race->setPrimaryKey(['id']);

        $classe = $schema->createTable(name: self::CLASSE_TABLE_NAME);
        $classe->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement' => true,]);
        $classe->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $classe->setPrimaryKey(['id']);

        $character = $schema->createTable(name: self::CHARACTER_TABLE_NAME);
        $character->addColumn(name: 'id', typeName: Types::INTEGER, options: ['notnull' => true, 'autoincrement' => true,]);
        $character->addColumn(name: 'name', typeName: Types::STRING, options: ['notnull' => true, 'length' => 255]);
        $character->addColumn(name: 'realm_id', typeName: Types::INTEGER, options: ['notnull' => true, 'length' => 255]);
        $character->addColumn(name: 'gender_id', typeName: Types::INTEGER, options: ['notnull' => true, 'length' => 255]);
        $character->addColumn(name: 'race_id', typeName: Types::INTEGER, options: ['notnull' => true, 'length' => 255]);
        $character->addColumn(name: 'classe_id', typeName: Types::INTEGER, options: ['notnull' => true, 'length' => 255]);
        $character->addColumn(name: 'region_id', typeName: Types::INTEGER, options: ['notnull' => true]);
        $character->addForeignKeyConstraint(foreignTable: $realm, localColumnNames: ['realm_id'], foreignColumnNames: ['id']);
        $character->addForeignKeyConstraint(foreignTable: $gender, localColumnNames: ['gender_id'], foreignColumnNames: ['id']);
        $character->addForeignKeyConstraint(foreignTable: $race, localColumnNames: ['race_id'], foreignColumnNames: ['id']);
        $character->addForeignKeyConstraint(foreignTable: $classe, localColumnNames: ['classe_id'], foreignColumnNames: ['id']);
        $character->addForeignKeyConstraint(foreignTable: $region, localColumnNames: ['region_id'], foreignColumnNames: ['id']);
        $character->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(name: self::REGION_TABLE_NAME);
        $schema->dropTable(name: self::REALM_TABLE_NAME);
        $schema->dropTable(name: self::GENDER_TABLE_NAME);
        $schema->dropTable(name: self::RACE_TABLE_NAME);
        $schema->dropTable(name: self::CLASSE_TABLE_NAME);
        $schema->dropTable(name: self::CHARACTER_TABLE_NAME);
    }
}
