<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425165730 extends AbstractMigration {
    public function up(Schema $schema) {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_util_cards DROP card_deck_uses');
        $this->addSql('ALTER TABLE avatar CHANGE image_path image_path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user_char_cards DROP card_deck_uses');
    }

    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE avatar CHANGE image_path image_path VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user_char_cards ADD card_deck_uses INT NOT NULL');
        $this->addSql('ALTER TABLE user_util_cards ADD card_deck_uses INT NOT NULL');
    }
}
