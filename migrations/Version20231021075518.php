<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021075518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6076C50E4A');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66D76C50E4A');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66D76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA6076C50E4A');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA6076C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne)');
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66D76C50E4A');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66D76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES personne (code_personne)');
    }
}
