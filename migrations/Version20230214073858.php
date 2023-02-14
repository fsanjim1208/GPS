<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214073858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje ADD id_modo_id INT NOT NULL, ADD id_banda_id INT NOT NULL');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01C6C5CC5E FOREIGN KEY (id_modo_id) REFERENCES modo (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01CE20E088 FOREIGN KEY (id_banda_id) REFERENCES banda (id)');
        $this->addSql('CREATE INDEX IDX_9B631D01C6C5CC5E ON mensaje (id_modo_id)');
        $this->addSql('CREATE INDEX IDX_9B631D01CE20E088 ON mensaje (id_banda_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01C6C5CC5E');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01CE20E088');
        $this->addSql('DROP INDEX IDX_9B631D01C6C5CC5E ON mensaje');
        $this->addSql('DROP INDEX IDX_9B631D01CE20E088 ON mensaje');
        $this->addSql('ALTER TABLE mensaje DROP id_modo_id, DROP id_banda_id');
    }
}
