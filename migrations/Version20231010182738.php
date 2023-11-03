<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010182738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise ADD quartier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60DF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (code_quartier)');
        $this->addSql('CREATE INDEX IDX_D19FA60DF1E57AB ON entreprise (quartier_id)');
        $this->addSql('ALTER TABLE maison ADD quartier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE maison ADD CONSTRAINT FK_F90CB66DDF1E57AB FOREIGN KEY (quartier_id) REFERENCES quartier (code_quartier)');
        $this->addSql('CREATE INDEX IDX_F90CB66DDF1E57AB ON maison (quartier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60DF1E57AB');
        $this->addSql('DROP INDEX IDX_D19FA60DF1E57AB ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP quartier_id');
        $this->addSql('ALTER TABLE maison DROP FOREIGN KEY FK_F90CB66DDF1E57AB');
        $this->addSql('DROP INDEX IDX_F90CB66DDF1E57AB ON maison');
        $this->addSql('ALTER TABLE maison DROP quartier_id');
    }
}
