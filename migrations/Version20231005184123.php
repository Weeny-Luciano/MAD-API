<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231005184123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre_menage ADD personne_id VARCHAR(255) DEFAULT NULL, ADD menage_id VARCHAR(10) DEFAULT NULL');
        $this->addSql('ALTER TABLE membre_menage ADD CONSTRAINT FK_4BFB9933A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_menage ADD CONSTRAINT FK_4BFB993375E5878B FOREIGN KEY (menage_id) REFERENCES menage (code_menage) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4BFB9933A21BD112 ON membre_menage (personne_id)');
        $this->addSql('CREATE INDEX IDX_4BFB993375E5878B ON membre_menage (menage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre_menage DROP FOREIGN KEY FK_4BFB9933A21BD112');
        $this->addSql('ALTER TABLE membre_menage DROP FOREIGN KEY FK_4BFB993375E5878B');
        $this->addSql('DROP INDEX IDX_4BFB9933A21BD112 ON membre_menage');
        $this->addSql('DROP INDEX IDX_4BFB993375E5878B ON membre_menage');
        $this->addSql('ALTER TABLE membre_menage DROP personne_id, DROP menage_id');
    }
}
