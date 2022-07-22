<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220722214527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, realm_id INT NOT NULL, gender_id INT NOT NULL, race_id INT NOT NULL, classe_id INT NOT NULL, faction_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_937AB03498260155 (region_id), INDEX IDX_937AB0349DFF5F89 (realm_id), INDEX IDX_937AB034708A0E0 (gender_id), INDEX IDX_937AB0346E59D40D (race_id), INDEX IDX_937AB0348F5EA509 (classe_id), INDEX IDX_937AB0344448F8DA (faction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture_path VARCHAR(255) DEFAULT NULL, wow_id VARCHAR(75) NOT NULL, UNIQUE INDEX UNIQ_8F87BF96D36FF841 (wow_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, wow_id VARCHAR(75) NOT NULL, UNIQUE INDEX UNIQ_83048B90D36FF841 (wow_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, wow_id VARCHAR(255) NOT NULL, picture_path VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C7470A42D36FF841 (wow_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, wow_id VARCHAR(75) NOT NULL, picture_path VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_DA6FBBAFD36FF841 (wow_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realm (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FA96DBDA98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03498260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0349DFF5F89 FOREIGN KEY (realm_id) REFERENCES realm (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB034708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0346E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0348F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB0344448F8DA FOREIGN KEY (faction_id) REFERENCES faction (id)');
        $this->addSql('ALTER TABLE realm ADD CONSTRAINT FK_FA96DBDA98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0348F5EA509');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0344448F8DA');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB034708A0E0');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0346E59D40D');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB0349DFF5F89');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03498260155');
        $this->addSql('ALTER TABLE realm DROP FOREIGN KEY FK_FA96DBDA98260155');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE faction');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE realm');
        $this->addSql('DROP TABLE region');
    }
}
