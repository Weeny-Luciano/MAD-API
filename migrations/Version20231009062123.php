<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231009062123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maison ADD type_maison_id INT DEFAULT NULL, ADD proprietaire_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66D29A199BF FOREIGN KEY (type_maison_id) REFERENCES type_maison (id)');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66D76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne)');
        $this->addSql('CREATE INDEX IDX_F90CB66D29A199BF ON maison (type_maison_id)');
        $this->addSql('CREATE INDEX IDX_F90CB66D76C50E4A ON maison (proprietaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66D29A199BF');
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66D76C50E4A');
        $this->addSql('DROP INDEX IDX_F90CB66D29A199BF ON maison');
        $this->addSql('DROP INDEX IDX_F90CB66D76C50E4A ON maison');
        $this->addSql('ALTER TABLE maison DROP type_maison_id, DROP proprietaire_id');
    }
}
