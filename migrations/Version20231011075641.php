<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011075641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent ADD unite_id INT DEFAULT NULL, ADD commune_id INT DEFAULT NULL, ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DEC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (code_unite)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (code_commune)');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D98260155 FOREIGN KEY (region_id) REFERENCES region (code_region)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_268B9C9DEC4A74AB ON agent (unite_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_268B9C9D131A4F72 ON agent (commune_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_268B9C9D98260155 ON agent (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DEC4A74AB');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D131A4F72');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D98260155');
        $this->addSql('DROP INDEX UNIQ_268B9C9DEC4A74AB ON agent');
        $this->addSql('DROP INDEX UNIQ_268B9C9D131A4F72 ON agent');
        $this->addSql('DROP INDEX UNIQ_268B9C9D98260155 ON agent');
        $this->addSql('ALTER TABLE agent DROP unite_id, DROP commune_id, DROP region_id');
    }
}
