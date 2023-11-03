<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005183827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menage DROP FOREIGN KEY FK_D1F20C8ACA808475');
        $this->addSql('DROP INDEX IDX_D1F20C8ACA808475 ON menage');
        $this->addSql('ALTER TABLE menage DROP membre_menage_id');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFCA808475');
        $this->addSql('DROP INDEX IDX_FCEC9EFCA808475 ON personne');
        $this->addSql('ALTER TABLE personne DROP membre_menage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menage ADD membre_menage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menage ADD CONSTRAINT FK_D1F20C8ACA808475 FOREIGN KEY (membre_menage_id) REFERENCES membre_menage (id)');
        $this->addSql('CREATE INDEX IDX_D1F20C8ACA808475 ON menage (membre_menage_id)');
        $this->addSql('ALTER TABLE personne ADD membre_menage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFCA808475 FOREIGN KEY (membre_menage_id) REFERENCES membre_menage (id)');
        $this->addSql('CREATE INDEX IDX_FCEC9EFCA808475 ON personne (membre_menage_id)');
    }
}
