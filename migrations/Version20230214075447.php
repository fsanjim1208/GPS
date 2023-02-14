<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214075447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje ADD participante_id INT NOT NULL, ADD juez_id INT NOT NULL');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01F6F50196 FOREIGN KEY (participante_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D012515F440 FOREIGN KEY (juez_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9B631D01F6F50196 ON mensaje (participante_id)');
        $this->addSql('CREATE INDEX IDX_9B631D012515F440 ON mensaje (juez_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01F6F50196');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D012515F440');
        $this->addSql('DROP INDEX IDX_9B631D01F6F50196 ON mensaje');
        $this->addSql('DROP INDEX IDX_9B631D012515F440 ON mensaje');
        $this->addSql('ALTER TABLE mensaje DROP participante_id, DROP juez_id');
    }
}
