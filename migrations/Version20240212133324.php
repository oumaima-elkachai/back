<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240212133324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_l DROP FOREIGN KEY FK_8E7436946AB213CC');
        $this->addSql('DROP INDEX IDX_8E7436946AB213CC ON category_l');
        $this->addSql('ALTER TABLE category_l DROP lieu_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_l ADD lieu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category_l ADD CONSTRAINT FK_8E7436946AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('CREATE INDEX IDX_8E7436946AB213CC ON category_l (lieu_id)');
    }
}
