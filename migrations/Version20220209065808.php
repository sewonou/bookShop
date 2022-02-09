<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209065808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6682F1BAF4');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66998666D1');
        $this->addSql('DROP INDEX IDX_23A0E6682F1BAF4 ON article');
        $this->addSql('DROP INDEX IDX_23A0E66998666D1 ON article');
        $this->addSql('ALTER TABLE article DROP choice_id, DROP language_id');
        $this->addSql('ALTER TABLE category ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD choice_id INT DEFAULT NULL, ADD language_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6682F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66998666D1 FOREIGN KEY (choice_id) REFERENCES choice (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6682F1BAF4 ON article (language_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66998666D1 ON article (choice_id)');
        $this->addSql('ALTER TABLE category DROP slug');
    }
}
